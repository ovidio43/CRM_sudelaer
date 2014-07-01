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
        var url = 'http://www.sudealeramigo.com/search-results-app/';
        $('#modal-body').text('Loading..');
        $.post(url, function(data) {
            $('#modal-body').empty().append($(data).find('.twelve').children());
        });
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
        var args1 = $(this).find('p.twofeatures').text().split('|');
        var args2 = $(this).find('h4.address').text().split('#');
        $('#year' + row).val(args1[1].trim());
        $('#make' + row).val(args1[2].trim());
        $('#stock' + row).val(args2[1].trim());
        $("#myModal").modal('hide');
    });

//    $("#myModal").on('hidden.bs.modal', function() {
//        alert($(this).attr('id'));
////        $('p.twofeatures')
////        alert("End");
//    });

});


