/**
 * Jquery Document
 */
$(document).ready(function () {
    /**
     * Initialization elements
     */

    // $('.modal').modal();
    $('.collapsible').collapsible();
    $('.modal-content').css({'width': '155% !important'});
    $('select').material_select();
    $('.tooltipped').tooltip({delay: 50});
    $('ul.tabs').tabs();
    // Initialize collapse button
    $(".brand-logo").sideNav();

    // Initialize collapsible (uncomment the line below if you use the dropdown variation)
    $('.brand-logo').sideNav({
        menuWidth: 300, // Default is 300
        edge: 'left', // Choose the horizontal origin
        closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
        draggable: true // Choose whether you can drag to open on touch screens
    });

    $('.tooltipped').tooltip({delay: 50});
});

/**
 * Create combo box for generic fields.
 * @param $id
 * @param $post
 * @param $params
 */
ajax = function($id, $post, $params) {
    $.ajax({
        dataType: 'json',
        url: '' + $post + '',
        data: {
            content: 'text',
            id: $params
        },
        success: function (response) {
            html = '<option value = "" disabled selected> Choose your option </option>';
            $.each(response.data, function (index, value) {
                html += '<option value = "' + value.id_record + '"> ' + value.description + '</option>';
            });
            $("#" + $id + "").html(html);
            $('select').material_select();
        }
    });
}

/**
 * This function get the value of id's
 * @param value
 * @returns {Array}
 * @constructor
 */
function values(value) {
    let array = value.split(',');
    let newarray = new Array();
    for (let n = 0; n < array.length; n++) {
        newarray['' + array[n] + ''] = $('' + array[n] + '').val();
    }
    return newarray;
}

/**
 * convert form to object.
 * @returns object
 */

$.fn.serializeObject = function () {
    var o = {};
    var a = this.serializeArray();
    $.each(a, function () {
        $.fn.serializeObject = function () {
            var o = {};
            var a = this.serializeArray();
            $.each(a, function () {

                if (o[this.name]) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        };
    });
};

function getTable(table, head) {

    $(head).nextUntil(head).hide();//oculta todos los filas que no poseen la clase head
    $(table).on('click', '.head', function () {
        $(this).nextUntil(head).toggle();//muestra el colapso de las filas
    });
    // let n = 0;
    $(head).nextUntil(head).hide();//oculta todos los filas que no poseen la clase head
    $('table').addClass('bordered highlight centered responsive-table'); //se le agrega el estilo a la tabla
    $(table).on('click', '.head', function () {
        let n = $(this).data('status');
        if (n == 0) {
            $(this).data('status', 1)
            return $(this).nextUntil(head).show(); //muestra el colapso de las filas
        } else {
            $(this).data('status', 0)
            return $(this).nextUntil(head).hide(); //muestra el colapso de las filas
        }
    });
}


