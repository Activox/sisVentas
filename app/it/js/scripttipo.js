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
    $('.modal-content').css({'width': '155% !important'});
    $(".menuBtn").hide();
    $('.tooltipped').tooltip({delay: 50});
    var $tableDetails = $("#tabledetails");
    $tableDetails.DataTable( {
        "columnDefs": [
            {"className": "mdl-data-table__cell--non-numeric dt-center ", "targets": "_all"}
        ]
    });

    var id_record = 0;

    /**
     * fill the table
     * @returns {undefined}
     */
    var table = function () {
        $.ajax({
            dataType: 'text',
            url: 'getTipo',
            data: {
                content: 'text'
            },
            success: function (response) {
                $tableDetails.DataTable().destroy();
                $("#tabledetails > tbody").html(response);
                $tableDetails.DataTable({ "columnDefs": [ {"className": "mdl-data-table__cell--non-numeric dt-center", "targets": "_all"} ] });
                $('select').material_select();
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
        data.tipo = $("#tipo").val();
        data.description = $("#description").val();
        $.post("setTipo", {content: 'text', data: data}, function (data) {
            if (data) {
                alertify.success('Save Succefully');
                table();
                $('#modal1').closeModal();
                $("#tipo").val('');
                $("#description").val('');
            } else {
                alertify.alert("Something was wrong. Please verify!");
            }
        });
    });

    /**
     * Close modal and trigger alert.
     */
    $(".cancel").on('click', function () {
        alertify.error('Trassation Abort');
        $("#tipo").val('');
        $("#description").val('');
        $('#modal1').closeModal();
        $('#modal2').closeModal();
    });

    /**
     * edit modals.
     */
    $tableDetails.on('click', '.edit', function () {
        id_record = $(this).data('id');
        $("#modal2").css({'width': '75% !important', 'max-height': '100% !important', 'overflow-y': 'hidden !important'});
        $("#tipo2").val($(this).data('tipo'));
        $("#description2").val($(this).data('descripcion'));
        $("#active").val($(this).data('active'));
        Materialize.updateTextFields();
        $('select').material_select('update');
        $('#modal2').openModal();
    });

    /**
     * update records
     */
    $("#update").on('click', function (){
        data = new Object();
        data.id_record = id_record;
        data.tipo = $("#tipo2").val();
        data.description = $("#description2").val();
        data.active = $("#active").val();
        $.post("updateTipo", {content: 'text', data: data}, function (data) {
            if (data) {
                alertify.success('Update Succefully');
                table();
                $('#modal2').closeModal();
            } else {
                alertify.alert("Something was wrong. Please verify!");
            }
        });
    });
    
    
    table();
    expandAll();

});