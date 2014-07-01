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
    $('body').on('click', '#link-get-car-type', function(e) {
        e.preventDefault();
//        $("#myModal").modal('show');
        $.post($(this).attr('href'), function(data) {
            console.log(data);
            $('#modal-body').empty().append($(data).find('.twelve').children());
        })
    });
    $("#myModal").on('show.bs.modal', function() {
        var url = $('#link-get-car-type').attr('href');

    });
    $("#myModal").on('hidden.bs.modal', function() {
//        alert("End");
    });

});


