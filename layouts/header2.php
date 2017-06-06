<?php

use lib\Config;

$session = \Factory::getSession();
if (!isset($session->username)) {
    header('Location: login');
}
$baseroot = _HOST_ . _DIRECTORY_ . _DS_;
$url = "{$_SERVER['REQUEST_URI']}";
?>
<!DOCTYPE html>
<html lang="en">

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
    Route::getCss(array("alertify","custom"), "", array(), TRUE);
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
    //    Route::getLib(array("chartist.min"),"lib","js","",array("vendor","plugins","chartist-js"), TRUE);
    Route::getLib(array("prism"), "lib", "js", "", array("vendor", "plugins", "prism"), TRUE);
    Route::getLib(array("jquery.dataTables.min"), "lib", "js", "", array("vendor", "plugins", "data-tables", "js"), TRUE);

    //    JS
    Route::getJs(array("materialize.min", "plugins", "custom-script", "script"), "", array("js"), TRUE);
    Route::getJs(array("alertify", "jquery.number"), "", array(), TRUE);

    $escaped_url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
    list($url2, $framework, $actual_url) = explode("/", $escaped_url);
    list($module, $type, $app) = explode("-", $actual_url);

    ?>
</head>


<body>

<!-- Start Page Loading -->
<div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<!-- End Page Loading -->

<!-- //////////////////////////////////////////////////////////////////////////// -->

<!-- START HEADER -->
<header id="header" class="page-topbar">
    <!-- start header nav-->
    <div class="navbar-fixed">
        <nav class="navbar-color">
            <div class="nav-wrapper">
                <ul class="left">
                    <li><h1 class="logo-wrapper"><a href="index.html" class="brand-logo darken-1"><img
                                        src="images/materialize-logo.png" alt="materialize logo"></a> <span
                                    class="logo-text">Materialize</span></h1></li>
                </ul>
                <ul class="right hide-on-med-and-down">
                    <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light translation-button"
                           data-activates="translation-dropdown"><img src="images/flag-icons/United-States.png"
                                                                      alt="USA"/></a></li>

                </ul>
                <!-- translation-button -->
                <ul id="translation-dropdown" class="dropdown-content">
                    <li><a href="#!"><img src="images/flag-icons/United-States.png" alt="English"/> <span
                                    class="language-select">English</span></a></li>
                    <li><a href="#!"><img src="images/flag-icons/France.png" alt="French"/> <span
                                    class="language-select">French</span></a></li>
                    <li><a href="#!"><img src="images/flag-icons/China.png" alt="Chinese"/> <span
                                    class="language-select">Chinese</span></a></li>
                    <li><a href="#!"><img src="images/flag-icons/Germany.png" alt="German"/> <span
                                    class="language-select">German</span></a></li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- end header nav-->
</header>
<!-- END HEADER -->

<!-- //////////////////////////////////////////////////////////////////////////// -->

<!-- START MAIN -->
<div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">
        <!-- START LEFT SIDEBAR NAV-->
        <aside id="left-sidebar-nav">
            <ul id="slide-out" class="side-nav fixed leftside-navigation">
                <li class="user-details cyan darken-2">
                    <div class="row">
                        <div class="col col s4 m4 l4">
                            <img src="images/images.jpg" alt="" class="circle responsive-img valign profile-image">
                        </div>
                        <div class="col col s8 m8 l8">
                            <ul id="profile-dropdown" class="dropdown-content">
                                <li class="divider"></li>
                                <li><a href="#"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                                </li>
                            </ul>
                            <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#"
                               data-activates="profile-dropdown">
                                <?php
                                echo "<b style='font-size: 11px;'>".$session->username."</b>";
                                ?>
                                <i class="mdi-navigation-arrow-drop-down right"></i></a>
                            <p class="user-roal">Administrator</p>
                        </div>
                    </div>
                </li>
                <li class="bold"><a href="index.html" class="waves-effect waves-cyan"><i
                                class="mdi-action-dashboard"></i> Dashboard</a></li>
            </ul>
            <a href="#" data-activates="slide-out"
               class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i
                        class="mdi-navigation-menu"></i></a>
        </aside>
        <!-- END LEFT SIDEBAR NAV-->

        <!-- //////////////////////////////////////////////////////////////////////////// -->

        <!-- START CONTENT -->
        <section id="content">
            <!--breadcrumbs start-->
            <div id="breadcrumbs-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col s6 m6 l6">
                            <h5 class="breadcrumbs-title"><?php echo ucfirst($app); ?></h5>
                        </div>
                        <div class="col s6 m6 l6 right-align">
                            <ol class="breadcrumbs">
                                <li><a href="index.html">Dashboard</a></li>
                                <li><a href="<?php echo $module ?>"><?php echo ucfirst($module); ?></a></li>
                                <li><a href="<?php echo $module ?>"><?php echo ucfirst($type); ?></a></li>
                                <li class="active"><?php echo ucfirst($app); ?></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!--breadcrumbs end-->
            <!--start container-->
            <div class="container">
                <div class="section">




