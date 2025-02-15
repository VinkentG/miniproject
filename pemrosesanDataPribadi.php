 <div class="tab-pane fade" id="pemrosesan" role="tabpanel" aria-labelledby="pemrosesan-tab">
    <div class="detail-data-pribadi">
        
        <div class="mb-3">
            <label class="form-label">Sumber Pengumpulan Data Pribadi</label>
            <select class="form-select">
                <option selected disabled>Asal sumber pengumpulan</option>
                <option value="1">Option 1</option>
                <option value="2">Option 2</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Negara - Lokasi Penyimpanan Data Pribadi</label>
            <div class="row">
                <div class="col-md-4">
                    <select class="form-select mb-2">
                        <option value="indonesia">Indonesia</option>
                        <option value="singapore">Singapore</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-secondary">Ubah</button>
                    <button class="btn btn-primary">Di Proses</button>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Masa Retensi</label>
            <div class="row align-items-center">
                <div class="col-md-2">
                    <input type="number" class="form-control" value="2">
                </div>
                <div class="col-md-2">
                    <span>Tahun</span>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Keterangan masa retensi</label>
            <textarea class="form-control" rows="2" placeholder="setelah hubungan kerja berakhir"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Pihak Selain Pengendali yang dapat Mengakses Data Pribadi dan Lokasi Pihak Tersebut</label>
            <div class="d-flex align-items-center">
                <input type="text" class="form-control" placeholder="Pengadilan Hukum - Indonesia">
                <button class="btn btn-link ms-2" title="Info">
                    <i class="bi bi-info-circle"></i>
                </button>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Pihak Pihak Lain Yang Memiliki Akses ke Data Pribadi</label>
            <select class="form-select">
                <option selected disabled>Buka - Processor</option>
                <option value="1">Option 1</option>
                <option value="2">Option 2</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Terdapat aktivitas pengiriman Data Pribadi ke pihak lain</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="dataTransfer" id="yes">
                <label class="form-check-label" for="yes">Ya</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="dataTransfer" id="no">
                <label class="form-check-label" for="no">Tidak</label>
            </div>
        </div>                        
    </div>
</div>