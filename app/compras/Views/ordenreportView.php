<?php
Route::getJs(array("ordenesScript"), "compras", array(), FALSE);
$url = "{$_SERVER['REQUEST_URI']}";

$escaped_url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
list($url2, $framework, $actual_url) = explode("/", $escaped_url);
list($module, $type, $app) = explode("-", $actual_url);
?>
<!--Header-->
<div class="row">
    <div class="col s5 m5 l5">
        <h4><i class="fa fa-table teal-text"></i>&nbsp;Reporte Ordenes de Compra</h4>

    </div>
    <div class="col s7 m7 l7">
        <div class="right-align">
            You Are In:
            <a href="menu" >Dashboard</a> /
            <a href="<?php echo $module ?>" ><?php echo ucfirst($module); ?></a> /
            <a href="<?php echo $module ?>" ><?php echo ucfirst($type); ?></a> /
            <a href="#!" class="teal-text text-darken-1"><?php echo $app; ?></a>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<hr>

<div class="row container">
    <div class="input-field col s3">
        <select  id="almacen">
            <option value = "" disabled selected> Choose your option </option>
        </select>
        <label>Almacen</label>
    </div><div class="input-field col s3">
        <select  id="almacen">
            <option value = "" disabled selected> Choose your option </option>
        </select>
        <label>Estado</label>
    </div>
    <br>
    <a class="waves-effect waves-light btn blue"><i class="material-icons left">search</i>Search</a>
</div>
<!--table-->
<div class="row container">

    <table class="bordered striped highlight centered responsive-table ">
        <thead >
        <tr class="accent-color white-text">
            <th >#</th>
            <th > Proveedor </th>
            <th >No. Solicitud</th>
            <th >Cantidad</th>
            <th >Sub-Total</th>
            <th >Estado</th>
            <th >Option</th>
        </tr>
        </thead>
        <tbody id="details">
        <tr>
            <td>1</td>
            <td>Joyas Srl</td>
            <td>546587</td>
            <td>80 UND</td>
            <td>DOP$ 5,000.00</td>
            <td>Pendiente</td>
            <td><i class="material-icons blue-text">search</i> &nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Cecomsa</td>
            <td>798546</td>
            <td>100 UND</td>
            <td>DOP$ 105,000.00</td>
            <td class="blue-text">Enviado</td>
            <td><i class="material-icons blue-text">search</i> &nbsp;&nbsp;</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Distribuidora Srl</td>
            <td>123789</td>
            <td>150 UND</td>
            <td>DOP$ 15,000.00</td>
            <td class="teal-text">Completado</td>
            <td><i class="material-icons blue-text">search</i> &nbsp;&nbsp;</td>
        </tr>
        <tr class="blue-grey lighten-2 white-text">
            <td></td>
            <td></td>
            <td ><b>Totales</b></td>
            <td><b>300</b></td>
            <td><b>DOP$ 125,000</b></td>
            <td ></td>
            <td ></td>
        </tr>
        </tbody>

    </table>

</div>
<!--/ table-->
