<?php
/**
 * Provide a admin area view for company configuration
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

// Get all companies
$companies = $this->get_companies();
?>

<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?> <a href="<?php echo esc_url(admin_url('admin.php?page=fcc-bcl-add-company')); ?>" class="page-title-action"><?php _e('Add Company', 'fcc-bcl'); ?></a></h1>

    <?php if (empty($companies)): ?>
        <p><?php _e('You have no configured companies.', 'fcc-bcl'); ?></p>
    <?php else: ?>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th><?php _e('ID', 'fcc-bcl'); ?></th>
                    <th><?php _e('Company Name', 'fcc-bcl'); ?></th>
                    <th><?php _e('Customer Support Phone', 'fcc-bcl'); ?></th>
                    <th><?php _e('FCC FRN', 'fcc-bcl'); ?></th>
                    <th><?php _e('Actions', 'fcc-bcl'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($companies as $company): ?>
                    <tr>
                        <td><?php echo esc_html($company['id']); ?></td>
                        <td><?php echo esc_html($company['company_name']); ?></td>
                        <td><?php echo esc_html($company['customer_support_phone']); ?></td>
                        <td><?php echo esc_html($company['fcc_frn']); ?></td>
                        <td>
                            <a href="<?php echo esc_url(admin_url('admin.php?page=fcc-bcl-edit-company&id=' . $company['id'])); ?>"><?php _e('Edit', 'fcc-bcl'); ?></a> |
                            <a href="<?php echo esc_url(wp_nonce_url(admin_url('admin.php?page=fcc-bcl-companies&action=delete&id=' . $company['id']), 'delete_company_' . $company['id'])); ?>" onclick="return confirm('<?php _e('Are you sure you want to delete this company?', 'fcc-bcl'); ?>');"><?php _e('Delete', 'fcc-bcl'); ?></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>