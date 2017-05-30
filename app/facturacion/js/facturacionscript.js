/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    var pay_type;
    $("#pay_type").on('click', function () {
        switch_Activate();
    })
    function switch_Activate() {
        pay_type = $('#pay_type').prop('checked');
        pay_type = pay_type == true ? 1 : 0;
    }

    ajax('descuento', 'getDescuento', 0);
    ajax('cliente', 'getClienteName', 0);
    var data = new Object();
    $("#barcode").on('keypress', function (e) {
        if (e.which == 13) {
            $("#qty").val('1').focus();
        }
    })
    $("#qty").on('keypress', function (e) {
        if (e.which == 13) {
            scanArticulo();
        }
    });
    $("#btnadd").on('click', function () {
        scanArticulo();
    })
    /**
     *
     * @param e
     */
    function scanArticulo() {
        data.barcode = $("#barcode").val();
        data.descuento = $("#descuento").val() == '' ? 0 : $("#descuento").val();
        data.qty = $("#qty").val();
        if (data.barcode != "") {
            $.post("scanArticulo", {content: 'text', data: data}, function (response) {
                if (response.code == 404) {
                    alertify.alert("Alert", response.msg);
                } else {
                    $("#details").html(response.data);
                    $("#stotal").html($.number(response.stotal, 2));
                    $("#desc").html($.number(response.desc, 2));
                    data.total = response.stotal - response.desc;
                    $("#total").html($.number(data.total, 2));
                }
            }, 'json');
            $("#barcode").val('').focus();
            $("#qty").val('');
        }
    }

    $("#btnfacturar").on('click', function () {
        data.descuento = $("#descuento").val();
        data.cliente = $("#cliente").val();
        switch_Activate();
        data.tipo = pay_type;
        console.log(data);
        if (data.tipo == 1 && data.cliente == null) {
            alertify.alert('Alert', 'You Must select a client.');
        } else {
            $("#modal1").modal('open');
            $("#dinero").focus();
        }
    });
    $("#barcode").focus();
    $("#dinero").on('keyup', function (e) {
        let n = 0;
        console.log($(this).val())
        n = $(this).val() - data.total;
        if (n > 0) {
            $("#devuelta").html('<b>Devuelta:</b> DOP$ ' + $.number(n, 2));
        }
    });
    $("#print").on('click', function () {

        if (data.tipo == 1 && data.cliente == null) {
            alertify.alert('Alert', 'You Must select a client.');
        } else {
            $.post("setFactura", {content: 'text', data: data}, function (data) {
                window.open('facturacion/invoice/' + data + '');
            });
        }
    })
});


