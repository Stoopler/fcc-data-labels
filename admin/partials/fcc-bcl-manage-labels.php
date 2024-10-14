<?php
/**
 * Provide a admin area view for managing labels
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

// Get all labels
$labels = $this->get_all_labels();
?>

<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th><?php _e('ID', 'fcc-bcl'); ?></th>
                <th><?php _e('Company', 'fcc-bcl'); ?></th>
                <th><?php _e('Service Name', 'fcc-bcl'); ?></th>
                <th><?php _e('Shortcode', 'fcc-bcl'); ?></th>
                <th><?php _e('Actions', 'fcc-bcl'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($labels as $label): ?>
                <tr>
                    <td><?php echo esc_html($label['id']); ?></td>
                    <td><?php echo esc_html($label['company_name']); ?></td>
                    <td><?php echo esc_html($label['data_service_name']); ?></td>
                    <td><code>[fcc_bcl id="<?php echo esc_attr($label['id']); ?>"]</code></td>
                    <td>
                        <a href="<?php echo esc_url(admin_url('admin.php?page=fcc-bcl-edit-label&id=' . $label['id'])); ?>"><?php _e('Edit', 'fcc-bcl'); ?></a> |
                        <a href="<?php echo esc_url(wp_nonce_url(admin_url('admin.php?page=fcc-bcl-manage-labels&action=delete&id=' . $label['id']), 'delete_label_' . $label['id'])); ?>" onclick="return confirm('<?php _e('Are you sure you want to delete this label?', 'fcc-bcl'); ?>');"><?php _e('Delete', 'fcc-bcl'); ?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
