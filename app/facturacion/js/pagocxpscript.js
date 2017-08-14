/**
 * Created by paul9 on 8/13/2017.
 */
$(function () {
    /**
     *
     */
    ajax('almacen', 'getAlmacen2', 0);
    ajax('suplidor', 'getSuplidor2', 0);
    var obj = new Object();
    /**
     *
     */
    $("#btnSearch").on("click", function () {
        setValue();
        if (obj.suplidor == 0) {
            alertify.alert('Completar Campos', 'Debe elegir un suplidor para poder buscar sus facturas', function () {
                alertify.success('Ok');
            });
            return false;
        }
        table();
    });
    /**
     *
     */
    $(".paybtn").on("click", "#btnPay", function () {
        alertify.prompt('Cantidad a acreditar', 'Monto', 'DOP$ 0.00'
            , function (evt, value) {
                setValue();
                obj.monto = value;
                $.post('setPay', {data: obj, content: 'text'}, function (response) {
                    table();
                });
            }
            , function () {
                alertify.error('Cancel')
            });
    });
    function table() {
        $.post('getCxp', {data: obj, content: 'text'}, function (response) {
            $(".paybtn").html('  <a class="waves-effect waves-light btn" id="btnPay"><i class="fa fa-money" aria-hidden="true"></i>  Pagar</a>');
            $("#table").html(response);
        });
    }

    function setValue() {
        obj.dateFrom = $("#dateFrom").val() == undefined ? "" : $("#dateFrom").val();
        obj.dateTo = $("#dateTo").val() == undefined ? "" : $("#dateTo").val();
        obj.suplidor = $("#suplidor").val() == undefined ? 0 : $("#suplidor").val();
        obj.almacen = $("#almacen").val() == undefined ? 0 : $("#almacen").val();
        obj.estado = 1;
        obj.option = 0;
    }

});