/**
 * Created by pottenwalder on 4/7/2017.
 */
$(document).ready(function () {
    var id_record = 0;
    /**
     * fill the table
     * @returns {undefined}
     */
    var table = function ($post, $id) {
        $("#" + $id + "").DataTable( {
            "columnDefs": [
                {"className": "mdl-data-table__cell--non-numeric dt-center ", "targets": "_all"}
            ]
        });
        $.ajax({
            dataType: 'text',
            url: "" + $post + "",
            data: {
                content: 'text'
            },
            success: function (response) {
                $("#" + $id + "").DataTable().destroy();
                $("#" + $id + "").find('tbody').html(response);
                $("#" + $id + "").DataTable({ "columnDefs": [ {"className": "mdl-data-table__cell--non-numeric dt-center", "targets": "_all"} ]
                ,"searching":false,"bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bInfo": false,
                    "bAutoWidth": false
                });
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
    table("getPorcentajeBySubcategoria", "detail");
    table("getPorcentajeByArticulo", "details");
    /**
     *
     * @param $data
     */
    function petition($data) {
        $.post("setPorcentaje", {content: 'text', data: $data}, function (data) {
            table("getPorcentajeBySubcategoria", "detail");
            table("getPorcentajeByArticulo", "details");
            $("#records")[0].reset();
            $("#record")[0].reset();
        });
    }
});