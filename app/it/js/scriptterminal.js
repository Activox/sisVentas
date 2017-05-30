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

    /**
     * fill the table
     * @returns {undefined}
     */
    var table = function () {
        $.ajax({
            dataType: 'text',
            url: 'getTerminal',
            data: {
                content: 'text'
            },
            success: function (response) {
                $("#details").html(response);
            }
        });
    };

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
        data.description = $("#description").val();
        $.post("setTerminal", {content: 'text', data: data}, function (data) {
            if (data) {
                alertify.success('Save Succefully');
                table();
                $('#modal1').modal('close');
                $("#description").val('');
                $("#description").val('');
            } else {
                alertify.alert("Something was wrong. Please verify!");
            }
        });
    });

    /**
     * Close modal and trigger alert.
     */
    $("#cancel").on('click', function () {
        alertify.error('Trassation Abort');
        $("#description").val('');
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
    $("#update").on('click', function (){
        data = new Object();
        data.id_record = id_record;
        data.description = $("#description2").val();
        data.active = $("#active").val();
        $.post("updateTerminal", {content: 'text', data: data}, function (data) {
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