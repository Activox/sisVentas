/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    /**
     * Call Main Menu
     */
    $("#btn_login").on('click', function () {
        login();
    });
    /**
     *
     */
    $(document).keypress(function (e) {
        if (e.which == 13) {
            login();
        }
    });
    /**
     *
     */
    function login() {
        data = new Object();
        data.username = $("#username").val();
        data.clave = $("#clave").val();
        $.post("validateUser", {content: 'text', data: data}, function (data) {
            if (data == 1) {
                $(location).attr('href', 'menu');
            } else {
                alertify.alert("Alert", "Username or Password are Worng. Please Verify!");
            }
        });
    }
});

