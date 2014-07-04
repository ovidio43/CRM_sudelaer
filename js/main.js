var i = $('#initRows').val();
$(document).ready(function() {
//    $(".alert").addClass("in").fadeOut(4500);
    $('[data-toggle=collapse]').click(function() {
        $(this).find("i").toggleClass("glyphicon-chevron-right glyphicon-chevron-down");
    });
//    $('.nav-tabs a').on('click', function(e) {
//        e.preventDefault();
//        var select = $(this).attr('id');
//        $(this).parent().addClass('active');
//        $(this).parent().siblings().removeClass('active');
//        $('.tab-content').children().removeClass('active');
//        $('.tab-content').children('#tab-pane-' + select).addClass('active');
//    });
    $('.force-redirect').on('click', function() {
        location.href = $(this).attr('href');
    });

    $('.nav-tabs a').click(function(e) {
        e.preventDefault()
        if ($(this).hasClass("disabled")) {
            e.preventDefault();
            return false;
        }
    })
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
//        $.ajax({
//            type: 'GET',
//            url: getUrl(),
//            cache: false,
//            beforeSend: function() {
//                $('#modal-body').text('Loading..');
//            },
//            success: function(data) {
//                $('#modal-body').empty().append($(data).find('.twelve').children());
//            }
//        });
        $('#modal-body').text('Loading..');
        $.get(getUrl(), function(data) {
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
        var args = $(this).find('h4.address').text().split('#');
        $('#year' + row).val($(this).find('span.model-year-crm').text());
        $('#make' + row).val($(this).find('span.make-crm').text());
        $('#stock' + row).val(args[1].trim());
        $("#myModal").modal('hide');
    });
    /****************** *************************/

    $('body').on('click', '#link-add-row-carType', function(e) {
        e.preventDefault();
        $(this).before(getHtmlInputsCarType(i));
        var rows = addInd(i, $('#rows').val());
        $('#rows').val(rows);
        i++;

    });
    $('body').on('click', '.link-remove-row-carType', function(e) {
        e.preventDefault();
        var ind = $(this).attr('rel');
        $(this).parent().parent().parent().remove();
        var rows = deleteInd(ind, $('#rows').val());
        $('#rows').val(rows);
    });

    $('body').on('click', '.link-delete-row-carType', function(e) {
        e.preventDefault();
        var currentObj = $(this);
        var status = confirm("¿Esta seguro de eliminar el item?");
        if (status !== false) {
            $.post(currentObj.attr('href'), function(data) {
                if (data === 'ok') {
                    var ind = currentObj.attr('rel');
                    var rows = deleteInd(ind, $('#rows').val());
                    $('#rows').val(rows);
                    currentObj.parent().parent().parent().remove();
                }
            });
        }
    });

});

function getUrl() {
    var input = $('#aux').val();//0-1-2
    var url = 'http://www.sudealeramigo.com/search-results-crm/?' + 'make=' + $('#make' + input).val() + '&model-year=' + $('#year' + input).val() + '&stock-number=' + $('#stock' + input).val();
    return url;
}
function addInd(i, cad) {
    return  cad + i + ',';
}
function deleteInd(i, cad) {
    cad = cad.replace(i, '');
    return  cad.replace(',,', ',');
}
function getHtmlInputsCarType(i) {
    var row = '<div class="form-group">' +
            '<div class="row">' +
            '<div class="col-sm-2">' +
            '<label for="make' + i + '">Make</label><input type="text" id="make' + i + '" value="" name="make' + i + '" class="form-control"> ' +
            '</div>' +
            '<div class="col-sm-2">' +
            '<label for="year' + i + '">Year</label><input type="text" id="year' + i + '" value="" name="year' + i + '" class="form-control">' +
            '</div>' +
            '<div class="col-sm-2" >' +
            '<label for="stock' + i + '">Stock</label><input type="text" id="stock' + i + '" value="" name="stock' + i + '" class="form-control">' +
            '</div>' +
            '<div class="col-sm-2">' +
            '<label for="budget' + i + '">Budget</label><input type="text" id="budget' + i + '" value="" name="budget' + i + '" class="form-control">' +
            '</div>' +
            '<div class="col-sm-2">' +
            '<br>' +
            '<a rel="' + i + '" href="#" class="btn btn-primary link-get-car-type" role="button">' +
            '<span class="glyphicon glyphicon-plus"></span>' +
            '</a>' +
            '  <a rel="' + i + '" class="link-remove-row-carType btn btn-primary btn-danger" href="#" title="REMOVE" role="button" ><span class=" glyphicon glyphicon-remove"></span></a>' +
            '</div>' +
            '</div>' +
            '</div>';
    return row;
}
