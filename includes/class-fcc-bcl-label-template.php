<?php
class FCC_BCL_Label_Template {
    public static function generate_label_html($label_data) {
        // Ensure all expected fields are set to avoid warnings
        $default_data = [
            'company_name' => 'Company Name Not Available',
            'data_service_name' => 'Service Name Not Available',
            'fixed_or_mobile' => 'Fixed',
            'data_service_price' => '0.00',
            'introductory_price_per_month' => '0.00',
            'introductory_period_in_months' => '0',
            'contract_duration' => '0',
            'dl_speed_in_kbps' => '0',
            'ul_speed_in_kbps' => '0',
            'latency_in_ms' => '0',
            'data_included_in_monthly_price' => '0',
            'overage_fee' => '0.00',
            'overage_data_amount' => '0',
            'discounts_and_bundles_url' => '',
            'early_termination_fee' => '0.00',
            'monthly_fees' => [],
            'onetime_fees' => [],
        ];

        $label_data = array_merge($default_data, $label_data);

        ob_start();
        include FCC_BCL_PLUGIN_DIR . 'templates/label-template.php';
        return ob_get_clean();
    }
}
