$(document).ready(function() {
    $(".alert").addClass("in").fadeOut(4500);
    $('[data-toggle=collapse]').click(function() {
        $(this).find("i").toggleClass("glyphicon-chevron-right glyphicon-chevron-down");
    });
    $('.nav-tabs a').on('click', function(e) {
        e.preventDefault();
        var select = $(this).attr('id');
        $(this).parent().addClass('active');
        $(this).parent().siblings().removeClass('active');
        $('.tab-content').children().removeClass('active');
        $('.tab-content').children('#tab-pane-' + select).addClass('active');
    });
    $('.migrate-link').on('click', function(e) {
        e.preventDefault();
        var currentObj = $(this);
        var status = confirm("esta segudo????");
        if (status !== false) {
            $.get(currentObj.attr('href'), function(data) {
                if (data === 'ok') {
                    currentObj.parent().parent().remove();
                }
            }).complete(function() {

            });
        }
    });
});


