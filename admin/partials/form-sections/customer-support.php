<div class="fcc-bcl-form-section">
    <h3><?php _e('Customer Support', 'fcc-bcl'); ?></h3>
    
    <label for="customer_support_url"><?php _e('Customer Support URL', 'fcc-bcl'); ?></label>
    <input type="url" name="customer_support_url" id="customer_support_url" value="<?php echo esc_attr($label_data['customer_support_url'] ?? ''); ?>">

    <label for="customer_support_phone"><?php _e('Customer Support Phone', 'fcc-bcl'); ?></label>
    <input type="tel" name="customer_support_phone" id="customer_support_phone" value="<?php echo esc_attr($label_data['customer_support_phone'] ?? ''); ?>">
</div>
