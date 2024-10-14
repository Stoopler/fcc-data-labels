<div class="fcc-bcl-form-section">
    <h3><?php _e('Discounts & Bundles', 'fcc-bcl'); ?></h3>
    
    <label for="discounts_and_bundles_url"><?php _e('Discounts and Bundles URL', 'fcc-bcl'); ?></label>
    <input type="url" name="discounts_and_bundles_url" id="discounts_and_bundles_url" value="<?php echo esc_attr($label_data['discounts_and_bundles_url'] ?? ''); ?>">

    <label for="acp"><?php _e('ACP', 'fcc-bcl'); ?></label>
    <select name="acp" id="acp">
        <option value=""><?php _e('Select', 'fcc-bcl'); ?></option>
        <option value="yes" <?php selected($label_data['acp'] ?? '', 'yes'); ?>><?php _e('Yes', 'fcc-bcl'); ?></option>
        <option value="no" <?php selected($label_data['acp'] ?? '', 'no'); ?>><?php _e('No', 'fcc-bcl'); ?></option>
    </select>
</div>
