<div class="tab-content" id="myTabContent">
    <div class='tab-pane fade show active' id='detail' role='tabpanel' aria-labelledby='detail-tab'>
        <div class='detail-data-pribadi'>

            <div class="<?php gapBetweenRow() ?>">
                <div class="row">
                    <div class="<?php colLable() ?>">
                        <label class='form-label'>Business Process</label>
                    </div>
                    <div class="<?php colInput() ?>">
                        <textarea class='form-control' name="businessProcess" rows='4' onblur="onBlur(this)"></textarea>
                    </div>
                </div>    
            </div>

            <div class="<?php gapBetweenRow() ?>">
                <div class="row">
                    <div class="<?php colLable() ?>">
                        <label class='form-label required'>Tujuan Permintaan Data Pribadi</label>
                    </div>
                    <div class="<?php colInput() ?>">
                        <div class="d-flex align-items-center gap-2">
                            <textarea class='form-control' name="purposeRequest" rows='4'
                            placeholder='Entry Tujuan Permintaan Data Pribadi' onblur="onBlur(this)"></textarea>
                            <?php tooltip('test') ?>
                        </div>  
                    </div>
                </div>
            </div>

            <div class="<?php gapBetweenRow() ?>">
                <div class="row">
                    <div class="<?php colLable() ?>">
                        <label class="form-label required">Dasar Permintaan Data Pribadi</label>
                    </div>
                    <div class="<?php colInput() ?>">
                        <div class="d-flex align-items-center gap-2">
                            <div class="select-search" id="peranSelect">
                                <div class="d-flex align-items-center gap-2">
                                    <input type="text" 
                                           name="peranSelect" 
                                           class="form-control" 
                                           placeholder="Select Peran" 
                                           data-value="" 
                                           onblur="onBlur(this)">
                                    <?php tooltip('test') ?>
                                </div>
                                <span class="select-clear">&times;</span>
                                <div class="select-options">
                                    <div class="select-option" data-value="pt1" onclick="selectOption(this)">
                                        PT Maju Jaya
                                    </div>
                                    <div class="select-option" data-value="pt2" onclick="selectOption(this)">
                                        PT Sukses Makmur
                                    </div>
                                    <div class="select-option no-results" style="display: none">
                                        No matches found
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="<?php gapBetweenRow() ?>">
                <div class="row">
                    <div class="<?php colLable() ?>">
                        <label class="form-label required">Kategori Subjek Data Pribadi</label>
                    </div>
                    <div class="<?php colInput() ?>">
                        <div class="d-flex align-items-center gap-2">
                            <input type='text' name="categorySubject" class='form-control' placeholder='Entry Kategori Subjek Data Pribadi' onblur="onBlur(this)">
                            <?php tooltip('test') ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="<?php gapBetweenRow() ?>" style="width: 60%;">
            <table class='table table-bordered' id="dataPribadiTable">
                    <thead>
                        <tr>
                            <th class="required">Jenis Data Pribadi</th>
                            <th class="required">Sifat Data Pribadi</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td colspan="3">
                            <button class="btn btn-primary" type="button" onclick="addRowTableDataPribadi()">Add</button>
                        </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<script>
        let tableValue = [{key:0,jenisDataPribadi: '', sifatDataPribadi: '', isRender:false}];
        
        function populateTableDataPribadi(isFirstRender) {
            const table = document.getElementById('dataPribadiTable').getElementsByTagName('tbody')[0];
            tableValue.filter((data)=> !data.isRender).forEach((data,index) => {
                const newRow = table.insertRow(table.rows.length - 1);
                const cell1 = newRow.insertCell(0);
                const cell2 = newRow.insertCell(1);
                const cell3 = newRow.insertCell(2);

                cell1.innerHTML = `<input type="text" name="jenisDataPribadi${data.key}" class="form-control" value="${data.jenisDataPribadi}" onblur="onBlur(this)">`;
                cell2.innerHTML = `<div class="select-search" id="sifatDataPribadi${data.key}">
                                        <input type="text" name="sifatDataPribadi${data.key}" class="form-control" placeholder="Select Sifat Data Pribadi" data-value="" onblur="onBlur(this)">
                                        <span class="select-clear">&times;</span>
                                        <div class="select-options">
                                            <div class="select-option" data-value="pt1" onclick="selectOption(this)">PT Maju Jaya</div>
                                            <div class="select-option" data-value="pt2" onclick="selectOption(this)">PT Sukses Makmur</div>
                                            <div class="select-option no-results" style="display: none">No matches found</div>
                                        </div>
                                    </div>`;
                cell3.style.width = '0px';

                if(!isFirstRender){
                    cell3.innerHTML = `<button key="${data.key}" class="btn btn-danger" onclick="deleteRowTableDataPribadi(this)">Delete</button>`;
                }   

                data.isRender = true;
            });
        }

        function addRowTableDataPribadi() {
           tableValue.push({key: Math.random(), jenisDataPribadi: '', sifatDataPribadi: '', isRender:false});
           populateTableDataPribadi();
           initializeSelectSearch();
        }

        function deleteRowTableDataPribadi(button) {
            const row = button.closest('tr');
            row.parentNode.removeChild(row);
            tableValue = tableValue.filter((data)=> data.key != button.getAttribute('key'))
        }

        // Populate the table on page load
        document.addEventListener('DOMContentLoaded', populateTableDataPribadi(true));
</script>