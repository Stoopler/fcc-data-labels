(function($) {
    'use strict';

    $(document).ready(function() {
        function updateLabelPreview() {
            var formData = $('form.fcc-bcl-form-inputs').serialize();
            $.ajax({
                url: fcc_bcl_admin.ajax_url,
                type: 'POST',
                data: {
                    action: 'fcc_bcl_get_label_preview',
                    form_data: formData,
                    nonce: $('input[name="fcc_bcl_edit_label_nonce"]').val()
                },
                success: function(response) {
                    if (response.success) {
                        $('#label-preview').html(response.data);
                    } else {
                        console.error('Error updating preview:', response.data);
                        $('#label-preview').html('<p>Error loading preview: ' + response.data + '</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', xhr.responseText, status, error);
                    $('#label-preview').html('<p>Error loading preview: ' + error + '</p>');
                }
            });
        }

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

        var debouncedUpdatePreview = debounce(updateLabelPreview, 300);

        $('form.fcc-bcl-form-inputs').on('change keyup', 'input, select, textarea', debouncedUpdatePreview);

        updateLabelPreview(); // Initial update

        // Handle dynamic fee fields
        $('.add-fee').on('click', function(e) {
            e.preventDefault();
            var feeType = $(this).data('fee-type');
            var feeContainer = $('#' + feeType + '-fees-container');
            var newRow = feeContainer.find('.fee-row').first().clone();
            newRow.find('input').val('');
            feeContainer.append(newRow);
            debouncedUpdatePreview();
        });

        $(document).on('click', '.remove-fee', function(e) {
            e.preventDefault();
            $(this).closest('.fee-row').remove();
            debouncedUpdatePreview();
        });
    });
})(jQuery);
