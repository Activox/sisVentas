/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $.ajax({
        dataType: 'text',
        url: 'getVenta',
        data: {
            content: 'text'
        },
        success: function (response) {
            $("#table").html(response);
            getTable('#table', 'tr.head');
        }
    });
});


