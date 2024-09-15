<div class="fcc-bcl-form-section">
    <h2><?php _e('Plan Information', 'fcc-bcl'); ?></h2>
    <div class="fcc-bcl-form-row">
        <label for="company_id"><?php _e('Provider Name', 'fcc-bcl'); ?></label>
        <select name="company_id" id="company_id" required>
            <option value=""><?php _e('Select a company', 'fcc-bcl'); ?></option>
            <?php foreach ($companies as $company): ?>
                <option value="<?php echo esc_attr($company['id']); ?>"><?php echo esc_html($company['company_name']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="fcc-bcl-form-row">
        <label for="data_service_name"><?php _e('Service Plan Name', 'fcc-bcl'); ?></label>
        <input type="text" name="data_service_name" id="data_service_name" required>
    </div>
    <div class="fcc-bcl-form-row">
        <label for="data_service_id"><?php _e('Service Plan ID', 'fcc-bcl'); ?></label>
        <input type="text" name="data_service_id" id="data_service_id" maxlength="15" required>
    </div>
    <div class="fcc-bcl-form-row">
        <label for="fixed_or_mobile"><?php _e('Technology', 'fcc-bcl'); ?></label>
        <select name="fixed_or_mobile" id="fixed_or_mobile" required>
            <option value=""><?php _e('Select', 'fcc-bcl'); ?></option>
            <option value="Fixed"><?php _e('Fixed', 'fcc-bcl'); ?></option>
            <option value="Mobile"><?php _e('Mobile', 'fcc-bcl'); ?></option>
        </select>
    </div>
</div>