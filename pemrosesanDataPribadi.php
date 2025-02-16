<div class="tab-pane fade" id="pemrosesan" role="tabpanel" aria-labelledby="pemrosesan-tab">
    <div class="detail-data-pribadi">

        <div class="<?php gapBetweenRow() ?>">
            <div class="row">
                <div class="<?php colLable() ?>">
                    <label class="form-label required">Sumber Pengumpulan Data Pribadi</label>
                </div>
                <div class="<?php colInput() ?>">
                    <div class="select-search" id="deptSumberPengumpulanDataPribadi">
                    <input type="text" name="deptSumberPengumpulanDataPribadi" class="form-control" placeholder="Select Sumber Pengumpulan Data Pribadi" data-value="" onblur="onBlur(this)">
                    <span class="select-clear">&times;</span>
                    <div class="select-options">
                        <div class="select-option" data-value="dept1" onclick="selectOption(this)">Option 1</div>
                        <div class="select-option" data-value="dept2" onclick="selectOption(this)">Option 2</div>
                        <div class="select-option no-results" style="display: none">No matches found</div>
                    </div>
                </div>
                </div>
            </div>             
        </div>

        <div class="<?php gapBetweenRow() ?>">
            <div class="row">
                <div class="<?php colLable() ?>">
                    <label class="form-label required">Negara - Lokasi Penyimpanan Data Pribadi</label>
                </div>
                <div class="<?php colInput() ?>">
                <div id="tableValueNegaraLokasiPenyimpananDataPribadi"></div>
                </div>
            </div>
        </div>

        <div class="<?php gapBetweenRow() ?>">
            <div class="row">
                <div class="<?php colLable() ?>">   
                    <label class="form-label required">Masa Retensi</label>
                </div>
                <div class="col-md-2">
                    <input name="masaRetensi" type="number" class="form-control" value="2" onblur="onBlur(this)">
                </div>
                <div class="col-md-2">
                    <span>Tahun</span>
                </div>
            </div>
        </div>

        <div class="<?php gapBetweenRow() ?>">
            <div class="row">
                <div class="<?php colLable() ?>">
                    <label class="form-label">Keterangan masa retensi</label>
                </div>
                <div class="<?php colInput() ?>">
                    <textarea name="keteranganMasaRetensi" class="form-control" rows="2" placeholder="setelah hubungan kerja berakhir"></textarea>
                </div>
            </div>
        </div>

        <div class="<?php gapBetweenRow() ?>">
            <div class="row">
                <div class="<?php colLable() ?>">
                    <label class="form-label required">Pihak Selain Pengendali yang dapat Mengakses Data Pribadi dan Lokasi Pihak Tersebut</label>
                </div>
                <div class="<?php colInput() ?>">
                    <div class="d-flex align-items-center gap-2">
                        <textarea name="pihakSelainPengendali" class="form-control" rows="4" placeholder="setelah hubungan kerja berakhir" onblur="onBlur(this)"></textarea>
                        <?php tooltip('test') ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="<?php gapBetweenRow() ?>">
            <div class="row">
                <div class="<?php colLable() ?>">
                    <label class="form-label">Pihak Pihak Lain Yang Memiliki Akses ke Data Pribadi</label>
                </div>
                <div class="<?php colInput() ?>">
                    <div class="select-search" id="pihakPihakLain">
                        <input type="text" 
                               name="pihakPihakLain" 
                               class="form-control" 
                               placeholder="Select Pihak Pihak Lain Yang Memiliki Akses ke Data Pribadi" 
                               data-value="" 
                               onblur="onBlur(this)">
                        <span class="select-clear">&times;</span>
                        <div class="select-options">
                            <div class="select-option" data-value="dept1" onclick="selectOption(this)">Option 1</div>
                            <div class="select-option" data-value="dept2" onclick="selectOption(this)">Option 2</div>
                            <div class="select-option no-results" style="display: none">No matches found</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="<?php gapBetweenRow() ?>">
            <div class="row">
                <div class="<?php colLable() ?>">
                    <label class="form-label" style="margin-right: 25px;">
                        Terdapat aktivitas pengiriman Data Pribadi ke pihak lain
                    </label>
                </div>
                <div class="<?php colInput() ?>">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="dataTransfer" id="yes">
                        <label class="form-check-label" for="yes">Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="dataTransfer" id="no" checked>
                        <label class="form-check-label" for="no">Tidak</label>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="<?php gapBetweenRow() ?>">
            <div class="row">
                <div class="<?php colLable() ?>">
                    <label class="form-label required">Tujuan Pengiriman Data Pribadi ke Pihak Lain</label>
                </div>
                <div class="<?php colInput() ?>">
                    <textarea name="tujuanPengiriman" class="form-control" rows="4" placeholder="Masukan Tujuan Pengiriman Data Pribadi ke Pihak Lain" onblur="onBlur(this)"></textarea>
                </div>
            </div>
        </div>

        <div class="<?php gapBetweenRow() ?>">
            <div class="row">
                <div class="<?php colLable() ?>">
                    <label class="form-label">Document Pendukung Pengiriman Data Pribadi</label>
                </div>
                <div class="<?php colInput() ?>">
                    <input type="file" name="documentPendukung" class="form-control" placeholder="Upload Document Pendukung Pengiriman Data Pribadi" onblur="onBlur(this)">
                </div>
            </div>
        </div>

        <div class="<?php gapBetweenRow() ?>">
            <div class="row">
                <div class="<?php colLable() ?>">   
                    <label class="form-label required">Pemetaan Aliran Data Pribadi</label>
                </div>
                <div class="<?php colInput() ?>">
                    <textarea name="pemetaanAliranDataPribadi" class="form-control" rows="6" placeholder="Masukan Pemetaan Aliran Data Pribadi" onblur="onBlur(this)"></textarea>
                </div>
            </div>
        </div>
        
    </div>
</div>

<script>
     const tableValueNegaraLokasiPenyimpananDataPribadi = [{key:0,negara: '', enntryLokasi: '', isRender:false}];

    function populateNegaraLokasiPenyimpananDataPribadi(isFirstRender) {
        let table = document.getElementById('tableValueNegaraLokasiPenyimpananDataPribadi')
           
        tableValueNegaraLokasiPenyimpananDataPribadi.filter((data) => !data.isRender).forEach((data, index) => {
            const newRow = document.createElement('div');
            newRow.className = 'd-flex align-items-center gap-2 mb-2';
            newRow.innerHTML = `
                    <div style="width: 30%;">
                        <div class="select-search" id="negara${data.key}">
                            <input type="text" name="negara${data.key}" class="form-control" placeholder="Select Negara" data-value="" onblur="onBlur(this)">
                            <span class="select-clear">&times;</span>
                            <div class="select-options">
                                <div class="select-option" data-value="pt1" onclick="selectOption(this)">PT Maju Jaya</div>
                                <div class="select-option" data-value="pt2" onclick="selectOption(this)">PT Sukses Makmur</div>
                                <div class="select-option no-results" style="display: none">No matches found</div>
                            </div>
                        </div>
                    </div>
                    <div style="width: 50px; justify-items: center; height: 100%;">
                        <div class="dash-line"></div>
                    </div>
                    <div style="width: 30%;">
                        <input type="text" name="entryLokasi${data.key}" class="form-control" placeholder="Entry Lokasi" onblur="onBlur(this)">
                        <span name="errorText"></span>
                    </div>
                    ${!isFirstRender ? "" : `<button class="btn btn-sm btn-primary" type="button" onclick="addRowNegaraLokasiPenyimpananDataPribadi()">Add</button>`}`
        
            if(!isFirstRender){
                newRow.innerHTML += `<div key="${data.key}" class="col-md-1"><button class="btn btn-danger" onclick="deleteRowNegaraLokasiPenyimpananDataPribadi(this)">Delete</button></div>`
            }

            table.appendChild(newRow);

            data.isRender = true;
            });

        }

     function addRowNegaraLokasiPenyimpananDataPribadi() {
        tableValueNegaraLokasiPenyimpananDataPribadi.push({key: Math.random(), negara: '', enntryLokasi: '', isRender:false});
        populateNegaraLokasiPenyimpananDataPribadi()
        initializeSelectSearch();
     }

       function deleteRowNegaraLokasiPenyimpananDataPribadi(button) {
            const row = button.parentElement.parentElement;
            const table = row.parentElement;
            table.removeChild(row);
            tableValueNegaraLokasiPenyimpananDataPribadi = tableValueNegaraLokasiPenyimpananDataPribadi.filter((data)=> data.key != button.getAttribute('key'))
        }


      // Populate the table on page load
    document.addEventListener('DOMContentLoaded', populateNegaraLokasiPenyimpananDataPribadi(true));
</script>