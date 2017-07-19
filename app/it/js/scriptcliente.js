/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {

    $('.collapsible').collapsible();
    $('.modal').modal();
    $('select').material_select();
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15 // Creates a dropdown of 15 years to control year
    });
    var $details = $("#details");
    $details.DataTable( {
        "columnDefs": [
            {"className": "mdl-data-table__cell--non-numeric dt-center ", "targets": "_all"}
        ]
    });
    $('.picker').appendTo('body');

    var table = function () {
        $.ajax({
            dataType: 'text',
            url: 'getCliente',
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
    table();
    expandAll();
    /**
     *
     */
    $("#addRecord").on('click', function () {
        pais();

    });
    function expandAll() {
        $(".collapsible-header").addClass("active");
        $(".collapsible").collapsible({accordion: false});
    }

    $("#save").on('click', function () {
        data = new Object();
        data.name = $("#name").val();
        data.last_name = $("#last_name").val();
        data.cedula = $("#cedula").val();
        data.date = $("#date").val();
        data.sexo = $("#sexo").val();
        data.email = $("#email").val();
        data.phone = $("#phone").val();
        data.pais = $("#pais").val();
        data.nacionalidad = $("#nacionalidad").val();
        data.ciudad = $("#ciudad").val();
        data.sector = $("#sector").val();
        data.tipo = $("#tipo").val();
        data.direccion = $("#direccion").val();
        $.post("setCliente", {content: 'text', data: data}, function (data) {
            alertify.success('Save Succefully')
            table();
            $("#name").val('');
            $("#tipo").val('');
            $("#date").val('');
            $("#sexo").val('');
            $("#pais").val('');
            $("#email").val('');
            $("#phone").val('');
            $("#cedula").val('');
            $("#ciudad").val('');
            $("#sector").val('');
            $("#last_name").val('');
            $("#direccion").val('');
            $("#nacionalidad").val('');
            $('#modal1').modal('close');
        });
    });
    $("#cancel").on('click', function () {
        alertify.error('Trassation Abort');
        $("#name").val('');
        $("#tipo").val('');
        $("#date").val('');
        $("#sexo").val('');
        $("#pais").val('');
        $("#email").val('');
        $("#phone").val('');
        $("#cedula").val('');
        $("#ciudad").val('');
        $("#sector").val('');
        $("#last_name").val('');
        $("#direccion").val('');
        $("#nacionalidad").val('');
        $('#modal1').modal('close');
    });
    $("#close").on('click', function () {
        $('#modal2').modal('close');
    });

    /**
     *
     */
    $details.on('click', '.info', function () {
        $('#modal2').modal('open');

        $.post('getCliente', {content: 'text', id: $(this).data('id')}, function (response) {
            $('#info').html(response);
        });
    });
});