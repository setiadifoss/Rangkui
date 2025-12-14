$(document).ready(function() {
    // Initialize Select2 for dropdowns to enhance user experience
    $('.select2').select2({
        placeholder: "-- Select an option --",
        allowClear: true,
        width: '100%'
    });
    
    // Handle form reset to clear Select2 selections
    $('button[type="reset"]').on('click', function() {
        $('.select2').val('').trigger('change');
    });
});
