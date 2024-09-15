(function($) {
    'use strict';

    $(document).ready(function() {
        function updateLabelPreview() {
            var labelHtml = '<article class="bbl">' +
                '<section class="header">' +
                '<h1>Broadband Facts</h1>' +
                '<h2>' + $('#company_id option:selected').text() + '</h2>' +
                '<h3>' + $('#data_service_name').val() + '</h3>' +
                '<p>' + $('#fixed_or_mobile').val() + ' Broadband Consumer Disclosure</p>' +
                '</section>' +
                '<section class="monthly">' +
                '<h4>Monthly Price <span>$' + ($('#introductory_price_per_month').val() || $('#data_service_price').val()) + '</span></h4>' +
                '<p>This Monthly Price ' + ($('#introductory_price_per_month').val() ? 'is' : 'is not') + ' an introductory rate.</p>';

            if ($('#introductory_price_per_month').val() && $('#introductory_period_in_months').val()) {
                labelHtml += '<p>This rate expires after ' + $('#introductory_period_in_months').val() + ' month(s) and will revert to $' + $('#data_service_price').val() + ' per month.</p>';
            }

            if ($('#contract_duration').val()) {
                labelHtml += '<p>This Monthly Price requires a ' + $('#contract_duration').val() + ' month(s) contract.</p>';
                if ($('#contract_url').val()) {
                    labelHtml += '<p><a href="' + $('#contract_url').val() + '" target="_blank">Click Here</a> for contract terms.</p>';
                }
            }

            labelHtml += '</section>';

            // Additional Charges & Terms section
            labelHtml += '<section class="additional-charges">' +
                '<h4>Additional Charges & Terms</h4>' +
                '<h5>Provider Monthly Fees</h5>';

            $('.monthly-fee-row').each(function() {
                var feeName = $(this).find('input[name="monthly_fee_name[]"]').val();
                var feePrice = $(this).find('input[name="monthly_fee_price[]"]').val();
                if (feeName && feePrice) {
                    labelHtml += '<p>' + feeName + ' <span>$' + feePrice + '</span></p>';
                }
            });

            labelHtml += '<h5>One-time Fees at the Time of Purchase</h5>';

            $('.onetime-fee-row').each(function() {
                var feeName = $(this).find('input[name="onetime_fee_name[]"]').val();
                var feePrice = $(this).find('input[name="onetime_fee_price[]"]').val();
                if (feeName && feePrice) {
                    labelHtml += '<p>' + feeName + ' <span>$' + feePrice + '</span></p>';
                }
            });

            if ($('#early_termination_fee').val()) {
                labelHtml += '<p>Early Termination Fee <span>$' + $('#early_termination_fee').val() + '</span></p>';
            }
            labelHtml += '<p>Government Taxes <span>Varies by Location</span></p>';
            labelHtml += '</section>';

            // Discounts & Bundles section
            if ($('#discounts_and_bundles_url').val()) {
                labelHtml += '<section class="discounts">' +
                    '<h4>Discounts & Bundles</h4>' +
                    '<p><a href="' + $('#discounts_and_bundles_url').val() + '" target="_blank">Click Here</a> for available billing discounts and pricing options for broadband service bundled with other services like video, phone, and wireless service, and use your own equipment like modems and routers.</p>' +
                    '</section>';
            }

            // Speeds Provided with Plan section
            labelHtml += '<section class="speeds">' +
                '<h4>Speeds Provided with Plan</h4>' +
                '<p>Typical Download Speed <span>' + $('#dl_speed_in_kbps').val() + ' Mbps</span></p>' +
                '<p>Typical Upload Speed <span>' + $('#ul_speed_in_kbps').val() + ' Mbps</span></p>' +
                '<p>Typical Latency <span>' + $('#latency_in_ms').val() + ' ms</span></p>' +
                '</section>';

            // Data Included with Monthly Price section
            if ($('#data_included_in_monthly_price').val()) {
                labelHtml += '<section class="data">' +
                    '<h4>Data Included with Monthly Price</h4>' +
                    '<p>Data Included <span>' + $('#data_included_in_monthly_price').val() + ' GB</span></p>';
                
                if ($('#overage_fee').val() && $('#overage_data_amount').val()) {
                    labelHtml += '<p>Charges for Additional Data Usage <span>$' + $('#overage_fee').val() + ' / ' + $('#overage_data_amount').val() + ' GB</span></p>';
                }
                
                labelHtml += '</section>';
            }
            $('#label-preview').html(labelHtml);
        }
        $('.fcc-bcl-form-inputs input, .fcc-bcl-form-inputs select').on('change keyup', updateLabelPreview);
        updateLabelPreview(); // Initial update

        // Handle dynamic fee fields
        $('#add-monthly-fee, #add-onetime-fee').click(function() {
            var container = $(this).prev('div');
            var newRow = container.find('.fcc-bcl-form-row').first().clone();
            newRow.find('input').val('');
            container.append(newRow);
            updateLabelPreview();
        });

        $(document).on('click', '.remove-fee', function() {
            $(this).closest('.fcc-bcl-form-row').remove();
            updateLabelPreview();
        });
    });
})(jQuery);