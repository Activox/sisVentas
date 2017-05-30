<?php
Route::getCss(array("login"), "Defaults", array(), false);
Route::getJs(array("loginScript"), "Defaults", array(), false);
?>
<div class="section"></div>
<main>
    <center>      
        <div class="section"></div>


        <div class="section"></div>

        <div class="container">
            <div class="z-depth-3 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

                <form class="col s12" method="post">
                    <div class='row'>
                        <div class='col s12'>
                        </div>
                    </div>
                    <h5 class="teal-text">Sistema de Punto de Venta</h5>
                    <div class='row'>
                        <div class='input-field col s12'>
                            <input class='validate' type='text' name='username' id='username' />
                            <label for='username'>Enter your Username</label>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='input-field col s12'>
                            <input class='validate' type='password' name='clave' id='clave' />
                            <label for='clave'>Enter your password</label>
                        </div>
                        <label style='float: right;'>
                            <a class='teal-text' href='#!'><b>Forgot Password?</b></a>
                        </label>
                    </div>

                    <br />
                    <center>
                        <div class='row'>
                            <a id='btn_login' class='col s12 waves-effect waves-light btn btn-large'>Login</a>
                        </div>
                    </center>
                </form>
            </div>
        </div>
    </center>

    <div class="section"></div>
    <div class="section"></div>
</main>