/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {

    /**
     * Initialization elements
     */
    $('.collapsible').collapsible();
    $('.modal').modal();
    $('.modal-content').css({'width': '155% !important'});
    $('select').material_select();
    $('.tooltipped').tooltip({delay: 50});
    var id_record = 0;
    var $details = $('#details');
    $details.DataTable( {
        "columnDefs": [
            {"className": "mdl-data-table__cell--non-numeric dt-center ", "targets": "_all"}
        ]
    });

    /**
     * fill the table
     * @returns {undefined}
     */
    var table = function () {
        $.ajax({
            dataType: 'text',
            url: 'getAlmacen',
            data: {
                content: 'text'
            },
            success: function (response) {
                $details.DataTable().destroy();
                $details.find('tbody').html(response);
                $details.DataTable({ "columnDefs": [ {"className": "mdl-data-table__cell--non-numeric dt-center", "targets": "_all"} ] });
                $('select').material_select();
            }
        });
    };
    var pais = function () {
        $.ajax({
            dataType: 'json',
            url: 'getPais2',
            data: {
                content: 'text'
            },
            success: function (response) {
                $html = '<option value="" disabled selected>Choose your option</option>';
                $.each(response.data, function (index, value) {
                    $html += '<option value="' + value.id_record + '">' + value.description + '</option>';
                });
                $("#pais").html($html);
                $('select').material_select();
            }
        });
    };
    var Ciudad = function (id) {
        $.ajax({
            dataType: 'json',
            url: 'getCiudadByPais',
            data: {
                content: 'text',
                id: id
            },
            success: function (response) {
                $html = '<option value="" disabled selected>Choose your option</option>';
                $.each(response.data, function (index, value) {
                    $html += '<option value="' + value.id_record + '">' + value.description + '</option>';
                });
                $("#ciudad").html($html);
                $('select').material_select();
            }
        });
    };
    var Sector = function (id) {
        $.ajax({
            dataType: 'json',
            url: 'getSectorByCiudad',
            data: {
                content: 'text',
                id: id
            },
            success: function (response) {
                $html = '<option value="" disabled selected>Choose your option</option>';
                $.each(response.data, function (index, value) {
                    $html += '<option value="' + value.id_record + '">' + value.description + '</option>';
                });
                $("#sector").html($html);
                $('select').material_select();
            }
        });
    };
    /**
     * create combo box
     * @returns {undefined}
     */
    var empleado = function () {
        $.ajax({
            dataType: 'json',
            url: 'getEmpleado2',
            data: {
                content: 'text'
            },
            success: function (response) {
                html = '<option value = "" disabled selected> Choose your option </option>';
                $.each(response.data, function (index, value) {
                    html += '<option value = "' + value.id_empleado + '"> ' + value.nombre + '  ' + value.apellidos + ' </option>';
                });
                $("#empleado").html(html);
                $('select').material_select();
            }
        });
    };

    /**
     * fill comboBox.
     */
    $("#add").on('click', function () {
        pais();
        empleado();
    });
    $("#pais").on('change', function () {
        Ciudad($(this).val());
    });
    $("#ciudad").on('change', function () {
        Sector($(this).val());
    });
    /**
     * Get Subcategory
     */
    $("#categoria").on('change', function () {
        subcategorias($(this).val());
    });

    /**
     * Expand the colaps
     * @returns {undefined}
     */
    function expandAll() {
        $(".collapsible-header").addClass("active");
        $(".collapsible").collapsible({accordion: false});
    }

    /**
     * Save records
     */
    $("#save").on('click', function () {
        data = new Object();
        data.almacen        =    $("#almacen").val();
        data.empleado       =    $("#empleado").val();
        data.sector         =    $("#sector").val();
        data.description    =    $("#direccion").val();
        $.post("setAlmacen", {content: 'text', data: data}, function (data) {
            if (data) {
                alertify.success('Save Succefully');
                table();
                $('#modal1').modal('close');
                $("#almacen").val('');
                $("#empleado").val('');
                $("#sector").val('');
                $("#direccion").val('');
            } else {
                alertify.alert("Something was wrong. Please verify!");
            }
        });
    });

    /**
     * Close modal and trigger alert.
     */
    $("#cancel,#cancel2").on('click', function () {
        alertify.error('Trassation Abort');
        $("#almacen").val('');
        $("#empleado").val('');
        $("#sector").val('');
        $("#direccion").val('');
        $('#modal1').modal('close');
        $('#modal2').modal('close');
    });

    /**
     * edit modals.
     */
    $("#details").on('click', '.edit', function () {
        id_record = $(this).data('id');
        $("#modal2").css({'width': '75% !important', 'max-height': '100% !important', 'overflow-y': 'hidden !important'});
        $("#description2").val($(this).data('descripcion'));
        $("#active").val($(this).data('active'));
        Materialize.updateTextFields();
        $('select').material_select('update');
        $('#modal2').modal('open');
    });

    /**
     * update records
     */
    $("#update").on('click', function () {
        data = new Object();
        data.id_record = id_record;
        data.description = $("#description2").val();
        data.active = $("#active").val();
        $.post("updateAlmacen", {content: 'text', data: data}, function (data) {
            if (data) {
                alertify.success('Update Succefully');
                table();
                $('#modal2').modal('close');
            } else {
                alertify.alert("Something was wrong. Please verify!");
            }
        });
    });
    table();
    expandAll();
});