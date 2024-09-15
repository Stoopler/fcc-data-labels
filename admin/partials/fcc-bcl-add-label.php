<?php
/**
 * Provide a admin area view for adding a new label
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

// Get all companies for the dropdown
$companies = $this->get_companies();
?>

<div class="wrap fcc-bcl-form">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <?php settings_errors('fcc_bcl_messages'); ?>
    
    <div class="fcc-bcl-form-container">
        <form method="post" action="" class="fcc-bcl-form-inputs">
            <?php wp_nonce_field('fcc_bcl_add_label', 'fcc_bcl_add_label_nonce'); ?>
            
            <div class="fcc-bcl-form-column">
                <?php $this->render_plan_information($companies); ?>
                <?php $this->render_plan_speed(); ?>
                <?php $this->render_plan_data(); ?>
            </div>

            <div class="fcc-bcl-form-column">
                <?php $this->render_plan_pricing(); ?>
                <?php $this->render_plan_contract(); ?>
                <?php $this->render_customer_support(); ?>
            </div>

            <div class="fcc-bcl-form-column">
                <?php $this->render_monthly_fees(); ?>
                <?php $this->render_onetime_fees(); ?>
                <?php $this->render_discounts_and_bundles(); ?>
            </div>

            <?php submit_button(__('Add Label', 'fcc-bcl'), 'primary', 'fcc_bcl_add_label'); ?>
        </form>

        <div class="fcc-bcl-form-preview">
            <h2><?php _e('Label Preview', 'fcc-bcl'); ?></h2>
            <div id="label-preview"></div>
        </div>
    </div>
</div>