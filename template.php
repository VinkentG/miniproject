<?php 
    function tooltip($input){
      echo '<i class="bi bi-question-circle" data-toggle="tooltip" data-placement="right" title="'.$input.'"></i>';
    }

    function colLable(){
      echo 'col-md-3';
    }

    function colInput(){
      echo 'col-md-9';
    }

    function gapBetweenRow(){
        echo 'mb-4';
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Informasi Internal Organisasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        .detail-data-pribadi {
            border: 1px solid #dee2e6;
            border-top: none;
            padding: 20px;
            padding-top: 40px;
            margin-top: -5px;
            border-radius: 0.375rem;
        }

        .radio-group {
            display: flex;
            gap: 20px;
        }

        .container {
            width: 100%;
            height: 100%;
            margin-bottom: 30px;
        }

        .required::after {
            content: "*";
            color: red;
            margin-left: 5px;
        }

        .select-search {
            position: relative;
            width: 100%;
        }

        .select-search input {
            width: 100%;
            padding: 0.375rem 0.75rem;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            cursor: text;
            background: #fff;
            transition: all 0.3s;
        }

        .select-search input:hover {
            border-color: #40a9ff;
        }

        .select-search input:focus {
            border-color: #40a9ff;
            box-shadow: 0 0 0 2px rgba(24, 144, 255, 0.2);
            outline: none;
        }

        .select-options {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 1000;
            max-height: 256px;
            overflow-y: auto;
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            display: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            margin-top: 4px;
        }

        .select-option {
            padding: 0.375rem 0.75rem;
            cursor: pointer;
            transition: background 0.3s;
        }

        .select-option:hover {
            background-color: #f5f5f5;
        }

        .select-option.selected {
            background-color: #e6f7ff;
            font-weight: 500;
        }

        .select-option.highlighted {
            background-color: #f5f5f5;
        }

        .select-search.active input {
            border-color: #40a9ff;
            box-shadow: 0 0 0 2px rgba(24, 144, 255, 0.2);
        }

        .select-search.disabled input {
            background-color: #f5f5f5;
            cursor: not-allowed;
        }

        .select-clear {
            position: absolute;
            right: 8px;
            top: 17px;
            transform: translateY(-50%);
            color: rgba(0, 0, 0, 0.25);
            font-size: 25px;
            cursor: pointer;
            display: none;
            padding-right: 5px;
            padding-left: 5px;
        }

        .select-clear:hover {
            color: red;
        }

        .select-search input:not([value=''])~.select-clear {
            display: block;
        }

        .select-option.filtered {
            display: none;
        }

        .select-option.no-results {
            color: #999;
            cursor: default;
        }

        .select-option.no-results:hover {
            background-color: transparent;
        }

        .dash-line{
            width: 50%;
            height: 2.5px;
            background: black;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <form name="formData">
            <h3 class="mb-4">Informasi Internal Organisasi</h3>

            <div class="<?php gapBetweenRow() ?>">
                <div class="row">
                    <div class="<?php colLable() ?>">
                        <label class="form-label required">PT</label>
                    </div>
                    <div class="<?php colInput() ?>">
                        <div class="select-search" id="ptSelect">
                            <input type="text" 
                                   name="ptSelect" 
                                   class="form-control" 
                                   placeholder="Select PT" 
                                   data-value="" 
                                   autocomplete="off"
                                   onblur="onBlur(this)" >
                            <span class="select-clear">&times;</span>
                            <div class="select-options">
                                <div class="select-option" data-value="pt1" onclick="selectOption(this)">
                                    PT Maju Jaya</div>
                                <div class="select-option" data-value="pt2" onclick="selectOption(this)">
                                    PT Sukses Makmur</div>
                                <div class="select-option no-results" style="display: none">No matches found</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="<?php gapBetweenRow() ?>">
                <div class="row">
                    <div class="<?php colLable() ?>">
                        <label class="form-label required">Departemen</label>
                    </div>
                    <div class="<?php colInput() ?>">
                        <div class="select-search" id="deptSelect">
                            <input type="text" name="deptSelect" class="form-control" placeholder="Select Departemen" data-value="" autocomplete="off" onblur="onBlur(this)">
                            <span class="select-clear">&times;</span>
                            <div class="select-options">
                                <div class="select-option" data-value="dept1" onclick="selectOption(this)">IT Department</div>
                                <div class="select-option" data-value="dept2" onclick="selectOption(this)">Human Resources</div>
                                <div class="select-option no-results" style="display: none">No matches found</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="<?php gapBetweenRow() ?>">
                <div class="row">
                    <div class="<?php colLable() ?>">
                        <label class="form-label required">Peran Dalam Perusahaan Pemrosesan Data Pribadi</label>
                    </div>
                    <div class="<?php colInput() ?>">
                        <div class="select-search" id="posSelect">
                            <input type="text" name="posSelect" class="form-control" placeholder="Select Posisi" data-value="" autocomplete="off" onblur="onBlur(this)">
                            <span class="select-clear">&times;</span>
                            <div class="select-options">
                                <div class="select-option" data-value="pos1" onclick="selectOption(this)">Software Engineer</div>
                                <div class="select-option" data-value="pos2" onclick="selectOption(this)">HR Manager</div>
                                <div class="select-option no-results" style="display: none">No matches found</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="detail-tab" data-bs-toggle="tab" data-bs-target="#detail"
                        type="button" role="tab" aria-controls="detail" aria-selected="true">Detail Data
                        Pribadi</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pemrosesan-tab" data-bs-toggle="tab" data-bs-target="#pemrosesan"
                        type="button" role="tab" aria-controls="pemrosesan" aria-selected="false">Pemrosesan Data
                        Pribadi</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tata-kelola-tab" data-bs-toggle="tab" data-bs-target="#tata-kelola"
                        type="button" role="tab" aria-controls="tata-kelola" aria-selected="false">Tata Kelola dan
                        Pengamanan</button>
                </li>
            </ul>

                <?php include_once 'detailDataPribadi.php'; ?>
                <?php include_once 'pemrosesanDataPribadi.php'; ?>
                <?php include_once 'tataKelolaDanPengamanan.php'; ?>
            </div>

        </form>

        <div class="button-container" style="margin-top: 20px; display: flex; gap: 10px; justify-content: flex-start;">
            <button class="btn btn-secondary" id="back">Back</button>
            <button class="btn btn-warning" id="save" onclick="saveAsDraft()">Save As Draft</button>
            <button class="btn btn-primary" id="submit">Submit</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ===============================================================================================================
        // SELECT 
        // ===============================================================================================================
        function selectOption(option) {
            const select = option.closest('.select-search');
            const input = select.querySelector('input');
            const optionElements = select.querySelectorAll('.select-option:not(.no-results)');

            input.test = option.textContent.trim();
            input.value = option.textContent.trim();
            input.dataset.value = option.textContent.trim();

            optionElements.forEach(opt => opt.classList.remove('selected'));
            option.classList.add('selected');

            select.classList.remove('active');
            select.querySelector('.select-options').style.display = 'none';

            const event = new Event('change', {
                bubbles: true,
                cancelable: true,
            });
            input.dispatchEvent(event);
        }

        function initializeSelectSearch() {
            document.querySelectorAll('.select-search').forEach(select => {
                const input = select.querySelector('input');
                const options = select.querySelector('.select-options');
                const optionElements = select.querySelectorAll('.select-option:not(.no-results)');
                const noResultsElement = select.querySelector('.select-option.no-results');
                const clearButton = select.querySelector('.select-clear');
                let highlightedIndex = -1;
                let previousValue = '';
                let previousDataValue = '';

                const showOptions = () => {
                    options.style.display = 'block';
                    select.classList.add('active');
                };

                const hideOptions = () => {
                    options.style.display = 'none';
                    select.classList.remove('active');
                    highlightedIndex = -1;
                    removeHighlight();
                };

                const removeHighlight = () => {
                    optionElements.forEach(opt => opt.classList.remove('highlighted'));
                };

                const highlightOption = (index) => {
                    removeHighlight();
                    const visibleOptions = Array.from(optionElements).filter(opt => !opt.classList.contains('filtered'));
                    if (index >= 0 && index < visibleOptions.length) {
                        visibleOptions[index].classList.add('highlighted');
                        visibleOptions[index].scrollIntoView({ block: 'nearest' });
                    }
                };

                const filterOptions = (searchText) => {
                    let hasVisibleOptions = false;
                    optionElements.forEach(option => {
                        const text = option.textContent.toLowerCase().trim();
                        const isVisible = text.includes(searchText.toLowerCase());
                        option.classList.toggle('filtered', !isVisible);
                        if (isVisible) hasVisibleOptions = true;
                    });

                    noResultsElement.style.display = hasVisibleOptions ? 'none' : 'block';
                    return hasVisibleOptions;
                };

                input.addEventListener('click', () => {
                    showOptions();
                });

                input.addEventListener('focus', () => {
                    showOptions();
                });

                input.addEventListener('blur', () => {
                    setTimeout(() => {
                        if (!select.contains(document.activeElement)) {
                            input.value = input.test || ""
                            input.dataset.value = input.test || ""
                            optionElements.forEach(opt => {
                                    opt.classList.remove('filtered');
                            });
                            noResultsElement.style.display = 'none';
                            
                            hideOptions();
                        }
                    }, 200);
                });

                input.addEventListener('keydown', (e) => {
                    const visibleOptions = Array.from(optionElements).filter(opt => !opt.classList.contains('filtered'));

                    switch (e.key) {
                        case 'ArrowDown':
                            e.preventDefault();
                            highlightedIndex = Math.min(highlightedIndex + 1, visibleOptions.length - 1);
                            if (highlightedIndex === -1) highlightedIndex = 0;
                            highlightOption(highlightedIndex);
                            break;
                        case 'ArrowUp':
                            e.preventDefault();
                            highlightedIndex = Math.max(highlightedIndex - 1, 0);
                            highlightOption(highlightedIndex);
                            break;
                            case 'Enter':
                                e.preventDefault();
                                if (highlightedIndex >= 0 && visibleOptions[highlightedIndex]) {
                                    visibleOptions[highlightedIndex].click();
                                    const selectedOption = visibleOptions[highlightedIndex];
                                    if (selectedOption) {
                                        input.value = selectedOption.textContent.trim();
                                        input.dataset.value = selectedOption.dataset.value;
                                    }
                                }
                                break;
                        case 'Escape':
                            hideOptions();
                            break;
                    }
                });

                input.addEventListener('input', () => {
                    const hasVisibleOptions = filterOptions(input.value);
                    if (hasVisibleOptions) {
                        showOptions();
                        highlightedIndex = -1;
                    } else {
                        showOptions();
                    }
                });

                optionElements.forEach((option, index) => {
                    option.addEventListener('mouseover', () => {
                        highlightedIndex = index;
                        highlightOption(index);
                    });
                });

                clearButton.addEventListener('click', (e) => {
                    e.stopPropagation();
                    input.value = '';
                    input.dataset.value = '';
                    previousValue = '';
                    previousDataValue = '';
                    optionElements.forEach(opt => {
                        opt.classList.remove('selected', 'filtered');
                    });
                    noResultsElement.style.display = 'none';

                    const event = new Event('change', {
                        bubbles: true,
                        cancelable: true,
                    });
                    input.dispatchEvent(event);
                });

                document.addEventListener('click', (e) => {
                    if (!select.contains(e.target)) {
                        hideOptions();
                    }
                });
            });
        }

        // Populate the table on page load
        document.addEventListener('DOMContentLoaded', initializeSelectSearch);

        // ===============================================================================================================
        // ACTION
        // ===============================================================================================================
          function onBlur(input) {
            input.style.borderColor = "";

            const parentNode = input.parentNode;
            const grandparentNode = input.parentNode.parentNode;

            if (parentNode.querySelector('i')) {
                const errorText = grandparentNode.querySelector('span[name="errorText"]');
                if (errorText) {
                    errorText.style.display = 'none';
                }
            } else {
                const errorText = parentNode.querySelector('span[name="errorText"]');
                if (errorText) {
                    errorText.style.display = 'none';
                }
            }
          }
        
          function validateInput(input) {
            const existingErrorText = input.parentNode.querySelector('span[name="errorText"]') || input.parentNode.parentNode.querySelector('span[name="errorText"]');
            if (existingErrorText) {
                existingErrorText.remove();
            }
            if (input.value.trim() === "") {
                input.style.borderColor = "red";
                const errorText = document.createElement('span');
                errorText.setAttribute('name', 'errorText');
                errorText.style.color = 'red';
                errorText.textContent = 'This field is required';

                const parentNode = input.parentNode;
                const grandparentNode = input.parentNode.parentNode;

                if (input.parentNode.querySelector('i')) {
                    grandparentNode.appendChild(errorText);
                } else {
                    parentNode.appendChild(errorText);
                }
            } 
        }

        function saveAsDraft(){
        const formData = new FormData(document.forms['formData']);
        // console.log('Form Data:', Object.fromEntries(formData.entries())); 
        // console.log({tableValue})

        for (let [key, value] of formData.entries()) {
            // console.log(value)
            if (value?.trim() === "") {
                const inputElement = document.querySelector(`[name="${key}"]`);
                if (inputElement) {
                    onBlur(inputElement);
                    validateInput(inputElement);
                    }
                }
            }   
        }  
    </script>
</body>

</html>
