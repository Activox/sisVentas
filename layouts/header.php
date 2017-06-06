<?php

use lib\Config;

$session = \Factory::getSession();
if (!isset($session->username)) {
    header('Location: login');
}
$baseroot = _HOST_ . _DIRECTORY_ . _DS_;
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title><?php echo Config::$_TITLE_APP ?></title>
        <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <?php
        Route::getCss(array("yaroa", "materialize", "custom", "alertify","font-awesome.min"), "", array(), TRUE);
        Route::getJs(array("jquery-3.1.1", "materialize.min", "script", "alertify","jquery.number"), "", array(), TRUE);
        Route::getLib(array("jquery.dataTables.min"), "lib", "js", "", array("vendor", "plugins", "data-tables", "js"), TRUE);
        Route::getLib(array("jquery.dataTables.min"), "lib", "css", "", array("vendor", "plugins", "data-tables", "css"), TRUE);
        ?>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    </head>

    <body>
        <ul id="slide-out" class="side-nav">
            <li>
                <div class="userView">
                    <div class="background dark-primary-color">
<!--                        <img src="images/office2.jpg">-->
                    </div>
                    <center><a href="menu"><img class="circle" src="images/images.jpg"></a>
                        <span class="white-text name">
                            <?php
                            echo $session->name . "<p>( " . $session->username . " )</p>";
                            ?>
                        </span><span class="white-text email">
                            <?php
                            echo $session->email;
                            ?>
                        </span></center>
                </div>
            </li>
            <li><a href="menu"><i class="material-icons">dashboard</i>Dashboard</a></li>
            <li><a href="it"><i class="material-icons">desktop_windows</i>IT</a></li>
            <li><a href="compras"><i class="material-icons">shopping_cart</i>Compras</a></li>
            <li><a href="contabilidad"><i class="material-icons">attach_money</i>Contabilidad</a></li>
            <li><a href="facturacion"><i class="material-icons">credit_card</i>Facturacion</a></li>
            <li><a href="almacen"><i class="material-icons">store</i>Almacen</a></li>
            <li>
                <div class="divider"></div>
            </li>

            <li><a href="logout"><i class="material-icons">exit_to_app</i>Logout</a></li>
        </ul>
        <div class="row">
            <nav class="dark-primary-color">
                <div class="nav-wrapper">
                    <a href="#" class="brand-logo" data-activates="slide-out"><i class=" button-collapse small material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li><?php echo "" . date("m/d/y h:i:sa") . "    "; ?></li>
                        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="chip dark-primary-color text-primary-color">
                                <img src="images/images.jpg" alt="Contact Person">
                                <?php
                                echo $session->name;
                                ?>
                            </div></li>&nbsp;&nbsp;&nbsp;
                        <li><a href="logout"><i class="material-icons">exit_to_app</i></a></li>
                    </ul>
                </div>
            </nav>

        </div>




