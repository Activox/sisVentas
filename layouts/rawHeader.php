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
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Sistema de ventas.">
    <meta name="keywords" content="Ventas">
    <title> <?php echo Config::$_TITLE_APP ?> </title>
    <!-- Favicons-->
    <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">
    <!-- Favicons-->
    <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
    <!-- For iPhone -->
    <meta name="msapplication-TileColor" content="#00bcd4">
    <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
    <!-- For Windows Phone -->
    <?php

    //    CSS
    Route::getCss(array("materialize.min", "style"), "", array("css"), TRUE);
    Route::getCss(array("custom"), "", array("css", "custom"), TRUE);
    Route::getCss(array("alertify"), "", array(), TRUE);
    //      Libs
    // CSS
    Route::getLib(array("prism"), "vendor", "css", "", array("plugins", "prism"), TRUE);
    Route::getLib(array("perfect-scrollbar"), "vendor", "css", "", array("plugins", "perfect-scrollbar"), TRUE);
    Route::getLib(array("chartist.min"), "vendor", "css", "", array("plugins", "chartist-js"), TRUE);
    Route::getLib(array("jquery.dataTables.min"), "lib", "css", "", array("vendor", "plugins", "data-tables", "css"), TRUE);

    // JS
    Route::getLib(array("jquery-1.11.2.min"), "lib", "js", "", array("vendor", "plugins"), TRUE);
    Route::getLib(array("perfect-scrollbar.min"), "lib", "js", "", array("vendor", "plugins", "perfect-scrollbar"), TRUE);
    Route::getLib(array("jquery.dataTables.min"), "lib", "js", "", array("vendor", "plugins", "data-tables", "js"), TRUE);
//        Route::getLib(array("chartist.min"),"lib","js","",array("vendor","plugins","chartist-js"), TRUE);
    Route::getLib(array("prism"), "lib", "js", "", array("vendor", "plugins", "prism"), TRUE);
    Route::getLib(array("jquery.dataTables.min"), "lib", "js", "", array("vendor", "plugins", "data-tables", "js"), TRUE);

    //    JS
    Route::getJs(array("materialize.min", "plugins", "custom-script"), "", array("js"), TRUE);
    Route::getJs(array("alertify","jquery.number"), "", array(), TRUE);

    $escaped_url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
    list($url2, $framework, $actual_url) = explode("/", $escaped_url);
    list($module, $type, $app) = explode("-", $actual_url);
    ?>
</head>

<body>
<section id="content">
    <!--breadcrumbs start-->
    <div id="breadcrumbs-wrapper">
        <!-- Search for small screen -->
<!--        <div class="header-search-wrapper grey hide-on-large-only">-->
<!--            <i class="mdi-action-search active"></i>-->
<!--            <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Materialize">-->
<!--        </div>-->
        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <h5 class="breadcrumbs-title">Blank Page</h5>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs end-->
    <!--start container-->
    <div class="container">
        <div class="section">



