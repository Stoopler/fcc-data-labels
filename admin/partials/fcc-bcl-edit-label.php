<?php
/**
 * Provide a admin area view for editing a label
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

<div class="wrap fcc-bcl-form">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <?php settings_errors('fcc_bcl_messages'); ?>
    
    <div class="fcc-bcl-form-container">
        <form method="post" action="" class="fcc-bcl-form-inputs">
            <?php wp_nonce_field('fcc_bcl_edit_label', 'fcc_bcl_edit_label_nonce'); ?>
            <input type="hidden" name="label_id" value="<?php echo esc_attr($label_data['id']); ?>">
            
            <div class="fcc-bcl-form-column">
                <?php $this->render_plan_information($companies, $label_data); ?>
                <?php $this->render_plan_speed($label_data); ?>
                <?php $this->render_plan_data($label_data); ?>
            </div>

            <div class="fcc-bcl-form-column">
                <?php $this->render_plan_pricing($label_data); ?>
                <?php $this->render_plan_contract($label_data); ?>
                <?php $this->render_customer_support($label_data); ?>
            </div>

            <div class="fcc-bcl-form-column">
                <?php $this->render_monthly_fees($label_data); ?>
                <?php $this->render_onetime_fees($label_data); ?>
                <?php $this->render_discounts_and_bundles($label_data); ?>
            </div>

            <?php submit_button(__('Update Label', 'fcc-bcl'), 'primary', 'fcc_bcl_edit_label'); ?>
        </form>

        <div class="fcc-bcl-form-preview">
            <h2><?php _e('Label Preview', 'fcc-bcl'); ?></h2>
            <div id="label-preview"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
    function updateLabelPreview() {
        var formData = $('form.fcc-bcl-form-inputs').serialize();
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'fcc_bcl_get_label_preview',
                form_data: formData,
                label_id: <?php echo esc_js($label_data['id']); ?>,
                nonce: '<?php echo wp_create_nonce('fcc_bcl_edit_label'); ?>'
            },
            success: function(response) {
                if (response.success) {
                    $('#label-preview').html(response.data);
                } else {
                    console.error('Error updating preview:', response.data);
                    $('#label-preview').html('<p>Error loading preview</p>');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', status, error);
                $('#label-preview').html('<p>Error loading preview</p>');
            }
        });
    }

    // Update preview on form changes
    $('form.fcc-bcl-form-inputs').on('change', 'input, select, textarea', updateLabelPreview);

    // Initial preview update
    updateLabelPreview();

    // Handle dynamic fee fields
    $('.add-fee').on('click', function(e) {
        e.preventDefault();
        var feeType = $(this).data('fee-type');
        var feeContainer = $('#' + feeType + '-fees-container');
        var newRow = feeContainer.find('.fee-row:first').clone();
        newRow.find('input').val('');
        feeContainer.append(newRow);
        updateLabelPreview();
    });

    $(document).on('click', '.remove-fee', function(e) {
        e.preventDefault();
        $(this).closest('.fee-row').remove();
        updateLabelPreview();
    });
});
</script>
