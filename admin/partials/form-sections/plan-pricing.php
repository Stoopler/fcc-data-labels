<div class="fcc-bcl-form-section">
    <h2><?php _e('Plan Pricing', 'fcc-bcl'); ?></h2>
    <div class="fcc-bcl-form-row">
        <label for="data_service_price"><?php _e('Monthly Price', 'fcc-bcl'); ?></label>
        <input type="number" name="data_service_price" id="data_service_price" step="0.01" min="0" required>
    </div>
    <div class="fcc-bcl-form-row">
        <label for="introductory_price_per_month"><?php _e('Intro Price', 'fcc-bcl'); ?></label>
        <input type="number" name="introductory_price_per_month" id="introductory_price_per_month" step="0.01" min="0">
    </div>
    <div class="fcc-bcl-form-row">
        <label for="introductory_period_in_months"><?php _e('Intro Period (months)', 'fcc-bcl'); ?></label>
        <input type="number" name="introductory_period_in_months" id="introductory_period_in_months" min="1">
    </div>
</div>