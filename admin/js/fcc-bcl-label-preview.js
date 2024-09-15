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
            }

            labelHtml += '</section>';

            // Add more sections as needed

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