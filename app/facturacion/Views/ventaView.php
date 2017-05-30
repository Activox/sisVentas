<?php
Route::getJs(array("ventascript"), "facturacion", array(), FALSE);
$url = "{$_SERVER['REQUEST_URI']}";
$escaped_url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
list($url2, $framework, $actual_url) = explode("/", $escaped_url);
list($module, $type, $app) = explode("-", $actual_url);
?>
<!--Header-->
<div class="row">
    <div class="col s4 m4 l4">
        <h4><i class="small material-icons teal-text">credit_card</i>&nbsp;Reporte de Ventas</h4>

    </div>
    <div class="col s8 m8 l8">
        <div class="right-align">
            You Are In:
            <a href="menu">Dashboard</a> /
            <a href="<?php echo $module ?>"><?php echo ucfirst($module); ?></a> /
            <a href="<?php echo $module ?>"><?php echo ucfirst($type); ?></a> /
            <a href="#!" class="teal-text text-darken-1"><?php echo ucfirst($app); ?></a>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<hr>

<!--<div class="row container">-->
<!--    <div class="input-field col s3">-->
<!--        <select id="cliente">-->
<!--            <option value="" disabled selected> Choose your option</option>-->
<!--        </select>-->
<!--        <label>Clientes</label>-->
<!--    </div>-->
<!--    <div class="input-field col s3">-->
<!--        <select id="descuento">-->
<!--            <option value="" disabled selected> Choose your option</option>-->
<!--        </select>-->
<!--        <label>Descuentos</label>-->
<!--    </div>-->
<!--    <div class="col s3 center-align">-->
<!--        <br>-->
<!--        <div class="switch">-->
<!--            <label>-->
<!--                Debito-->
<!--                <input type="checkbox" id="pay_type">-->
<!--                <span class="lever"></span>-->
<!--                Credito-->
<!--            </label>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="right-align">-->
<!--        <br>-->
<!--        <a class="waves-effect waves-light btn" id="btnfacturar"><i class="material-icons left">credit_card</i>Facturar</a>-->
<!--    </div>-->
<!--</div>-->
<!--table-->
<div class="row container">
    <table>
        <thead class="text-primary-color accent-color">
        <tr>
            <th>#</th>
            <th>Qty</th>
            <th>Precio Compra</th>
            <th>Precio Venta</th>
            <th>Ganancia</th>
        </tr>
        </thead>

        <tbody id="table">

        </tbody>
    </table>

</div>
<!--/ table-->
