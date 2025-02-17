   <div class="tab-pane fade" id="tata-kelola" role="tabpanel" aria-labelledby="tata-kelola-tab">
        <div class="detail-data-pribadi">

         <div class="<?php gapBetweenRow() ?>">
            <div class="row">
                <div class="<?php colLable() ?>">
                    <label class="form-label required">Hak Subjek Data yang dapat dipenuhi dalam pemrosesan data pribadi</label>
                </div>
                <div class="<?php colInput() ?>">
                    <div class="select-search" id="hakSubjekData">
                    <input type="text" name="hakSubjekData" class="form-control" placeholder="Select Hak Subjek Data" data-value="" autocomplete="off" onblur="onBlur(this)">
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
                    <label class="form-label required">Langkah Teknis dan Organisasi Dalam Rangka Pengelolaan Data Pribadi</label>
                </div>
                <div class="<?php colInput() ?>">
                    <div class="d-flex align-items-center gap-2">
                        <input type='text' name="langkahTeknis" class='form-control' placeholder='Entry Langkah Teknis dan Organisasi Dalam Rangka Pengelolaan Data Pribadi' onblur="onBlur(this)">
                        <?php tooltip('test') ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="<?php gapBetweenRow() ?>">
            <div class="row">
                <div class="<?php colLable() ?>">
                    <label class="form-label">Document Pendukung Implementasi keamanan data</label>
                </div>
                <div class="<?php colInput() ?>">
                    <input type="file" name="documentPendukungKeamananData" class="form-control" placeholder="Upload Document Pendukung Implementasi keamanan data" onblur="onBlur(this)">
                </div>
            </div>
        </div>

        <div class="mt-4 mb-4">  
            <b>Identifikasi Penilaian Dampak Pelindungan Data Pribadi (DPIA)</b>
        </div>

        <div class="<?php gapBetweenRow() ?>">
            <div class="row">
                <div class="<?php colInput() ?>">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="pengambilanKeputusanOtomatis" id="pengambilanKeputusanOtomatis">
                        <label class="form-check-label" for="pengambilanKeputusanOtomatis">
                            Pengambilan keputusan secara otomatis
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="pemrosesanDataSpesifik" id="pemrosesanDataSpesifik">
                        <label class="form-check-label" for="pemrosesanDataSpesifik">
                            Pemrosesan data pribadi spesifik
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="pemrosesanBerskalaBesar" id="pemrosesanBerskalaBesar">
                        <label class="form-check-label" for="pemrosesanBerskalaBesar">
                            Pemrosesan data pribadi berskala besar
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="pemrosesanEvaluasi" id="pemrosesanEvaluasi">
                        <label class="form-check-label" for="pemrosesanEvaluasi">
                            Pemrosesan data pribadi untuk kegiatan evaluasi, penskoran, atau pemantauan yang sistematis terhadap Subjek Data Pribadi
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="pemrosesanPencocokan" id="pemrosesanPencocokan">
                        <label class="form-check-label" for="pemrosesanPencocokan">
                            Pemrosesan data pribadi untuk kegiatan pencocokan atau penggabungan sekelompok data
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="penggunaanTeknologiBaru" id="penggunaanTeknologiBaru">
                        <label class="form-check-label" for="penggunaanTeknologiBaru">
                            Penggunaan Teknologi Baru
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="pemrosesanMembatasiHak" id="pemrosesanMembatasiHak">
                        <label class="form-check-label" for="pemrosesanMembatasiHak">
                            Pemrosesan data pribadi yang membatasi pelaksanaan hak Subjek Data
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center <?php gapBetweenRow() ?>">
            <i class="bi bi-patch-check-fill"" style="font-size: 1.5rem; color: black;"></i>
            <b style="font-size: 1.25rem; color: #007bff; margin-left: 10px; font-weight: 700px;">DPIA perlu di lakukan</b>
        </div>

        <div class="<?php gapBetweenRow() ?>">
            <div class="row">
                <div class="<?php colLable() ?>">
                    <label class="form-label">Document Pendukung DPIA</label>
                </div>
                <div class="<?php colInput() ?>">
                    <input type="file" name="documentPendukungDPIA" class="form-control" placeholder="Upload Document Pendukung Implementasi keamanan data" onblur="onBlur(this)">
                </div>
            </div>
        </div>

        </div>
    </div>