/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    /**
     *
     */
    $('.collapsible').collapsible();
    $('.modal').modal();
    $('select').material_select();
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 50 // Creates a dropdown of 15 years to control year
    });
    $('.picker').appendTo('body');
    var $details = $("#details");
    $details.DataTable({
        "columnDefs": [
            {"className": "mdl-data-table__cell--non-numeric dt-center ", "targets": "_all"}
        ]
    });
    /**
     *
     */
    var table = function () {
//        alert("dsf");
        $.ajax({
            type: 'get',
            dataType: 'text',
            url: 'getEmpleado',
            data: {
                content: 'text'
            },
            success: function (response) {
                $details.DataTable().destroy();
                $details.find('tbody').html(response);
                $details.DataTable({
                    "columnDefs": [{
                        "className": "mdl-data-table__cell--non-numeric dt-center",
                        "targets": "_all"
                    }]
                });
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
    var nacionalidad = function () {
        $.ajax({
            dataType: 'json',
            url: 'getNacionalidad',
            data: {
                content: 'text'
            },
            success: function (response) {
                $html = '<option value="" disabled selected>Choose your option</option>';
                $.each(response.data, function (index, value) {
                    $html += '<option value="' + value.id_record + '">' + value.description + '</option>';
                });
                $("#nacionalidad").html($html);
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
    var Tipo = function () {
        $.ajax({
            dataType: 'json',
            url: 'getDescriptionByTipo',
            data: {
                content: 'text',
                tipo: 'tipo_empleado'
            },
            success: function (response) {
                $html = '<option value="" disabled selected>Choose your option</option>';
                $.each(response.data, function (index, value) {
                    $html += '<option value="' + value.id_record + '">' + value.description + '</option>';
                });
                $("#tipo").html($html);
                $('select').material_select();
            }
        });
    };
    /**
     *
     */
    table();
    expandAll();
    /**
     *
     */
    $("#addRecord").on('click', function () {
        pais();
        nacionalidad();
        Tipo();
        $("#modal1").modal('open');
    });
    /**
     *
     */
    $("#pais").on('change', function () {
        Ciudad($(this).val());
    });
    /**
     *
     */
    $("#ciudad").on('change', function () {
        Sector($(this).val());
    });

    /**
     *
     */
    function expandAll() {
        $(".collapsible-header").addClass("active");
        $(".collapsible").collapsible({accordion: false});
    }

    /**
     *
     */
    $("#save").on('click', function () {
        data = new Object();
        data.name = $("#name").val();
        data.last_name = $("#last_name").val();
        data.cedula = $("#cedula").val();
        data.date = $("#date").val();
        data.sexo = $("#sexo").val();
        data.email = $("#email").val();
        data.phone = $("#phone").val();
        data.admission_date = $("#admission_date").val();
        data.estado_civil = $("#estado_civil").val();
        data.pais = $("#pais").val();
        data.nacionalidad = $("#nacionalidad").val();
        data.ciudad = $("#ciudad").val();
        data.sector = $("#sector").val();
        data.tipo = $("#tipo").val();
        data.direccion = $("#direccion").val();
        $.post("setEmpleado", {content: 'text', data: data}, function (data) {
            alertify.success('Save Succefully')
            table();
            $("#pais").val('');
            $("#name").val('');
            $("#date").val('');
            $("#sexo").val('');
            $("#tipo").val('');
            $("#email").val('');
            $("#phone").val('');
            $("#cedula").val('');
            $("#ciudad").val('');
            $("#sector").val('');
            $("#last_name").val('');
            $("#nacionalidad").val('');
            $("#estado_civil").val('');
            $("#admission_date").val('');
            $('#modal1').modal('close');
        });
    });
    /**
     *
     */
    $("#cancel").on('click', function () {
        alertify.error('Trassation Abort');
        $("#pais").val('');
        $("#name").val('');
        $("#date").val('');
        $("#sexo").val('');
        $("#tipo").val('');
        $("#email").val('');
        $("#phone").val('');
        $("#cedula").val('');
        $("#ciudad").val('');
        $("#sector").val('');
        $("#last_name").val('');
        $("#nacionalidad").val('');
        $("#estado_civil").val('');
        $("#admission_date").val('');
        $('#modal1').modal('close');
    });

    /**
     *
     */
    $details.on('click', '.info', function () {
        $('#modal2').modal('open');
        $.post('getEmpleado', {content: 'text', id: $(this).data('id')}, function (response) {
            $('#info').html(response);
        });
    });

});