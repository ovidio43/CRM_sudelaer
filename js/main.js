var i = $('#initRows').val();
$(document).ready(function () {

//    $(".alert").addClass("in").fadeOut(4500);
    $('#is_checked').on('click', function () {
        $('select#id_template_ext').toggleClass('hidden');
    });

    $('.force-redirect').on('click', function () {
        location.href = $(this).attr('href');
    });

    $('.nav-tabs a').click(function (e) {
        e.preventDefault()
        if ($(this).hasClass("disabled")) {
            e.preventDefault();
            return false;
        }
    })
    $('.migrate-link').on('click', function (e) {
        e.preventDefault();
        var currentObj = $(this);
        var status = confirm("Are you sure to migrate this selected item to contacts?");
        if (status !== false) {
            $.get(currentObj.attr('href'), function (data) {
                if (data === 'ok') {
                    currentObj.parent().parent().remove();
                }
            }).complete(function () {

            });
        }
    });
    $('.delete-link').on('click', function (e) {
        e.preventDefault();
        var currentObj = $(this);
        var status = confirm("Are you sure to delete this selected item?");
        if (status !== false) {
            $.post(currentObj.attr('href'), function (data) {
                if (data === 'ok') {
                    currentObj.parent().parent().remove();
                }
            });
        }
    });


    /*******modal show query fo verify phone number in db****************************************/
    $('input#mobile').on('keyup', function () {
        var dataTable = '';
        var phone = $(this).val();
        if (phone.length >= 10 && $.isNumeric(phone)) {
            $.get($('body').attr('rel') + '/leads/verify-mobile-number/' + phone, function (data) {  //para mi local
                if (data != '') {
                    $("#global-modal #title-global-modal").html('Mobile number <strong>"' + phone + '"</strong>  already exists!');
                    $('#global-modal-body').html(data);
                    $("#global-modal").modal('show');
                }
            });
        }
    });
    /******************funcion de peticion de form para en vio de SMS***************************/
    $('body').on('click', 'a.link-send-sms', function (e) {
        e.preventDefault();
        $('#global-modal-body').html('Loading...');
        $("#global-modal #title-global-modal").html('Send SMS');
        $("#global-modal").modal('show');
        $.get($(this).attr('href'), function (data) {
            $('#global-modal-body').html(data);
        });
    });
    /******************modal *************************/
    $('body').on('click', '.listingblock > .four > .vignette > a', function (e) {
        e.preventDefault();
    });

    $('body').on('click', 'a.link-get-car-type', function (e) {
        e.preventDefault();
        $('#aux').val($(this).attr('rel'));
        $("#myModal").modal('show');
    });

    $("#myModal").on('show.bs.modal', function () {
        $('#modal-body').text('Loading..');
        $.get(getUrl(), function (data) {
            $('#modal-body').empty().append($(data).find('.twelve').children());
        });
    });
    $('body').on('click', 'a.page,a.nextpostslink,a.last,a.first,a.previouspostslink', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $('#modal-body').text('Loading..');
        $.post(url, function (data) {
            $('#modal-body').empty().append($(data).find('.twelve').children());
        });
    })
    $('body').on('click', '.listingblock', function (e) {
        var row = $('#aux').val();
        var args = $(this).find('h4.address').text().split('#');
        $('#year' + row).val($(this).find('span.model-year-crm').text());
        $('#make' + row).val($(this).find('span.make-crm').text());
        $('#model' + row).val($(this).find('span.model-crm').text());
        $('#stock' + row).val(args[1].trim());
        $("#myModal").modal('hide');
    });
    /****************** *************************/

    $('body').on('click', '#link-add-row-carType', function (e) {
        e.preventDefault();
        $(this).before(getHtmlInputsCarType(i));
        var rows = addInd(i, $('#rows').val());
        $('#rows').val(rows);
        i++;

    });
    $('body').on('click', '.link-remove-row-carType', function (e) {
        e.preventDefault();
        var ind = $(this).attr('rel');
        $(this).parent().parent().parent().remove();
        var rows = deleteInd(ind, $('#rows').val());
        $('#rows').val(rows);
    });

    $('body').on('click', '.link-delete-row-carType', function (e) {
        e.preventDefault();
        var currentObj = $(this);
        var status = confirm("¿Esta seguro de eliminar el item?");
        if (status !== false) {
            $.post(currentObj.attr('href'), function (data) {
                if (data === 'ok') {
                    var ind = currentObj.attr('rel');
                    var rows = deleteInd(ind, $('#rows').val());
                    $('#rows').val(rows);
                    currentObj.parent().parent().parent().remove();
                }
            });
        }
    });



    /*****************logs********************/
    $('body').on('click', '.save-activity', function (e) {
        e.preventDefault();
        var currentObj = $(this);
        var url = currentObj.attr('href')
        var parent = currentObj.parent().parent();
        var data = {};
        parent.find('input').each(function () {
            data[this.name] = this.value;
        });
        parent.find('textarea').each(function () {
            data[this.name] = this.value;
        });
        parent.find('select').each(function () {
            data[this.name] = this.value;
        });
        currentObj.attr('href', '').text('Processong..');
        $.post(url, data, function (data) {
            if (data === 'ok') {
                document.location.reload();
            } else {
                currentObj.attr('href', url).text('Save');
                alert(data);
            }
        });
    });


    $("#end-visit-form").submit(function () {
        var url = $(this).attr('action');
        var data = $(this).serialize();
        $.post(url, data, function (data) {
            if (data === 'ok') {
                document.location.reload();
            } else {
                alert('Description empty!!');
            }
        });
        return false; // avoid to execute the actual submit of the form.
    });
    $('#show-data-end-visit').click(function (e) {
        e.preventDefault();
        $('#data-end-visit').removeClass('hidden');
        $(this).hide();
    });
    /********************memo short script****************************/
    $('a.link-show-memo').on('click', function (e) {
        e.preventDefault();
        $(this).siblings('div').toggleClass('hidden');
        var text = $(this).text() === 'Close' ? 'Memo' : 'Close';
        $(this).text(text);
    });
    $('a.link-cancel-memo').on('click', function (e) {
        e.preventDefault();
        $(this).parent().toggleClass('hidden');
    });
    $('a.link-save-memo').on('click', function (e) {
        e.preventDefault();
        var currentObj = $(this);
        currentObj.fadeOut();
        currentObj.after('<span>Please wait..</span>');
        $.post(currentObj.attr('href'), {memo_short: currentObj.siblings('textarea').val()}, function (data) {
            if (data === 'ok') {
                currentObj.next().fadeOut();
                currentObj.fadeIn();
            }
        });
    });
    /********************envio de form SMS por ajax*******************************************/
    $('body').on('submit', '.global-form', function (e) {
        e.preventDefault();
        var thisObj = $(this);
        var url = thisObj.attr('action');
        var data = thisObj.serialize();
        thisObj.children('input[type="submit"]').prop("disabled", true);
        $.post(url, data, function (data) {
            if (data == 'ok') {
                thisObj.parent().html('<div class="alert alert-success" role="alert">Your message was sent successfully.</div><button type="button" class="btn btn-success" data-dismiss="modal">DONE</button>');
                thisObj.remove();
            } else {
                thisObj.prev().remove();
                thisObj.before(data); 
                thisObj.children('input[type="submit"]').prop("disabled", false);
            }
           
        });
    });
});

function getUrl() {
    var input = $('#aux').val();//0-1-2
//    var url = 'http://www.sudealeramigo.com/search-results-crm/?' + 'make=' + $('#make' + input).val() + '&model-year=' + $('#year' + input).val() + '&stock-number=' + $('#stock' + input).val();
    var url = '/search-results-crm/?' + 'make=' + $('#make' + input).val() + '&model-year=' + $('#year' + input).val() + '&stock-number=' + $('#stock' + input).val();
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
            '<label for="model' + i + '">Model</label><input type="text" id="model' + i + '" value="" name="model' + i + '" class="form-control">' +
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
