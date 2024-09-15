<div class="fcc-bcl-form-section">
    <h2><?php _e('One-time Fees', 'fcc-bcl'); ?></h2>
    <div id="onetime-fees-container">
        <div class="fcc-bcl-form-row onetime-fee-row">
            <input type="text" name="onetime_fee_name[]" placeholder="<?php _e('Fee Name', 'fcc-bcl'); ?>">
            <input type="number" name="onetime_fee_price[]" step="0.01" min="0" placeholder="<?php _e('Fee Price', 'fcc-bcl'); ?>">
            <button type="button" class="remove-fee"><?php _e('Remove', 'fcc-bcl'); ?></button>
        </div>
    </div>
    <button type="button" id="add-onetime-fee"><?php _e('Add One-time Fee', 'fcc-bcl'); ?></button>
</div>