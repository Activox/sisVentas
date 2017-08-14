/**
 * Created by paul9 on 8/13/2017.
 */
$(function () {
    ajax('almacen', 'getAlmacen2', 0);
    ajax('suplidor', 'getSuplidor2', 0);
    $("#btnSearch").on("click", function () {
        obj = new Object();
        obj.dateFrom = $("#dateFrom").val() == undefined ? "" : $("#dateFrom").val();
        obj.dateTo = $("#dateTo").val() == undefined ? "" : $("#dateTo").val();
        obj.suplidor = $("#suplidor").val() == undefined ? 0 : $("#suplidor").val();
        obj.almacen = $("#almacen").val() == undefined ? 0 : $("#almacen").val();
        obj.estado = $("#status").val() == undefined ? 0 : $("#status").val();
        obj.option = 1;
        $.post('getCxp', {data: obj, content: 'text'}, function (response) {
            $("#table").html(response);
        });
    });
});