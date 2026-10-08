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

// Dipakai kalau kamu menambah nama baru di KV yang belum ada di PERSONAS.
const FALLBACK: Persona[] = [
  { alias: "The Fearless", quote: "I came for the fear. I’m staying for the screams." },
  { alias: "The Night Crawler", quote: "Darkness is just a door nobody opened yet." },
  { alias: "The Iron Nerve", quote: "My heartbeat is the only thing that’s allowed to run." },
];

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

const json = (data: unknown, status = 200) =>
  new Response(JSON.stringify(data), {
    status,
    headers: { "Content-Type": "application/json", "Cache-Control": "no-store" },
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

function ticketFor(name: string, idx: number) {
  const p = PERSONAS[name] ?? FALLBACK[hash(name) % FALLBACK.length];
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

    try {
      // Daftar slot: nama yang BELUM terdaftar tidak pernah dikirim ke browser.
      if (url.pathname === "/api/status" && req.method === "GET") {
        const all = await snapshot(env);
        return json({
          total: all.length,
          registered: all.filter((x) => x.registered).map((x) => ticketFor(x.name, x.idx)),
        });
      }

      // Cek apakah nama ada di KV (belum mengubah apa pun).
      if (url.pathname === "/api/lookup" && req.method === "POST") {
        const q = fold(await readName(req));
        if (!q) return json({ found: false });
        const hit = (await snapshot(env)).find((x) => fold(x.name) === q);
        return hit ? json({ found: true, name: hit.name, registered: hit.registered }) : json({ found: false });
      }

      // Konfirmasi: ubah value jadi "true" lalu kembalikan data tiket.
      if (url.pathname === "/api/confirm" && req.method === "POST") {
        const q = fold(await readName(req));
        const hit = q ? (await snapshot(env)).find((x) => fold(x.name) === q) : undefined;
        if (!hit) return json({ ok: false }, 404);
        if (!hit.registered) await env.KV.put(hit.name, "true");
        return json({ ok: true, ticket: ticketFor(hit.name, hit.idx) });
      }
    } catch (e) {
      return json({ error: "server_error" }, 500);
    }

    return new Response("Not found", { status: 404 });
  },
} satisfies ExportedHandler<Env>;
