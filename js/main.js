$(document).ready(function() {
//    $(".alert").addClass("in").fadeOut(4500);
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
        var status = confirm("¿esta seguro de migrar el item seleccionado?");
        if (status !== false) {
            $.get(currentObj.attr('href'), function(data) {
                if (data === 'ok') {
                    currentObj.parent().parent().remove();
                }
            }).complete(function() {

            });
        }
    });
    $('.delete-link').on('click', function(e) {
        e.preventDefault();
        var currentObj = $(this);
        var status = confirm("¿Esta seguro de eliminar el item?");
        if (status !== false) {
            $.post(currentObj.attr('href'), function(data) {
                if (data === 'ok') {
                    currentObj.parent().parent().remove();
                }
            }).complete(function() {

            });
        }
    });



    /******************modal *************************/
    $('body').on('click', '.listingblock > .four > .vignette > a', function(e) {
        e.preventDefault();
    });

    $('body').on('click', 'a.link-get-car-type', function(e) {
        e.preventDefault();
        $('#aux').val($(this).attr('rel'));
        $("#myModal").modal('show');
    });
    ;
    $("#myModal").on('show.bs.modal', function() {
        $.ajax({
            type: 'GET',
            url: getUrl(),
            cache: false,
            beforeSend: function() {
                $('#modal-body').text('Loading..');
            },
            success: function(data) {
                $('#modal-body').empty().append($(data).find('.twelve').children());
            }
        });
//         $('#modal-body').text('Loading..');
//        $.get(getUrl(), function(data) {
//            $('#modal-body').empty().append($(data).find('.twelve').children());
//        });
    });
    $('body').on('click', 'a.page,a.nextpostslink,a.last,a.first,a.previouspostslink', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $('#modal-body').text('Loading..');
        $.post(url, function(data) {
            $('#modal-body').empty().append($(data).find('.twelve').children());
        });
    })
    $('body').on('click', '.listingblock', function(e) {
        var row = $('#aux').val();
        var args = $(this).find('h4.address').text().split('#');
        $('#year' + row).val($(this).find('span.model-year-crm').text());
        $('#make' + row).val($(this).find('span.make-crm').text());
        $('#stock' + row).val(args[1].trim());
        $("#myModal").modal('hide');
    });
});


function getUrl() {
    var input = $('#aux').val();//0-1-2
    var url = 'http://www.sudealeramigo.com/search-results-crm/?' + 'make=' + $('#make' + input).val() + '&model-year=' + $('#year' + input).val() + '&stock-number=' + $('#stock' + input).val();
    return url;
}