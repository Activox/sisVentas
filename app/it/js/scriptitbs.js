/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {


    /**
     * fill the table
     * @returns {undefined}
     */
    var table = function ($post, $id) {
        $.ajax({
            dataType: 'text',
            url: "" + $post + "",
            data: {
                content: 'text'
            },
            success: function (response) {
                $("#" + $id + "").find('tbody').html(response);
                $("#" + $id + "").DataTable({ "columnDefs": [ {"className": "mdl-data-table__cell--non-numeric dt-center", "targets": "_all"} ]
                    ,"searching":false,"bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bInfo": false,
                    "bAutoWidth": false});
                $('select').material_select();
            }
        });
    };
    /**
     *
     */
    ajax('categoria', 'getCategoria2', 0);
    /**
     *
     */
    ajax('suplidor', 'getSuplidor2', 0);

    /**
     * Get Subcategory
     */
    $("#categoria").on('change', function () {
        ajax('subcategoria', 'getSubcategoria2', $(this).val());
    });
    /**
     * Get Products
     */
    $("#suplidor").on("change", function () {
        ajax('articulo', 'getArticulo3', $(this).val());
    });
    /**
     * Save Action
     */
    $("#save").on("click", function () {
        $data = $("#record").serializeObject();
        $data.option = 1;
        petition($data);

    });
    $("#save2").on("click", function () {
        $data = $("#records").serializeObject();
        $data.option = 2;
        petition($data);
    });
    /**
     * Call table
     */
    table("getImpuestoBySubcategoria", "detail");
    table("getImpuestoByArticulo", "details");
    /**
     *
     * @param $data
     */
    function petition($data) {
        $.post("setItbs", {content: 'text', data: $data}, function (data) {
            table("getImpuestoBySubcategoria", "detail");
            table("getImpuestoByArticulo", "details");
            $("#records")[0].reset();
            $("#record")[0].reset();
        });
    }

});