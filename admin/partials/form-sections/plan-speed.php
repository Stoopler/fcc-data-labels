<div class="fcc-bcl-form-section">
    <h3><?php _e('Plan Speed', 'fcc-bcl'); ?></h3>
    
    <label for="dl_speed_in_kbps"><?php _e('Download Speed (Mbps)', 'fcc-bcl'); ?></label>
    <input type="number" name="dl_speed_in_kbps" id="dl_speed_in_kbps" value="<?php echo esc_attr($label_data['dl_speed_in_kbps'] ?? ''); ?>" required>

    <label for="ul_speed_in_kbps"><?php _e('Upload Speed (Mbps)', 'fcc-bcl'); ?></label>
    <input type="number" name="ul_speed_in_kbps" id="ul_speed_in_kbps" value="<?php echo esc_attr($label_data['ul_speed_in_kbps'] ?? ''); ?>" required>

    <label for="latency_in_ms"><?php _e('Latency (ms)', 'fcc-bcl'); ?></label>
    <input type="number" name="latency_in_ms" id="latency_in_ms" value="<?php echo esc_attr($label_data['latency_in_ms'] ?? ''); ?>" required>
</div>
