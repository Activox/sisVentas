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
    Route::getCss(array("yaroa", "materialize", "custom", "alertify", "font-awesome.min", "jquery.flexdatalist.min"), "", array(), TRUE);

    Route::getJs(array("jquery-3.1.1", "materialize.min", "script", "alertify", "jquery.flexdatalist.min"), "", array(), TRUE);
    ?>
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>