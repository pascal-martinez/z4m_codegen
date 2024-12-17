<?php
/**
 * Data list
 * Code Generated by the Code Generator module of ZnetDK 4 Mobile.
 */
$color = defined('CFG_MOBILE_W3CSS_THEME_COLOR_SCHEME') 
        ? CFG_MOBILE_W3CSS_THEME_COLOR_SCHEME
        : ['content' => 'w3-theme-light', 'modal_content' => 'w3-theme-light',
            'list_border_bottom' => 'w3-border-theme', 'msg_error' => 'w3-red',
            'modal_header' => 'w3-theme-dark', 'btn_hover' => 'w3-hover-theme',
            'modal_footer_border_top' => 'w3-border-theme',
            'modal_footer' => 'w3-theme-l4', 'btn_cancel' => 'w3-red',
            'btn_action' => 'w3-theme-action', 'btn_submit' => 'w3-green'
        ];
?>
<style>
    /*#{{ELEMENT_ID_PREFIX}}*/-list-header {
        position: sticky;
    }
    /*#{{ELEMENT_ID_PREFIX}}*/-list-header li {
        padding-top: 0;
        padding-bottom: 0;
    }
</style>
<!-- Header -->
<div id="{{ELEMENT_ID_PREFIX}}-list-header" class="w3-row <?php echo $color['content']; ?> w3-hide-small w3-hide-medium w3-border-bottom <?php echo $color['list_border_bottom']; ?>">
{{DATALIST_HEADER_COLUMNS}}
</div>
<!-- Data List -->
<ul id="{{ELEMENT_ID_PREFIX}}-list" class="w3-ul w3-hide w3-margin-bottom"{{LOAD_ACTION}}{{AUTOCOMPLETE_ACTION}}>
    <li class="<?php echo $color['list_border_bottom']; ?> w3-hover-light-grey" data-id="{{id}}">
        <div class="w3-row w3-stretch">
{{DATALIST_ROWS}}
        </div>
    </li>
    <li><h3 class="<?php echo $color['msg_error']; ?> w3-center w3-stretch"><i class="fa fa-frown-o"></i>&nbsp;<?php echo LC_MSG_INF_NO_RESULT_FOUND; ?></h3></li>
</ul>
<!-- Modal dialog for adding and editing -->
{{MODAL_DIALOG}}
<script>
<?php if (CFG_DEV_JS_ENABLED) : ?>
    console.log("'{{VIEW_NAME}}' ** For debug purpose **");
<?php endif; ?>
    $(function(){
        var dataList = z4m.list.make('#{{ELEMENT_ID_PREFIX}}-list', false, true);
        dataList.setModal('#{{ELEMENT_ID_PREFIX}}-modal', true, function(innerForm){
            // NEW
            this.setTitle('New {{ENTITY_NAME}}');
            // The remove button is hidden
            this.element.find('button.remove').addClass('w3-hide');
        }, function(innerForm, formData) {
            // EDIT
            if (formData.hasOwnProperty('warning')) {
                // This row no longer exists in database
                z4m.messages.showSnackbar(formData.msg, true);
                return false;
            }
            this.setTitle('Edit {{ENTITY_NAME}} #' + formData.id);
            // The remove button is shown
            this.element.find('button.remove').removeClass('w3-hide');
        });
        // Click on remove button
        $('#{{ELEMENT_ID_PREFIX}}-modal button.remove').on('click', function() {
            const modal = z4m.modal.make('#{{ELEMENT_ID_PREFIX}}-modal'),
                innerForm = modal.getInnerForm(),
                entityId = innerForm.getInputValue('id');
            z4m.messages.ask("Deleting {{ENTITY_NAME}} #" + entityId,
                    "<?php echo LC_MSG_ASK_REMOVE; ?>", {yes: "<?php echo LC_BTN_YES; ?>",
                    no: "<?php echo LC_BTN_NO; ?>"}, function(isYes) {
                if (!isYes) {
                    return;
                }
                z4m.ajax.request({
                    controller: '{{CONTROLLER_NAME}}',
                    action: 'remove',
                    data: {id: entityId},
                    callback: function(response) {
                        if (response.success) { // Success
                            // The list is refreshed
                            dataList.refresh();
                            // The modal is closed
                            modal.close();
                            // The removal notification shown
                            z4m.messages.showSnackbar(response.msg);
                        } else { // Error
                            innerForm.showError(response.msg, null, true);
                        }
                    }
                });
            });
        });
    });
</script>