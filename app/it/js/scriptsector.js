/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {

    $('.collapsible').collapsible();
    $('.modal').modal();
    $('select').material_select();
    var $details = $("#details");
    var table = function () {
        $.ajax({
            dataType: 'text',
            url: 'getSector',
            data: {
                content: 'text'
            },
            success: function (response) {
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
    var ciudad = function () {
        $.ajax({
            dataType: 'json',
            url: 'getCiudad2',
            data: {
                content: 'text'
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
    table();
    expandAll();
    /**
     * 
     */
    $("#addRecord").on('click', function () {
        ciudad();

    });
    function expandAll() {
        $(".collapsible-header").addClass("active");
        $(".collapsible").collapsible({accordion: false});
    }

    $("#save").on('click', function () {
        data = new Object();
        data.ciudad         =   $("#ciudad").val();
        data.description    =   $("#description").val();
        $.post("setSector", {content: 'text', data: data}, function (data) {
            alertify.success('Save Succefully');
            table();
            $("#ciudad").val('');
            $("#description").val('');
            $('#modal1').modal('close');
        });
    });
    $("#cancel").on('click', function () {
        alertify.error('Trassation Abort');
        $("#ciudad").val('');
        $("#description").val('');
        $('#modal1').modal('close');
    });
});