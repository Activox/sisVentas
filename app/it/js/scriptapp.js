/**
 * Created by pottenwalder on 6/6/2017.
 */
$(function () {
    $(".menuBtn").hide();
    var $tableDetails = $("#tabledetails");
    $tableDetails.DataTable({
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
            url: 'getAppTable',
            data: {
                content: 'text'
            },
            success: function (response) {
                $tableDetails.DataTable().destroy();
                $tableDetails.find("tbody").html(response);
                $tableDetails.DataTable({
                    "columnDefs": [{
                        "className": "mdl-data-table__cell--non-numeric dt-center",
                        "targets": "_all"
                    }]
                });
                $('select').material_select();
            }
        });
    };

    /**
     * Save records
     */
    $("#save").on('click', function () {
        data = new Object();
        data.icon = $("#icon").val();
        data.url = $("#url").val();
        data.id_father = $("#father").val();
        data.id_tipo = $("#tipo").val();
        data.description = $("#description").val();
        $.post("setApp", {content: 'text', data: data}, function (data) {
            if (data) {
                alertify.success('Save Succefully');
                table();
                $('#modal1').closeModal();
                cleanInputs();
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
        cleanInputs();
        $('#modal1').closeModal();
        $('#modal2').closeModal();
    });

    /**
     * edit modals.
     */
    $tableDetails.on('click', '.edit', function () {
        ajax('father', 'getApp', 0);
        ajax('tipo', 'getDescriptionByTipo', 'tipo_application');
        id_record = $(this).data('id');

        $("#modal2").css({
            'width': '75% !important',
            'max-height': '100% !important',
            'overflow-y': 'hidden !important'
        });

        $.get("setAppById", {content: 'json', data: id_record}, function (response) {
            $("#icon2").val(response.icon);
            $("#url2").val(response.url);
            $(document).ajaxComplete(function () {
                $("#father2").val(response.id_father);
                $("#tipo2").val(response.id_tipo);
            });
            $("#description2").val(response.description);
            $("#active").val(response.active);
        });


        Materialize.updateTextFields();
        $('select').material_select('update');
        $('#modal2').openModal();

    });

    /**
     * update records
     */
    $("#update").on('click', function () {
        data = new Object();
        data.id_record = id_record;
        data.icon = $("#icon2").val();
        data.url = $("#url2").val();
        data.id_father = $("#father2").val();
        data.id_tipo = $("#tipo2").val();
        data.description = $("#description2").val();
        data.active = $("#active").val();
        $.post("updateApp", {content: 'text', data: data}, function (data) {
            if (data) {
                alertify.success('Update Succefully');
                table();
                $('#modal2').closeModal();
            } else {
                alertify.alert("Something was wrong. Please verify!");
            }
        });
    });

    /**
     * this function reset the inputs.
     */
    function cleanInputs() {
        $("#icon").val('');
        $("#url").val('');
        $("#father").val('');
        $("#description").val('');
        $("#tipo").val('');
    }

    ajax('father', 'getApp', 0);
    ajax('tipo', 'getDescriptionByTipo', 'tipo_application');
    table();
});