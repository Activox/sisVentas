/**
 *
 */
$(document).ready(function () {

    $('.collapsible').collapsible();
    $('.modal').modal();
    $('.modal-content').css({'width': '155% !important'});
    $('select').material_select();
    $('.tooltipped').tooltip({delay: 50});
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
    });
    $('.picker').appendTo('body');
    var obj = new Object();
    /**
     *
     */
    ajax('almacen', 'getAlmacen2', 0);
    ajax('tipo', 'getDescriptionByTipo', 'tipo_pago');
    /**
     *
     */
    $("#search").on("click", function () {
        table();
    });
    /**
     *
     */
    $("#send").on("click", function () {
        obj.tipo = $("#tipo").val();
        obj.date = $("#date").val();
        obj.option = 1;
        petition(obj);
        $("#modal1").modal("close");
        window.open('compra/invoice/' + obj.id + '');
    });
    $("#details").on("click", "#send", function () {
        obj.id = $(this).data('id');
    });
    $("#details").on("click", "#check", function () {
        obj.id = $(this).data('id');
        obj.id_compra = $(this).data('id_compra');
    });
    $("#details").on("click", "#cancel", function () {
        obj.id = $(this).data('id');
        obj.id_compra = $(this).data('id_compra');
        var $message;
        if (obj.id_compra > 0) {
            obj.option = 2;
            $message = "Orden";
        }
        else {
            $message = "Solicitud";
            obj.option = 3;
        }
        alertify.confirm('Confirmacion', 'Se Cancelara la ' + $message + ' de Compra, Esta Seguro?', function () {
                petition(obj);
            }
            , function () {
                // alertify.error('Cancel');
            });


    });
    $("#completed").on("click", function () {
        obj.factura = $("#factura").val();
        obj.option = 3;
        petition(obj);
        $("#modal2").modal("close");
    });
    /**
     *
     */
    function table() {
        $.post("getSolicitud", {content: 'text', data: $("#almacen").val()}, function (response) {
            $("#details").html(response);
        });
    };

    function petition($obj) {
        $.post("updateSolicitud", {content: 'text', data: $obj}, function (response) {
            table();
        });
    }
});

