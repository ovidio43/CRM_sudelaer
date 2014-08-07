$(document).ready(function() {
    $('[data-toggle=collapse]').click(function() {
        $(this).find("i").toggleClass("glyphicon-chevron-right glyphicon-chevron-down");
    });
    $('.default-dtp').datetimepicker({
        timepicker: false,
        format: 'Y/m/d',
        formatDate: 'Y/m/d'

    });
    $('.hours-tp').datetimepicker({
        datepicker: false,
        format: 'H:i',
        step: 5
    });
    $('textarea#content').ckeditor();
});


