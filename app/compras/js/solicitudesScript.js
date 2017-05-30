/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

    $('.collapsible').collapsible();
    $('.modal').modal();
    $('.modal-content').css({'width': '155% !important'});
    $('select').material_select();
    $('.tooltipped').tooltip({delay: 50});
    var obj = new Object();

    /**
     * fill the table
     * @returns {undefined}
     */
    var table = function () {
        $.ajax({
            dataType: 'text',
            url: 'getDetalleSolicitudTmp',
            data: {
                content: 'text'
            },
            success: function (response) {
                $("#details").html(response);
            }
        });
    };
    /**
     *
     */
    ajax('almacen', 'getAlmacen2', 0);
    ajax('suplidor', 'getSuplidor2', 0);
    ajax('unidad', 'getUnidad2', 0);
    /**
     *
     */
    $("#suplidor").on("change", function () {
        ajax('articulo', 'getArticulo3', $(this).val())
    });
    /**
     *
     */
    $("#add").on('click', function () {
        obj.almacen = $("#almacen").val();
        obj.suplidor = $("#suplidor").val();
        obj.articulo = $("#articulo").val();
        obj.unidad = $("#unidad").val();
        obj.qty = $("#qty").val();
        if (obj.almacen == '' || obj.suplidor == '' || obj.articulo == '' || obj.qty == '' || obj.unidad == '') {
            alertify.alert('Alert', 'Completed all fields');
            return;
        }
        save('tmp');
        $("#list").html("<b>Almacen:</b> " + $("#almacen").find('option:selected').text() + " <b>Suplidor:</b> " + $("#suplidor").find('option:selected').text() + "");
        $("#almacen").prop("disabled", true);
        $("#suplidor").prop("disabled", true);
        $("#articulo").val('').focus();
        $("#qty").val('');
        $("#unidad").val('');
        $('select').material_select();
    });
    /**
     *
     */
    $("#save").on('click', function () {
        if ($("#details").children("tr").length < 1) {
            alertify.alert('Alert', 'You dont have any product added. Please add at least one');
        } else {
            save('');
        }
    });
    /**
     *
     * @param option
     */
    var save = function (option) {
        $.post("setSolicitud", {content: 'text', data: obj, option: option}, function (response) {
            if (response) {
                alertify.success('Save Succefully');
                if (option == 'tmp') {
                    table();
                } else {
                    location.reload();
                }
                table();
            } else {
                alertify.alert("Something was wrong. Please verify!");
            }
        });
    }
    /**
     *
     */
    $("#cancel").on('click', function () {
        cancel(0);
        $("#almacen").prop("disabled", false);
        $("#suplidor").prop("disabled", false);
        $("#almacen").val('').focus();
        $("#suplidor").val('');
        $("#articulo").val('');
        $("#qty").val('');
        $('select').material_select();
    });
    /**
     *
     */
    $("#details").on('click', '.cancel', function () {
        cancel($(this).data('id'));
    });
    /**
     *
     * @param $obj
     */
    var cancel = function ($obj) {
        $.post("setCancel", {content: 'text', data: $obj}, function (response) {
            if (response) {
                alertify.success('Cancel Succefully');
                // location.reload();
                table();
            } else {
                alertify.alert("Something was wrong. Please verify!");
            }
        });
    };
});

