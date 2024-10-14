<div class="fcc-bcl-form-section">
    <h3><?php _e('Plan Data', 'fcc-bcl'); ?></h3>
     
    <label for="data_included_in_monthly_price"><?php _e('Data Included (GB)', 'fcc-bcl'); ?></label>
    <input type="number" name="data_included_in_monthly_price" id="data_included_in_monthly_price" min="0" value="<?php echo esc_attr($label_data['data_included_in_monthly_price'] ?? ''); ?>">
 
    <label for="overage_fee"><?php _e('Overage Fee ($)', 'fcc-bcl'); ?></label>
    <input type="number" step="0.01" name="overage_fee" id="overage_fee" min="0" value="<?php echo esc_attr($label_data['overage_fee'] ?? ''); ?>">
 
    <label for="overage_data_amount"><?php _e('Overage Data Amount (GB)', 'fcc-bcl'); ?></label>
    <input type="number" name="overage_data_amount" id="overage_data_amount" min="0" value="<?php echo esc_attr($label_data['overage_data_amount'] ?? ''); ?>">
</div>
