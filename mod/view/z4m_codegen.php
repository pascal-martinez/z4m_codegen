<?php
/**
 * ZnetDK, Starter Web Application for rapid & easy development
 * See official website https://mobile.znetdk.fr
 * Copyright (C) 2024 Pascal MARTINEZ (contact@znetdk.fr)
 * License GNU GPL https://www.gnu.org/licenses/gpl-3.0.html GNU GPL
 * --------------------------------------------------------------------
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 * --------------------------------------------------------------------
 * ZnetDK 4 Mobile Code Generator view
 *
 * File version: 1.0
 * Last update: 12/17/2024
 */
?>
<form id="z4m-codegen-form" class="w3-content" data-zdk-submit="z4mCodeGenCtrl:generate">
    <div class="modal-data w3-padding w3-section w3-card w3-border">
        <button class="restore-settings w3-button w3-section w3-right w3-margin-right w3-theme-action" type="button">
            <i class="fa fa-history"></i>
            Restore last settings
        </button>
        <header><h3>ENTITY INFORMATION</h3></header>
        <p><i>Enter both the name and properties of the entity to manage (create, read, edit and remove).</i></p>
        <label>
            <b>Entity name</b>
            <input class="w3-input w3-border w3-margin-bottom" name="entity_name" type="text" maxlength="25" required placeholder="For example, Customer, Book, Vehicule, Equipment, Meeting, Task etc.">
        </label>
        <fieldset>
            <legend><b class="zdk-required">Entity properties</b></legend>
            <div class="input-container"></div>
            <button class="add-input w3-button w3-theme-action w3-section" type="button"><i class="fa fa-plus-circle"></i> Add property</button>
        </fieldset>
        <template class="input-row-tpl">
            <div class="input-row  w3-margin-top w3-border-bottom">
                <div class="w3-row-padding w3-stretch">
                    <div class="w3-col l3">
                        <label>
                            <b>Label</b>
                            <input class="w3-input w3-border w3-margin-bottom" name="input_label[]" type="text" maxlength="40" required placeholder="Label displayed for the input">
                        </label>
                    </div>
                    <div class="name w3-col l3">
                        <label>
                            <b>Input name</b>
                            <input class="w3-input w3-border w3-margin-bottom" name="input_name[]" type="text" maxlength="40" required spellcheck="false" placeholder="Value of the 'name' attribute">
                        </label>
                    </div>
                    <div class="type w3-col l2">
                        <label>
                            <b>Type</b>
                            <select class="w3-select w3-border w3-margin-bottom" name="input_type[]">
<?php $inputTypes = z4m_codegen\mod\controller\z4mCodeGenCtrl::$inputTypes;
 foreach ($inputTypes as $value => $label) : ?>
                               <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
<?php endforeach; ?>
                            </select>
                        </label>
                    </div>
                    <div class="values w3-col l3 w3-hide">
                        <label>
                            <b class="zdk-required">Values</b>
                            <input class="w3-input w3-border w3-margin-bottom" name="input_values[]" type="text" maxlength="500" spellcheck="false" placeholder="Comma separated values">
                        </label>
                    </div>
                    <div class="w3-col l2">
                        <label>
                            <b>Is required?</b>
                            <select class="w3-select w3-border w3-margin-bottom" name="input_is_required[]">
                                <option value="">No</option>
                                <option value="required">Yes</option>
                            </select>
                        </label>
                    </div>
                    <div class="w3-col l1">
                        <div>&nbsp;</div>
                        <button class="remove w3-button w3-theme-action w3-margin-bottom" type="button" title="Remove property">
                            <i class="fa fa-trash"></i>
                            <span class="w3-hide-large">Remove</span>
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </div>
    <div class="modal-data w3-padding w3-section w3-card w3-border">
        <header><h3>CODE TO GENERATE</h3></header>
        <label>
            <b>Icon</b>
            <input class="w3-input w3-border w3-margin-bottom" name="view_icon" type="search" maxlength="20" required placeholder="Icon to display for the menu item and the modal dialog">
        </label>
        <label>
            <b>HTML element ID prefix</b>
            <input class="w3-input w3-border w3-margin-bottom" name="element_id_prefix" type="text" maxlength="25" spellcheck="false" required placeholder="Prefix given to the HTML element identifiers">
        </label>
        <label>
            <b>Controller name</b>
            <input class="w3-input w3-border w3-margin-bottom" name="controller_name" type="text" maxlength="30" spellcheck="false" required placeholder="PHP App Controller connected to the entity data form">
        </label>
        <label>
            <b>SQL table name</b>
            <input class="w3-input w3-border w3-margin-bottom" name="sql_table_name" type="text" maxlength="30" spellcheck="false" required placeholder="SQL table name for storing the entity records">
        </label>
        <fieldset class="w3-margin-bottom">
            <legend><b>Code location</b></legend>
            <label class="w3-margin-right w3-mobile">
                <input class="w3-radio" name="code_location" type="radio" value="module" checked>
                Module (easy to install)
            </label>
            <label>
                <input class="w3-radio" name="code_location" type="radio" value="app">
                Application
            </label>
        </fieldset>
        <fieldset class="w3-margin-bottom">
            <legend><b>Model class</b></legend>
            <label class="w3-margin-right w3-mobile">
                <input class="w3-radio" name="model_class" type="radio" value="simpledao" checked>
                SimpleDAO (less code)
            </label>
            <label>
                <input class="w3-radio" name="model_class" type="radio" value="dao">
                DAO
            </label>
        </fieldset>
        <div class="w3-margin-bottom">
            <label>
                <input id="z4m-codegen-form-memorize-settings" class="w3-check" type="checkbox">
                Memorize this settings locally in your web browser
            </label>
        </div>
    </div>
    <button class="generate-code w3-button w3-block w3-green w3-section w3-padding">
                <i class="fa fa-check-circle-o fa-lg"></i>&nbsp;
                Get the code
    </button>
    <div class="w3-bar">
        <button class="reset w3-button w3-right w3-theme-action w3-section" type="button">
            <i class="fa fa-eraser"></i>
            Reset all
        </button>
    </div>
</form>
<div class="w3-padding-16"></div>
<div id="z4m-codegen-result" class="w3-content w3-hide">
    <div class="w3-card w3-padding w3-border">
        <header><h3>RESULT</h3></header>
        <button class="download w3-button w3-theme w3-section" type="button" data-url="<?php echo General::getURIforDownload('z4mCodeGenCtrl'); ?>">
            <i class="fa fa-download"></i> Download full code
        </button>
        <div class="install-note w3-panel w3-theme-l4">
            <h4><i class="fa fa-info-circle"></i> INSTALLATION NOTE</h4>
            <ol>
                <li>Download the CRUD code by clicking the <b>Download full code</b> button.</li>
                <li>Unzip the ZIP archive content within the <code class="code-target w3-codespan"></code> subdirectory of your Application.</li>
                <li>Edit the <code class="w3-codespan">applications/default/app/menu.php</code> of your Application and add the following line:<br><code class="menu-include-statement w3-codespan"></code></li>
                <li>Open the App's database in <b>phpMyAdmin</b> and import the <code class="sql-script-path w3-codespan"></code> SQL script.</li>
                <li>Reload your App in the web browser, click on the <b class="menu-item-name"></b> menu item and enjoy your code.</li>
            </ol>
        </div>
        <div class="code-container"></div>
        <template class="code-tpl">
            <div class="code-detail w3-padding-16">
                <div class="w3-row">
                    <div class="w3-threequarter">
                        <span class="title w3-tag w3-theme"></span>
                    </div>
                    <div class="w3-quarter">
                        <button class="paste-to-clipboard w3-button w3-theme-action w3-right"><i class="fa fa-paste"></i> Copy to clipboard</button>
                    </div>
                </div>
                <code>
                    <pre class="code w3-border w3-border-theme w3-padding-small" style="max-height:300px;overflow:auto"></pre>
                </code>
            </div>
        </template>
    </div>
</div>
<div id="icons"></div>
<script>
<?php if (CFG_VIEW_PAGE_RELOAD) : ?>
document.addEventListener("DOMContentLoaded", function(){
<?php else : ?>
$(function(){
<?php endif; ?>
    // INIT
    addNewProperty();
    // EVENTS
    // Restore last settings
    $('#z4m-codegen-form button.restore-settings').on('click', function(){
        restoreSettings();
    });
    // Add new entity property
    $('#z4m-codegen-form button.add-input').on('click', function(){
        const newRow = addNewProperty();
        const inputLabelEl = newRow.find('input[name="input_label[]"]');
        inputLabelEl.trigger('focus');
    });
    function resetProperties() {
        $('#z4m-codegen-form .input-container').empty();
    }
    function addNewProperty(values) {
        const newRow = $('#z4m-codegen-form .input-row-tpl').contents().filter('div').clone();
        if (typeof values === 'object' && !Array.isArray(values) && values !== null) {
            for (const property in values) {
                const inputEl = newRow.find('[name="' + property +'"]');
                inputEl.val(values[property]);
            }
        }
        newRow.appendTo($('#z4m-codegen-form .input-container'));
        return newRow;
    }
    // Remove entity property
    $('#z4m-codegen-form').on('click', 'button.remove', function(){
        $(this).closest('.input-row').remove();
        $('#z4m-codegen-form button.add-input').trigger('focus');
    });
    // Change type property
    $('#z4m-codegen-form').on('change', 'select[name="input_type[]"]', function(){
        const inputRowEl = $(this).closest('.input-row'),
            valuesColEl = inputRowEl.find('.w3-col.values'),
            nameColEl = inputRowEl.find('.w3-col.name'),
            typeColEl = inputRowEl.find('.w3-col.type');
        if ($(this).val() === 'select' || $(this).val() === 'radio_group') {
            valuesColEl.removeClass('w3-hide');
            nameColEl.removeClass('l3').addClass('l2');
            typeColEl.removeClass('l2').addClass('l1');
            inputRowEl.find('input[name="input_values[]"]').trigger('focus');
        } else {
            valuesColEl.addClass('w3-hide');
            nameColEl.removeClass('l2').addClass('l3');
            typeColEl.removeClass('l1').addClass('l2');
        }
    });
    // Icon autocomplete
    z4m.autocomplete.make('#z4m-codegen-form input[name=view_icon]', {
        controller: 'z4mCodeGenCtrl',
        action: 'icons'
    }, null, function(item){
        return item.label + ' <i class="fa fa-' + item.label + '"></i>';
    });
    // Autocomplete element ID prefix from entity name
    $('#z4m-codegen-form input[name="element_id_prefix"]').on('focus', function() {
        if ($(this).val() === '') {
            const label = $('#z4m-codegen-form input[name="entity_name"]').val();
            $(this).val(convertLabelToName(label, '-'));
        }
    });
    // Autocomplete Controller name from entity name
    $('#z4m-codegen-form input[name="controller_name"]').on('focus', function() {
        if ($(this).val() === '') {
            const label = $('#z4m-codegen-form input[name="entity_name"]').val();
            $(this).val(convertToPascalCase(label)+'Ctrl');
        }
    });
    // Autocomplete SQL table name from entity name
    $('#z4m-codegen-form input[name="sql_table_name"]').on('focus', function() {
        if ($(this).val() === '') {
            const label = $('#z4m-codegen-form input[name="entity_name"]').val();
            $(this).val(convertLabelToName(label, '_') + 's');
        }
    });
    // Autocomplete input name from input label
    $('#z4m-codegen-form').on('focus', 'input[name="input_name[]"]', function() {
        if ($(this).val() === '') {
            const label = $(this).closest('.input-row').find('input[name="input_label[]"]').val();
            $(this).val(convertLabelToName(label));
        }
    });
    function convertLabelToName(label, replaceWhitespaceBy) {
        if (replaceWhitespaceBy === undefined) {
            replaceWhitespaceBy = '_';
        }
        let name = label.toLowerCase();
        name = name.replace(/[^a-z0-9 ]/g, '');
        return name.replaceAll(' ', replaceWhitespaceBy);
    }
    function convertToPascalCase(label) {
        label = convertLabelToName(label, ' ');
        const pascalCase = label.replace(/(\w)(\w*)/g, function(g0,g1,g2){
            return g1.toUpperCase() + g2.toLowerCase();
        });
        return pascalCase.replaceAll(' ', '');
    }
    // Generate code
    const codeForm = z4m.form.make('#z4m-codegen-form', onSubmit);
    function onSubmit(response) {
        if (response.success === true && Array.isArray(response.codes)) {
            const codeContainer = $('#z4m-codegen-result .code-container');
            codeContainer.empty();
            response.codes.forEach(function(code){
                const newCode = $('#z4m-codegen-result .code-tpl').contents().filter('.code-detail').clone();
                newCode.find('.title').text(code.fileName);
                newCode.find('pre').text(code.text);
                newCode.appendTo(codeContainer);
            });
            updateInstallationNoteData(response.install_infos);
            $('#z4m-codegen-result').removeClass('w3-hide');
            $('#z4m-codegen-result')[0].scrollIntoView();
            memorizeSettings();
        } else {
            $('#z4m-codegen-result').addClass('w3-hide');
            //codeForm.showError('Code generation has failed.', undefined, true);
        }
    }
    // Paste to clipboard
    $('#z4m-codegen-result').on('click', 'button.paste-to-clipboard', function(){
        const code = $(this).closest('.code-detail').find('pre').text();
        copyToClipboard(code);
    });
    async function copyToClipboard(code) {
        try {
            await navigator.clipboard.writeText(code);
            z4m.messages.showSnackbar('Code copied to clipboard.');
        } catch (error) {
            z4m.messages.showSnackbar('Copy to clipboard has failed.', true);
        }
    }
    // Download full source code
    $('#z4m-codegen-result button.download').on('click', function(){
        const url = $(this).data('url');
        z4m.file.display(url);
    });
    // Reset form
    $('#z4m-codegen-form button.reset').on('click', function(){
        const formObj = z4m.form.make('#z4m-codegen-form');
        formObj.reset();
        resetProperties();
        addNewProperty();
        formObj.setFocus('entity_name');
    });
    // Update installation note
    function updateInstallationNoteData(infos) {
        const installNoteContainer = $('#z4m-codegen-result .install-note');
        installNoteContainer.find('.code-target').text(infos.codeTarget);
        installNoteContainer.find('.menu-include-statement').text(infos.menuIncludeStatement);
        installNoteContainer.find('.sql-script-path').text(infos.sqlScriptPath);
        installNoteContainer.find('.menu-item-name').text(infos.menuItemName);
    }
    // Memorize form values in local settings
    function memorizeSettings() {
        if ($('#z4m-codegen-form-memorize-settings').is(':checked')) {
            const formData = new FormData(document.getElementById('z4m-codegen-form'));
            const JSONFormData = formDataToJSON(formData);
            z4m.browser.storeLocalData('z4m_codegen_settings', JSONFormData);
        } else {
            //z4m.browser.removeLocalData('z4m_codegen_settings');
        }
    }
    function formDataToJSON(formData) {
        let output = {};
        formData.forEach(function(value, key) {
            // Check if property already exist
            if (Object.prototype.hasOwnProperty.call(output, key) ) {
                let current = output[key];
                if (!Array.isArray(current)) {
                  // If it's not an array, convert it to an array.
                  current = output[key] = [current];
                }
                current.push(value); // Add the new value to the array.
            } else {
                output[key] = value;
            }
        });
        return JSON.stringify(output);
    }
    // restore form values from local settings
    function restoreSettings() {
        const JSONFormData = z4m.browser.readLocalData('z4m_codegen_settings');
        const formData = JSON.parse(JSONFormData);
        if (formData === false) {
            z4m.messages.showSnackbar('No settings to restore.', true);
            return;
        }
        const formObj = z4m.form.make('#z4m-codegen-form');
        let detailInputs = [];
        for (const property in formData) {
            if (Array.isArray(formData[property])) {
                formData[property].forEach(function(value, index){
                    if(detailInputs.length < index + 1) {
                        detailInputs[index] = {};
                    }                    
                    detailInputs[index][property] = value;
                });
            } else {
                const formObj = z4m.form.make('#z4m-codegen-form');
                formObj.setInputValue(property, formData[property]);
            }
        }
        resetProperties();
        detailInputs.forEach(function(property){
            addNewProperty(property);
        });
    }
});
</script>