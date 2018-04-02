<?php
Route::getJs(array("entradaScript"), "almacen", array(), FALSE);
$url = "{$_SERVER['REQUEST_URI']}";

$escaped_url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
list($url2, $framework, $actual_url) = explode("/", $escaped_url);
list($module, $type, $app) = explode("-", $actual_url);
?>
<!--Header-->
<div class="row">
    <div class="col s4 m4 l4">
        <h4><i class="small material-icons teal-text">view_list</i>&nbsp;Reporte<span><h6 class="grey-text">Inventario & Movimientos</h6></span></h4>
    </div>
    <div class="col s8 m8 l8">
        <div class="right-align">
            You Are In:
            <a href="menu">Dashboard</a> /
            <a href="<?php echo $module ?>"><?php echo ucfirst($module); ?></a> /
            <a href="<?php echo $module ?>"><?php echo ucfirst($type); ?></a> /
            <a href="#!" class="teal-text text-darken-1"><?php echo $app; ?></a>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<hr>

<div class="row container">
    <div class="input-field col s3">
        <select id="almacen">
            <option value="" disabled selected> Choose your option</option>
        </select>
        <label>Almacen</label>
    </div>

    <br>
    <a class="waves-effect waves-light btn blue" id="search2"><i class="material-icons left">search</i>Search</a>

</div>
<!--table-->
<div class="row container">

    <table class="bordered highlight centered responsive-table ">
        <thead>
        <tr class="accent-color white-text">
            <th colspan="3" > Articulo</th>
            <th>Qty</th>
        </tr>
        </thead>
        <tbody id="details2">

        </tbody>

    </table>

</div>
<!--/ table-->
