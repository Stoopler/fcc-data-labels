<div class="fcc-bcl-form-section">
    <h3><?php _e('Monthly Fees', 'fcc-bcl'); ?></h3>
    <div id="monthly-fees-container">
        <?php
        if (!empty($label_data['monthly_fees'])) {
            foreach ($label_data['monthly_fees'] as $fee) {
                ?>
                <div class="fee-row">
                    <input type="text" name="monthly_fee_name[]" value="<?php echo esc_attr($fee['name']); ?>" placeholder="<?php _e('Fee Name', 'fcc-bcl'); ?>">
                    <input type="number" step="0.01" name="monthly_fee_price[]" value="<?php echo esc_attr($fee['price']); ?>" placeholder="<?php _e('Fee Price', 'fcc-bcl'); ?>">
                    <button type="button" class="remove-fee"><?php _e('Remove', 'fcc-bcl'); ?></button>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="fee-row">
                <input type="text" name="monthly_fee_name[]" placeholder="<?php _e('Fee Name', 'fcc-bcl'); ?>">
                <input type="number" step="0.01" name="monthly_fee_price[]" placeholder="<?php _e('Fee Price', 'fcc-bcl'); ?>">
                <button type="button" class="remove-fee"><?php _e('Remove', 'fcc-bcl'); ?></button>
            </div>
            <?php
        }
        ?>
    </div>
    <button type="button" class="add-fee" data-fee-type="monthly"><?php _e('Add Monthly Fee', 'fcc-bcl'); ?></button>
</div>
