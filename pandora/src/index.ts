export interface Env {
  KV: KVNamespace;
}

type Persona = { alias: string; quote: string };

// Alias + kutipan per nama (kunci = nama persis seperti di KV).
const PERSONAS: Record<string, Persona> = {
  Andhika: { alias: "The Unshaken", quote: "Fear is a place. I just booked a room." },
  Bona: { alias: "The Lionheart", quote: "If the doors open by themselves, I’ll hold them for everyone else." },
  Dei: { alias: "The Shadow Walker", quote: "The dark is not empty. I’ve already said hello." },
  Edwin: { alias: "The Calm Before the Scream", quote: "Stay quiet. Listen. Then run — gracefully." },
  Vinkent: { alias: "The Brave One", quote: "Every corridor has an exit. I intend to find all of them." },
  Wira: { alias: "The Last One Standing", quote: "When the lights go out, I’m the one still counting heads." },
};

// 20 judul berbeda. Enam nama di atas mengambil judulnya sendiri.
// Nama lain di KV mengantre ke judul yang belum terpakai, sesuai urutan nama.
const POOL: Persona[] = [
  PERSONAS.Andhika,
  PERSONAS.Bona,
  PERSONAS.Dei,
  PERSONAS.Edwin,
  PERSONAS.Vinkent,
  PERSONAS.Wira,
  { alias: "The Fearless", quote: "I came for the fear. I’m staying for the screams." },
  { alias: "The Night Crawler", quote: "Darkness is just a door nobody opened yet." },
  { alias: "The Iron Nerve", quote: "My heartbeat is the only thing that’s allowed to run." },
  { alias: "The Door Keeper", quote: "I don’t lock the doors. I remember who walked through." },
  { alias: "The Quiet Flame", quote: "The lights failed. I didn’t." },
  { alias: "The Lantern Bearer", quote: "If you can see me, you are still in the corridor." },
  { alias: "The Unblinking", quote: "I watched the dark until it looked away." },
  { alias: "The Hall Walker", quote: "Every step I take, the hallway takes one back." },
  { alias: "The Still Heart", quote: "Panic is loud. I left mine at the gate." },
  { alias: "The Whisper", quote: "Speak softly. The walls are taking notes." },
  { alias: "The Threshold", quote: "I stand where the corridor decides." },
  { alias: "The Last Light", quote: "When the bulb dies, I am what remains." },
  { alias: "The Bone Listener", quote: "I can hear which floorboard is lying." },
  { alias: "The One Who Stayed", quote: "They ran. I counted the doors and stayed." },
];

function personaFor(name: string, names: string[]): Persona {
  const own = PERSONAS[name];
  if (own) return own;
  const taken = new Set(names.flatMap((n) => (PERSONAS[n] ? [PERSONAS[n].alias] : [])));
  const spare = POOL.filter((p) => !taken.has(p.alias));
  const order = names.filter((n) => !PERSONAS[n]);
  const at = Math.max(0, order.indexOf(name));
  const list = spare.length ? spare : POOL;
  return list[at % list.length];
}

const fold = (s: string) =>
  s.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase().replace(/\s+/g, " ").trim();

const isTrue = (v: string | null) => (v ?? "").trim().toLowerCase() === "true";

function hash(s: string): number {
  let h = 2166136261;
  for (const c of s) {
    h ^= c.charCodeAt(0);
    h = Math.imul(h, 16777619);
  }
  return h >>> 0;
}

const PAGES_ORIGIN = "https://vinkentg.github.io";

function allowOrigin(req: Request): string {
  const origin = req.headers.get("Origin");
  if (!origin) return PAGES_ORIGIN;
  if (
    origin === PAGES_ORIGIN ||
    origin.endsWith(".workers.dev") ||
    origin.startsWith("http://localhost:") ||
    origin.startsWith("http://127.0.0.1:")
  ) {
    return origin;
  }
  return PAGES_ORIGIN;
}

const json = (req: Request, data: unknown, status = 200) =>
  new Response(JSON.stringify(data), {
    status,
    headers: {
      "Content-Type": "application/json",
      "Cache-Control": "no-store",
      "Access-Control-Allow-Origin": allowOrigin(req),
      Vary: "Origin",
    },
  });

async function listNames(env: Env): Promise<string[]> {
  const names: string[] = [];
  let cursor: string | undefined;
  do {
    const r = await env.KV.list({ cursor });
    names.push(...r.keys.map((k) => k.name));
    cursor = r.list_complete ? undefined : r.cursor;
  } while (cursor);
  return names.sort((a, b) => a.localeCompare(b));
}

async function snapshot(env: Env) {
  const names = await listNames(env);
  const values = await Promise.all(names.map((n) => env.KV.get(n)));
  return names.map((name, idx) => ({ name, idx, registered: isTrue(values[idx]) }));
}

function ticketFor(name: string, idx: number, names: string[]) {
  const p = personaFor(name, names);
  return {
    name,
    idx,
    alias: p.alias,
    quote: p.quote,
    no: `GA-${String(idx + 1).padStart(2, "0")}-${(hash(name) % 9000) + 1000}`,
  };
}

async function readName(req: Request): Promise<string> {
  try {
    const body = (await req.json()) as { name?: unknown };
    return typeof body.name === "string" ? body.name.slice(0, 40) : "";
  } catch {
    return "";
  }
}

export default {
  async fetch(req: Request, env: Env): Promise<Response> {
    const url = new URL(req.url);
    const pathname = url.pathname.replace(/\/+$/, "") || "/";

    if (req.method === "OPTIONS" && pathname.startsWith("/api/")) {
      return new Response(null, {
        status: 204,
        headers: {
          "Access-Control-Allow-Origin": allowOrigin(req),
          "Access-Control-Allow-Methods": "GET, POST, OPTIONS",
          "Access-Control-Allow-Headers": "Content-Type",
          "Access-Control-Max-Age": "86400",
          Vary: "Origin",
        },
      });
    }

    try {
      if (!env.KV) return json(req, { error: "kv_unbound" }, 500);

      // Daftar slot: nama yang BELUM terdaftar tidak pernah dikirim ke browser.
      if (pathname === "/api/status" && req.method === "GET") {
        const all = await snapshot(env);
        const names = all.map((x) => x.name);
        return json(req, {
          total: all.length,
          registered: all.filter((x) => x.registered).map((x) => ticketFor(x.name, x.idx, names)),
        });
      }

      // Cek apakah nama ada di KV (belum mengubah apa pun).
      if (pathname === "/api/lookup" && req.method === "POST") {
        const q = fold(await readName(req));
        if (!q) return json(req, { found: false });
        const hit = (await snapshot(env)).find((x) => fold(x.name) === q);
        return hit ? json(req, { found: true, name: hit.name, registered: hit.registered }) : json(req, { found: false });
      }

      // Konfirmasi: ubah value jadi "true" lalu kembalikan data tiket.
      if (pathname === "/api/confirm" && req.method === "POST") {
        const q = fold(await readName(req));
        const all = await snapshot(env);
        const names = all.map((x) => x.name);
        const hit = q ? all.find((x) => fold(x.name) === q) : undefined;
        if (!hit) return json(req, { ok: false }, 404);
        if (!hit.registered) await env.KV.put(hit.name, "true");
        return json(req, { ok: true, ticket: ticketFor(hit.name, hit.idx, names) });
      }
    } catch (e) {
      return json(req, { error: "server_error" }, 500);
    }

    if (pathname.startsWith("/api/")) return json(req, { error: "not_found" }, 404);
    return new Response("Not found", { status: 404 });
  },
} satisfies ExportedHandler<Env>;
