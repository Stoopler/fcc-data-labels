<article class="bbl">
    <section class="header">
        <h1>Broadband Facts</h1>
        <h2><?php echo esc_html($label_data['company_name']); ?></h2>
        <h3><?php echo esc_html($label_data['data_service_name']); ?></h3>
        <p><?php echo esc_html($label_data['fixed_or_mobile']); ?> Broadband Consumer Disclosure</p>
    </section>

    <section class="monthly">
        <h4>Monthly Price <span>$<?php echo esc_html($label_data['data_service_price']); ?></span></h4>
        <p>This Monthly Price <?php echo (floatval($label_data['introductory_price_per_month']) > 0) ? 'is' : 'is not'; ?> an introductory rate.</p>
        <?php if (floatval($label_data['introductory_price_per_month']) > 0): ?>
            <p>This rate expires after <?php echo esc_html($label_data['introductory_period_in_months']); ?> month(s) and will revert to $<?php echo esc_html($label_data['data_service_price']); ?> per month.</p>
        <?php endif; ?>
        <?php if (intval($label_data['contract_duration']) > 0): ?>
            <p>This Monthly Price requires a <?php echo esc_html($label_data['contract_duration']); ?> month(s) contract.</p>
            <?php if (!empty($label_data['contract_url'])): ?>
                <p><a href="<?php echo esc_url($label_data['contract_url']); ?>" target="_blank">Click Here</a> for contract terms.</p>
            <?php endif; ?>
        <?php endif; ?>
    </section>

    <section class="additional-charges">
        <h4>Additional Charges &amp; Terms</h4>
        <h5>Provider Monthly Fees</h5>
        <?php if (!empty($label_data['monthly_fees'])): ?>
            <ul>
                <?php foreach ($label_data['monthly_fees'] as $fee): ?>
                    <li><span><?php echo esc_html($fee['name']); ?></span><span>$<?php echo esc_html($fee['price']); ?></span></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <h5>One-time Fees at the Time of Purchase</h5>
        <?php if (!empty($label_data['onetime_fees'])): ?>
            <ul>
                <?php foreach ($label_data['onetime_fees'] as $fee): ?>
                    <li><span><?php echo esc_html($fee['name']); ?></span><span>$<?php echo esc_html($fee['price']); ?></span></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <h5>Early Termination Fee <span><?php echo (!empty($label_data['early_termination_fee']) && intval($label_data['contract_duration']) > 0) ? '$' . esc_html($label_data['early_termination_fee']) : 'None'; ?></span></h5>
        <h5>Government Taxes <span>Varies by Location</span></h5>
    </section>

    <section class="discounts">
        <h4>Discounts &amp; Bundles</h4>
        <?php if (!empty($label_data['discounts_and_bundles_url'])): ?>
            <p><a href="<?php echo esc_url($label_data['discounts_and_bundles_url']); ?>" target="_blank">Click Here</a> for available billing discounts and pricing options for broadband service bundled with other services like video, phone, and wireless service, and use your own equipment like modems and routers.</p>
        <?php endif; ?>
    </section>

    <section class="speeds">
        <h4>Speeds Provided with Plan</h4>
        <p>Typical Download Speed <span><?php echo esc_html($label_data['dl_speed_in_kbps']); ?> Mbps</span></p>
        <p>Typical Upload Speed <span><?php echo esc_html($label_data['ul_speed_in_kbps']); ?> Mbps</span></p>
        <p>Typical Latency <span><?php echo esc_html($label_data['latency_in_ms']); ?> ms</span></p>
    </section>

    <section class="data">
        <h4>Data Included with Monthly Price <span><?php echo esc_html($label_data['data_included_in_monthly_price']); ?> GB</span></h4>
        <?php if (!empty($label_data['overage_fee']) && !empty($label_data['overage_data_amount'])): ?>
            <p>Charges for Additional Data Usage <span>$<?php echo esc_html($label_data['overage_fee']); ?> / <?php echo esc_html($label_data['overage_data_amount']); ?> GB</span></p>
        <?php endif; ?>
    </section>

    <?php if (!empty($label_data['network_management_url']) || !empty($label_data['privacy_policy_url'])): ?>
    <section class="policies">
        <?php if (!empty($label_data['network_management_url'])): ?>
            <p>Network Management <a href="<?php echo esc_url($label_data['network_management_url']); ?>" target="_blank">Read our Policy</a></p>
        <?php endif; ?>
        <?php if (!empty($label_data['privacy_policy_url'])): ?>
            <p>Privacy <a href="<?php echo esc_url($label_data['privacy_policy_url']); ?>" target="_blank">Read our Policy</a></p>
        <?php endif; ?>
    </section>
    <?php endif; ?>

    <?php if (!empty($label_data['customer_support_phone']) || !empty($label_data['customer_support_url'])): ?>
    <section class="support">
        <h4>Customer Support</h4>
        <?php if (!empty($label_data['customer_support_phone'])): ?>
            <p>Contact Us: <a href="tel:<?php echo esc_attr($label_data['customer_support_phone']); ?>"><?php echo esc_html($label_data['customer_support_phone']); ?></a></p>
        <?php endif; ?>
        <?php if (!empty($label_data['customer_support_url'])): ?>
            <p><a href="<?php echo esc_url($label_data['customer_support_url']); ?>" target="_blank"><?php echo esc_html($label_data['customer_support_url']); ?></a></p>
        <?php endif; ?>
    </section>
    <?php endif; ?>

    <section class="footer">
        <p>Learn more about the terms used on this label by visiting the Federal Communications Commission's Consumer Resource Center.</p>
        <p><a href="https://fcc.gov/consumer" target="_blank">fcc.gov/consumer</a></p>
    </section>
</article>
