<?php
/**
 * Provide a admin area view for editing a company
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @since      1.0.0
 * @package    FCC_BCL
 * @subpackage FCC_BCL/admin/partials
 */

// Check user capabilities
if (!current_user_can('manage_options')) {
    return;
}

// Process form submission
if (isset($_POST['fcc_bcl_edit_company'])) {
    // Verify nonce
    if (!isset($_POST['fcc_bcl_edit_company_nonce']) || !wp_verify_nonce($_POST['fcc_bcl_edit_company_nonce'], 'fcc_bcl_edit_company')) {
        wp_die('Security check failed');
    }

    // Process and sanitize form data
    $company_data = $this->process_company_form_data($_POST);

    // Save company data to database
    $result = $this->save_company_data($company_data, $company['id']);

    if ($result) {
        add_settings_error('fcc_bcl_messages', 'fcc_bcl_message', __('Company updated successfully', 'fcc-bcl'), 'updated');
    } else {
        add_settings_error('fcc_bcl_messages', 'fcc_bcl_message', __('Error updating company', 'fcc-bcl'), 'error');
    }

    // Refresh company data after update
    $company = $this->get_company_by_id($company['id']);
}
?>

<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <?php settings_errors('fcc_bcl_messages'); ?>
    
    <?php _e('Update the company\'s information below. Any changes made here will be reflected in the shared data used during label creation.', 'fcc-bcl'); ?> 
    <form method="post" action="">
        <?php wp_nonce_field('fcc_bcl_edit_company', 'fcc_bcl_edit_company_nonce'); ?>
        <table class="form-table">
            <tr>
                <th scope="row"><label for="company_name"><?php _e('Company Name', 'fcc-bcl'); ?></label></th>
                <td><input type="text" name="company_name" id="company_name" class="regular-text" value="<?php echo esc_attr($company['company_name']); ?>" placeholder="<?php _e('Enter company name', 'fcc-bcl'); ?>" required></td>
            </tr>
            <tr>
                <th scope="row"><label for="customer_support_url"><?php _e('Customer Support URL', 'fcc-bcl'); ?></label></th>
                <td><input type="url" name="customer_support_url" id="customer_support_url" class="regular-text" value="<?php echo esc_url($company['customer_support_url']); ?>" placeholder="<?php _e('https://example.com/support', 'fcc-bcl'); ?>" required></td>
            </tr>
            <tr>
                <th scope="row"><label for="customer_support_phone"><?php _e('Customer Support Phone', 'fcc-bcl'); ?></label></th>
                <td><input type="tel" name="customer_support_phone" id="customer_support_phone" class="regular-text" value="<?php echo esc_attr($company['customer_support_phone']); ?>" placeholder="<?php _e('123-456-7890', 'fcc-bcl'); ?>" pattern="[\d]{3}-[\d]{3}-[\d]{4}" title="<?php _e('Phone number should be in the format 123-456-7890', 'fcc-bcl'); ?>" required></td>
            </tr>
            <tr>
                <th scope="row"><label for="network_management_url"><?php _e('Network Management URL', 'fcc-bcl'); ?></label></th>
                <td><input type="url" name="network_management_url" id="network_management_url" class="regular-text" value="<?php echo esc_url($company['network_management_url']); ?>" placeholder="<?php _e('https://example.com/network', 'fcc-bcl'); ?>" required></td>
            </tr>
            <tr>
                <th scope="row"><label for="privacy_policy_url"><?php _e('Privacy Policy URL', 'fcc-bcl'); ?></label></th>
                <td><input type="url" name="privacy_policy_url" id="privacy_policy_url" class="regular-text" value="<?php echo esc_url($company['privacy_policy_url']); ?>" placeholder="<?php _e('https://example.com/privacy', 'fcc-bcl'); ?>" required></td>
            </tr>
            <tr>
                <th scope="row"><label for="contract_url"><?php _e('Contract URL', 'fcc-bcl'); ?></label></th>
                <td><input type="url" name="contract_url" id="contract_url" class="regular-text" value="<?php echo esc_url($company['contract_url']); ?>" placeholder="<?php _e('https://example.com/contract', 'fcc-bcl'); ?>"></td>
            </tr>
            <tr>
                <th scope="row"><label for="fcc_frn"><?php _e('FCC FRN', 'fcc-bcl'); ?></label></th>
                <td><input type="text" name="fcc_frn" id="fcc_frn" class="regular-text" value="<?php echo esc_attr($company['fcc_frn']); ?>" placeholder="<?php _e('Enter FCC FRN', 'fcc-bcl'); ?>" required></td>
            </tr>
        </table>
        <p class="submit">
            <?php submit_button(__('Update Company', 'fcc-bcl'), 'primary', 'fcc_bcl_edit_company', false); ?>
            <a href="<?php echo esc_url(admin_url('admin.php?page=fcc-bcl-companies')); ?>" class="button button-secondary"><?php _e('Cancel', 'fcc-bcl'); ?></a>
        </p>
    </form>
</div>
