        <form class="w3-container <?php echo $color['modal_content']; ?>"{{LOAD_ACTION}}{{SUBMIT_ACTION}}>
            <input type="hidden" name="id">
            <div class="w3-section">
{{INPUTS}}
            </div>
            <!-- Submit button -->
            <p class="w3-padding"></p>
            <button class="w3-button w3-block <?php echo $color['btn_submit']; ?> w3-section w3-padding" type="submit">
                <i class="fa fa-save fa-lg"></i>&nbsp;
                <?php echo LC_BTN_SAVE; ?>
            </button>
        </form>