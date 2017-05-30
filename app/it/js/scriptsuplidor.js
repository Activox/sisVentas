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
    
    $('.picker').appendTo('body');

    var table = function () {
        $.ajax({
            dataType: 'text',
            url: 'getSuplidor',
            data: {
                content: 'text'
            },
            success: function (response) {
                $("#details").html(response);
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
        data.name           =       $("#name").val();
        data.last_name      =       $("#last_name").val();
        data.cedula         =       $("#cedula").val();
        data.date           =       $("#date").val();
        data.sexo           =       $("#sexo").val();
        data.email          =       $("#email").val();
        data.phone          =       $("#phone").val();
        data.pais           =       $("#pais").val();
        data.nacionalidad   =       $("#nacionalidad").val();
        data.empresa        =       $("#empresa").val();
        data.ciudad         =       $("#ciudad").val();
        data.sector         =       $("#sector").val();
        data.tipo           =       $("#tipo").val();
        data.direccion      =       $("#direccion").val();
        $.post("setSuplidor", {content: 'text', data: data}, function (data) {
            alertify.success('Save Succefully')
            table();
            $("#name").val('');
            $("#last_name").val('');
            $("#cedula").val('');
            $("#date").val('');
            $("#sexo").val('');
            $("#email").val('');
            $("#phone").val('');
            $("#pais").val('');
            $("#nacionalidad").val('');
            $("#empresa").val('');
            $("#ciudad").val('');
            $("#sector").val('');
            $("#tipo").val('');
            $("#direccion").val('');
            $('#modal1').modal('close');
        });
    });
    $("#cancel").on('click', function () {
        alertify.error('Trassation Abort');
        $("#name").val('');
        $("#last_name").val('');
        $("#cedula").val('');
        $("#date").val('');
        $("#sexo").val('');
        $("#email").val('');
        $("#phone").val('');
        $("#pais").val('');
        $("#nacionalidad").val('');
        $("#empresa").val('');
        $("#ciudad").val('');
        $("#sector").val('');
        $("#tipo").val('');
        $("#direccion").val('');
        $('#modal1').modal('close');
    });
});