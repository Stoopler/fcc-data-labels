<?php
/**
 * Provide a admin area view for the plugin configuration
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
?>

<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    
    <p><?php _e('Welcome to the FCC Broadband Consumer Labels configuration page. Here you can manage your companies and their associated labels.', 'fcc-bcl'); ?></p>
    
    <h2><?php _e('Quick Links', 'fcc-bcl'); ?></h2>
    <ul>
        <li><a href="<?php echo esc_url(admin_url('admin.php?page=fcc-bcl-view-companies')); ?>"><?php _e('View Companies', 'fcc-bcl'); ?></a></li>
        <li><a href="<?php echo esc_url(admin_url('admin.php?page=fcc-bcl-add-company')); ?>"><?php _e('Add New Company', 'fcc-bcl'); ?></a></li>
    </ul>
</div>