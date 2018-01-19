/**
 * Enable popovers everywhere
 */
$('[data-toggle="popover"]').popover();

/**
 * Enable tooltips everywhere
 */
$('[data-toggle="tooltip"]').tooltip()

/**
 * Datepicker
 */
$('.datepicker').datepicker({
    format: "yyyy-mm-dd",
    todayHighlight: true,
    autoclose: true,
    language: 'ja'
});
