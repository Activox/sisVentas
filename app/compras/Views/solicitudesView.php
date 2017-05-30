<?php
Route::getJs(array("solicitudesScript"), "compras", array(), FALSE);
$url = "{$_SERVER['REQUEST_URI']}";

$escaped_url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
list($url2, $framework, $actual_url) = explode("/", $escaped_url);
list($module, $type, $app) = explode("-", $actual_url);
?>
<!--Header-->
<div class="row">
    <div class="col s4 m4 l4">
        <h4><i class="fa fa-edit teal-text"></i>&nbsp;Solicitudes de Productos</h4>
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
</div>
<hr>
<!--/ header-->

<!--inputs-->
<div class="row">

    <div class="input-field col s2">
        <select id="almacen">
            <option value="" disabled selected> Choose your option</option>
        </select>
        <label>Almacen</label>
    </div>
    <div class="input-field col s3">
        <select id="suplidor">
            <option value="" disabled selected> Choose your option</option>
        </select>
        <label>Suplidor</label>
    </div>
    <div class="input-field col s3">
        <select id="articulo">
            <option value="" disabled selected> Choose your option</option>
        </select>
        <label>Producto</label>
    </div>
    <div class="input-field col s2">
        <input id="qty" type="text" class="validate">
        <label for="qty">Cantidad</label>
    </div>
    <div class="input-field col s2">
        <select id="unidad">
            <option value="" disabled selected> Choose your option</option>
        </select>
        <label>Unidad</label>
    </div>
</div>
<!--/ inputs-->

<!--almacen , suplidor y botones-->
<div class="row container">
    <div class="col s6 left-align">
        <h5 id="list">

        </h5>
    </div>
    <div class="col s6 right-align">
        <a class="waves-effect waves-light btn blue" id="add"><i class="material-icons left">add</i>Add</a>
        <a class="waves-effect waves-light btn" id="save"><i class="material-icons left">save</i>Save</a>
        <a class="waves-effect waves-light btn red" id="cancel"><i class="material-icons left">clear</i>Cancel</a>
    </div>
</div>
<!--/ almacen , suplidor y botones-->

<!--table-->
<div class="row container">
    <table class="bordered striped highlight centered responsive-table ">
        <thead>
        <tr class="accent-color white-text">
            <th>#</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Remove</th>
        </tr>
        </thead>
        <tbody id="details">

        </tbody>
    </table>
</div>
<!--/ table-->
