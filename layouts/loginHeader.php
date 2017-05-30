<?php

use lib\Config;
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title><?php echo Config::$_TITLE_APP ?></title>
        <!--Import Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <?php
        Route::getCss(array("materialize.min","custom", "alertify"), "", array(), TRUE);

        Route::getJs(array("jquery-1.11.0.min", "bootstrap.min", "materialize.min", "script", "alertify"), "", array(), TRUE);
        ?>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    </head>

    <body class="blue-grey lighten-1">
        





