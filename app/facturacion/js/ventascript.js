/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    // getTable('#table', 'tr.head');
    ajax('almacen', 'getAlmacen2', 0);
    $("#btnSearch").on("click", function () {
        obj = new Object();
        obj.dateFrom = $("#dateFrom").val() == undefined ? "" : $("#dateFrom").val();
        obj.dateTo = $("#dateTo").val() == undefined ? "" : $("#dateTo").val();
        obj.almacen = $("#almacen").val() == undefined ? 0 : $("#almacen").val();
        $.ajax({
            dataType: 'text',
            url: 'getVenta',
            data: {
                data: obj,
                content: 'text'
            },
            success: function (response) {
                $("#table").html(response);
            }
        });
    });
});


