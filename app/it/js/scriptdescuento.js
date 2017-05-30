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
        $.ajax({
            dataType: 'text',
            url: "" + $post + "",
            data: {
                content: 'text'
            },
            success: function (response) {
                $("#" + $id + "").html(response);
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
     *
     */
    ajax('tipo', 'getDescriptionByTipo', 'tipo_descuento');

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
    $("#save3").on("click", function () {
        $data = $("#records2").serializeObject();
        $data.option = 3;
        petition($data);
    });
    /**
     * Call table
     */
    table("getDescuentoBySubcategoria", "detail");
    table("getDescuentoByArticulo", "details");
    table("getDescuentoByTipo", "details2");
    /**
     *
     * @param $data
     */
    function petition($data) {
        $.post("setDescuento", {content: 'text', data: $data}, function (data) {
            if (data) {
                switch ($data.option) {
                    case 1:
                        table("getDescuentoBySubcategoria", "detail");
                        $("#record")[0].reset();
                        break;
                    case 2:
                        table("getDescuentoByArticulo", "details");
                        $("#records")[0].reset();
                        break;
                    case 3:
                        table("getDescuentoByTipo", "details2");
                        $("#records2")[0].reset();
                        break;
                }
                alertify.success('Save Succefully');
            } else {
                alertify.alert("Error","Something was wrong. Please verify!");
            }

        });
    }
});
