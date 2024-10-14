<div class="fcc-bcl-form-section">
    <h3><?php _e('Plan Pricing', 'fcc-bcl'); ?></h3>
    
    <label for="data_service_price"><?php _e('Monthly Price ($)', 'fcc-bcl'); ?></label>
    <input type="number" step="0.01" name="data_service_price" id="data_service_price" value="<?php echo esc_attr($label_data['data_service_price'] ?? ''); ?>" required>

    <label for="introductory_price_per_month"><?php _e('Introductory Price ($)', 'fcc-bcl'); ?></label>
    <input type="number" step="0.01" name="introductory_price_per_month" id="introductory_price_per_month" value="<?php echo esc_attr($label_data['introductory_price_per_month'] ?? ''); ?>">

    <label for="introductory_period_in_months"><?php _e('Introductory Period (months)', 'fcc-bcl'); ?></label>
    <input type="number" name="introductory_period_in_months" id="introductory_period_in_months" value="<?php echo esc_attr($label_data['introductory_period_in_months'] ?? ''); ?>">
</div>
