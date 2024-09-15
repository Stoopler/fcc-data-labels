<div class="fcc-bcl-form-section">
    <h2><?php _e('Plan Speed', 'fcc-bcl'); ?></h2>
    <div class="fcc-bcl-form-row">
        <label for="dl_speed_in_kbps"><?php _e('Download Speed (Mbps)', 'fcc-bcl'); ?></label>
        <input type="number" name="dl_speed_in_kbps" id="dl_speed_in_kbps" min="0" required>
    </div>
    <div class="fcc-bcl-form-row">
        <label for="ul_speed_in_kbps"><?php _e('Upload Speed (Mbps)', 'fcc-bcl'); ?></label>
        <input type="number" name="ul_speed_in_kbps" id="ul_speed_in_kbps" min="0" required>
    </div>
    <div class="fcc-bcl-form-row">
        <label for="latency_in_ms"><?php _e('Latency (ms)', 'fcc-bcl'); ?></label>
        <input type="number" name="latency_in_ms" id="latency_in_ms" min="0" required>
    </div>
</div>