<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly

if (!isset($label_data) || empty($label_data)) {
    return 'No label data available.';
}

// Start building the HTML for the label
$html = '<article class="bbl">';

// Header section
$html .= '<section class="header">';
$html .= '<h1>Broadband Facts</h1>';
$html .= '<h2>' . (isset($label_data['company_name']) ? esc_html($label_data['company_name']) : 'Company Name Not Available') . '</h2>';
$html .= '<h3>' . (isset($label_data['data_service_name']) ? esc_html($label_data['data_service_name']) : 'Service Name Not Available') . '</h3>';
$html .= '<p>' . (isset($label_data['fixed_or_mobile']) ? esc_html($label_data['fixed_or_mobile']) : 'Fixed/Mobile') . ' Broadband Consumer Disclosure</p>';
$html .= '</section>';

// Monthly section
$html .= '<section class="monthly">';
$monthly_price = !empty($label_data['introductory_price_per_month']) ? $label_data['introductory_price_per_month'] : $label_data['data_service_price'];
$html .= '<h4>Monthly Price <span>$' . esc_html($monthly_price) . '</span></h4>';
$html .= '<p>This Monthly Price ' . (!empty($label_data['introductory_price_per_month']) ? 'is' : 'is not') . ' an introductory rate.</p>';

if (!empty($label_data['introductory_price_per_month']) && !empty($label_data['introductory_period_in_months'])) {
    $html .= '<p>This rate expires after ' . esc_html($label_data['introductory_period_in_months']) . ' month(s) and will revert to $' . esc_html($label_data['data_service_price']) . ' per month.</p>';
}

if (!empty($label_data['contract_duration'])) {
    $html .= '<p>This Monthly Price requires a ' . esc_html($label_data['contract_duration']) . ' month(s) contract.</p>';
    if (!empty($label_data['contract_url'])) {
        $html .= '<p><a href="' . esc_url($label_data['contract_url']) . '" target="_blank">Click Here</a> for contract terms.</p>';
    }
}

$html .= '</section>';

// Additional Charges & Terms section
$html .= '<section class="additional-charges">';
$html .= '<h4>Additional Charges & Terms</h4>';
$html .= '<h5>Provider Monthly Fees</h5>';

$monthly_fees = maybe_unserialize($label_data['monthly_fees']);
if (!empty($monthly_fees)) {
    $html .= '<ul>';
    foreach ($monthly_fees as $fee) {
        $html .= '<li><span>' . esc_html($fee['name']) . '</span><span>$' . esc_html($fee['price']) . '</span></li>';
    }
    $html .= '</ul>';
}

$html .= '<h5>One-time Fees at the Time of Purchase</h5>';

$onetime_fees = maybe_unserialize($label_data['onetime_fees']);
if (!empty($onetime_fees)) {
    $html .= '<ul>';
    foreach ($onetime_fees as $fee) {
        $html .= '<li><span>' . esc_html($fee['name']) . '</span><span>$' . esc_html($fee['price']) . '</span></li>';
    }
    $html .= '</ul>';
}

if (!empty($label_data['early_termination_fee'])) {
    $html .= '<h5>Early Termination Fee <span>$' . esc_html($label_data['early_termination_fee']) . '</span></h5>';
}

$html .= '<h5>Government Taxes <span>Varies by Location</span></h5>';
$html .= '</section>';

// Discounts & Bundles section
if (!empty($label_data['discounts_and_bundles_url'])) {
    $html .= '<section class="discounts">';
    $html .= '<h4>Discounts & Bundles</h4>';
    $html .= '<p><a href="' . esc_url($label_data['discounts_and_bundles_url']) . '" target="_blank">Click Here</a> for available billing discounts and pricing options for broadband service bundled with other services like video, phone, and wireless service, and use your own equipment like modems and routers.</p>';
    $html .= '</section>';
}

// Speeds section
$html .= '<section class="speeds">';
$html .= '<h4>Speeds Provided with Plan</h4>';
$html .= '<p>Typical Download Speed <span>' . esc_html($label_data['dl_speed_in_kbps']) . ' Mbps</span></p>';
$html .= '<p>Typical Upload Speed <span>' . esc_html($label_data['ul_speed_in_kbps']) . ' Mbps</span></p>';
$html .= '<p>Typical Latency <span>' . esc_html($label_data['latency_in_ms']) . ' ms</span></p>';
$html .= '</section>';

// Data section
if (!empty($label_data['data_included_in_monthly_price'])) {
    $html .= '<section class="data">';
    $html .= '<h4>Data Included with Monthly Price <span>' . esc_html($label_data['data_included_in_monthly_price']) . ' GB</span></h4>';
    if (!empty($label_data['overage_fee']) && !empty($label_data['overage_data_amount'])) {
        $html .= '<p>Charges for Additional Data Usage <span>$' . esc_html($label_data['overage_fee']) . ' / ' . esc_html($label_data['overage_data_amount']) . ' GB</span></p>';
    }
    $html .= '</section>';
}

// Policies section
$html .= '<section class="policies">';
if (!empty($label_data['network_management_url'])) {
    $html .= '<p>Network Management <a href="' . esc_url($label_data['network_management_url']) . '" target="_blank">Read our Policy</a></p>';
}
if (!empty($label_data['privacy_policy_url'])) {
    $html .= '<p>Privacy <a href="' . esc_url($label_data['privacy_policy_url']) . '" target="_blank">Read our Policy</a></p>';
}
$html .= '</section>';

// Customer Support section
$html .= '<section class="support">';
$html .= '<h4>Customer Support</h4>';
if (!empty($label_data['customer_support_phone'])) {
    $html .= '<p>Contact Us: <a href="tel:' . esc_attr($label_data['customer_support_phone']) . '">' . esc_html($label_data['customer_support_phone']) . '</a></p>';
}
if (!empty($label_data['customer_support_url'])) {
    $html .= '<p><a href="' . esc_url($label_data['customer_support_url']) . '" target="_blank">' . esc_html($label_data['customer_support_url']) . '</a></p>';
}
$html .= '</section>';

// Footer section
$html .= '<section class="footer">';
$html .= '<p>Learn more about the terms used on this label by visiting the Federal Communications Commission\'s Consumer Resource Center.</p>';
$html .= '<p><a href="https://fcc.gov/consumer" target="_blank">fcc.gov/consumer</a></p>';
$html .= '<p>' . esc_html($label_data['fcc_id']) . '</p>';
$html .= '</section>';

$html .= '</article>';

echo $html;