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
     * search records
     */
    $("#search").on("click", function () {
        table("getCompra", "details");
    });
    $("#search2").on("click", function () {
        table("getInventorio", "details2");
    });
    /**
     * Generate the main table
     */
    function table($post, $id) {
        $.post("" + $post + "", {content: 'text', data: $("#almacen").val()}, function (response) {
            $("#" + $id + "").html(response);
        });
    }

    ajax('almacen', 'getAlmacen2', 0);

    /**
     * Insert product to inventory.
     */
    $("#details").on("click", "#insert", function () {
        obj.id = $(this).data("id");
        obj.id_almacen = $("#almacen").val();
        petition(obj);
    });
    /**
     *
     * @param $obj
     */
    function petition($obj) {
        $.post("setInventario", {content: 'text', data: $obj}, function (response) {
            table("getCompra", "details");
        });
    }

});

