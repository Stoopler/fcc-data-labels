<div class="fcc-bcl-form-section">
    <h2><?php _e('Plan Contract', 'fcc-bcl'); ?></h2>
    <div class="fcc-bcl-form-row">
        <label for="contract_duration"><?php _e('Contract Length (months)', 'fcc-bcl'); ?></label>
        <input type="number" name="contract_duration" id="contract_duration" min="0">
    </div>
    <div class="fcc-bcl-form-row">
        <label for="contract_url"><?php _e('Contract Terms URL', 'fcc-bcl'); ?></label>
        <input type="url" name="contract_url" id="contract_url">
    </div>
    <div class="fcc-bcl-form-row">
        <label for="early_termination_fee"><?php _e('Early Termination Fee', 'fcc-bcl'); ?></label>
        <input type="number" name="early_termination_fee" id="early_termination_fee" step="0.01" min="0">
    </div>
</div>