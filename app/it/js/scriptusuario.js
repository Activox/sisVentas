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
    var $details = $("#details");
    $details.DataTable({
        "columnDefs": [{"className": "mdl-data-table__cell--non-numeric dt-center ", "targets": "_all"}]
    });
    $('.tooltipped').tooltip({delay: 50});

    var id_record = 0;
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
            url: 'getUsuario',
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
    var terminal = function () {
        $.ajax({
            dataType: 'json',
            url: 'getTerminal2',
            data: {
                content: 'text'
            },
            success: function (response) {
                html = '<option value = "" disabled selected> Choose your option </option>';
                $.each(response.data, function (index, value) {
                    html += '<option value = "' + value.id_record + '"> ' + value.description + ' </option>';
                });
                $("#terminal").html(html);
                $('select').material_select();
            }
        });
    };
    /**
     * fill comboBox.
     */
    $("#add").on('click', function () {
        empleado();
    });
    /**
     * Save records
     */
    $("#save").on('click', function () {
        data = new Object();
        data.empleado = $("#empleado").val();
        data.tipo = $("#tipo").val();
        data.username = $("#username").val();
        data.password = $("#password").val();
        data.rpassword = $("#rpassword").val();
        data.terminal = $("#terminal").val();
        if (data.password.length < 6) {
            alertify.alert("Alert", "The password must have 6 characters");
            return;
        }
        if (data.rpassword != data.password) {
            alertify.alert("Alert", "The passwords must be the same");
            return;
        }
        $.post("setUsuario", {content: 'text', data: data}, function (data) {
            if (data) {
                alertify.success('Save Succefully');
                table();
                $('#modal1').modal('close');
                $("#empleado").val('');
                $("#tipo").val('');
                $("#username").val('');
                $("#password").val('');
                $("#rpassword").val('');
                $("#terminal").val('');
            } else {
                alertify.alert("Alert", "Something was wrong. Please verify!");
            }
        });
    });

    /**
     * Close modal and trigger alert.
     */
    $("#cancel,#cancel2").on('click', function () {
        alertify.error('Trassation Abort');
        $("#empleado").val('');
        $("#tipo").val('');
        $("#username").val('');
        $("#password").val('');
        $("#rpassword").val('');
        $("#terminal").val('');
        $('#modal1').modal('close');
        $('#modal2').modal('close');
    });

    /**
     * edit modals.
     */
    $("#details").on('click', '.edit', function () {
        id_record = $(this).data('id');
        $("#modal2").css({
            'width': '75% !important',
            'max-height': '100% !important',
            'overflow-y': 'hidden !important'
        });
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
        $.post("updateUsuario", {content: 'text', data: data}, function (data) {
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

    $("#tipo").on('change', function () {
        if ($(this).val() == 3) {
            $("#terminal").prop("disabled", false);
            $('select').material_select();
            terminal();
        }
    });

});