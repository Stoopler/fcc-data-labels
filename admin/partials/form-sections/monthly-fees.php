<div class="fcc-bcl-form-section">
    <h2><?php _e('Monthly Fees', 'fcc-bcl'); ?></h2>
    <div id="monthly-fees-container">
        <div class="fcc-bcl-form-row monthly-fee-row">
            <input type="text" name="monthly_fee_name[]" placeholder="<?php _e('Fee Name', 'fcc-bcl'); ?>">
            <input type="number" name="monthly_fee_price[]" step="0.01" min="0" placeholder="<?php _e('Fee Price', 'fcc-bcl'); ?>">
            <button type="button" class="remove-fee"><?php _e('Remove', 'fcc-bcl'); ?></button>
        </div>
    </div>
    <button type="button" id="add-monthly-fee"><?php _e('Add Monthly Fee', 'fcc-bcl'); ?></button>
</div>