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

        // Debounce function
        function debounce(func, wait) {
            var timeout;
            return function() {
                var context = this, args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(function() {
                    func.apply(context, args);
                }, wait);
            };
        }

        // Use debounced version for form changes
        var debouncedUpdatePreview = debounce(updateLabelPreview, 300);

        // Update preview on form changes
        $('form.fcc-bcl-form-inputs').on('change keyup', 'input, select, textarea', debouncedUpdatePreview);

        // Initial preview update
        updateLabelPreview();

        // Handle dynamic fee fields
        $('.add-fee').off('click').on('click', function(e) {
            e.preventDefault();
            var feeType = $(this).data('fee-type');
            var feeContainer = $('#' + feeType + '-fees-container');
            var newRow = feeContainer.find('.fee-row:first').clone();
            newRow.find('input').val('');
            feeContainer.append(newRow);
            updateLabelPreview();
        });

        $(document).off('click', '.remove-fee').on('click', '.remove-fee', function(e) {
            e.preventDefault();
            $(this).closest('.fee-row').remove();
            updateLabelPreview();
        });

        // Populate existing fees on page load (for edit page)
        function populateExistingFees(feeType) {
            var feeContainer = $('#' + feeType + '-fees-container');
            var feeData = feeContainer.data('existing-fees');
            if (feeData && feeData.length > 0) {
                feeContainer.empty();
                feeData.forEach(function(fee) {
                    var newRow = $('<div class="fee-row"></div>');
                    newRow.append('<input type="text" name="' + feeType + '_fee_name[]" value="' + fee.name + '">');
                    newRow.append('<input type="number" step="0.01" name="' + feeType + '_fee_price[]" value="' + fee.price + '">');
                    newRow.append('<button type="button" class="remove-fee">Remove</button>');
                    feeContainer.append(newRow);
                });
            }
        }

        populateExistingFees('monthly');
        populateExistingFees('onetime');
    });

})(jQuery);
