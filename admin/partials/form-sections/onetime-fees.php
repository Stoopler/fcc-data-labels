<div class="fcc-bcl-form-section">
    <h3><?php _e('One-time Fees', 'fcc-bcl'); ?></h3>
    <div id="onetime-fees-container">
        <?php
        if (!empty($label_data['onetime_fees'])) {
            foreach ($label_data['onetime_fees'] as $fee) {
                ?>
                <div class="fee-row">
                    <input type="text" name="onetime_fee_name[]" value="<?php echo esc_attr($fee['name']); ?>" placeholder="<?php _e('Fee Name', 'fcc-bcl'); ?>">
                    <input type="number" step="0.01" name="onetime_fee_price[]" value="<?php echo esc_attr($fee['price']); ?>" placeholder="<?php _e('Fee Price', 'fcc-bcl'); ?>">
                    <button type="button" class="remove-fee"><?php _e('Remove', 'fcc-bcl'); ?></button>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="fee-row">
                <input type="text" name="onetime_fee_name[]" placeholder="<?php _e('Fee Name', 'fcc-bcl'); ?>">
                <input type="number" step="0.01" name="onetime_fee_price[]" placeholder="<?php _e('Fee Price', 'fcc-bcl'); ?>">
                <button type="button" class="remove-fee"><?php _e('Remove', 'fcc-bcl'); ?></button>
            </div>
            <?php
        }
        ?>
    </div>
    <button type="button" class="add-fee" data-fee-type="onetime"><?php _e('Add One-time Fee', 'fcc-bcl'); ?></button>
</div>
