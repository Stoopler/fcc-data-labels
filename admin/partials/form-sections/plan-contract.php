<div class="fcc-bcl-form-section">
    <h3><?php _e('Plan Contract', 'fcc-bcl'); ?></h3>
    
    <label for="contract_duration"><?php _e('Contract Length (months)', 'fcc-bcl'); ?></label>
    <input type="number" name="contract_duration" id="contract_duration" value="<?php echo esc_attr($label_data['contract_duration'] ?? ''); ?>">

    <label for="contract_url"><?php _e('Contract Terms URL', 'fcc-bcl'); ?></label>
    <input type="url" name="contract_url" id="contract_url" value="<?php echo esc_attr($label_data['contract_url'] ?? ''); ?>">

    <label for="early_termination_fee"><?php _e('Early Termination Fee ($)', 'fcc-bcl'); ?></label>
    <input type="number" step="0.01" name="early_termination_fee" id="early_termination_fee" value="<?php echo esc_attr($label_data['early_termination_fee'] ?? ''); ?>">
</div>
