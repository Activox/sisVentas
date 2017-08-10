<?php
Route::getJs(array("facturacionscript"), "facturacion", array(), FALSE);
$url = "{$_SERVER['REQUEST_URI']}";
$escaped_url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
list($url2, $framework, $actual_url) = explode("/", $escaped_url);
list($module, $type, $app) = explode("-", $actual_url);
?>
<!--Header-->
<div class="row">
    <div class="col s4 m4 l4">
        <h4><i class="small material-icons teal-text">credit_card</i>&nbsp;Cuentas por Pagar</h4>

    </div>
    <div class="col s8 m8 l8">
        <div class="right-align">
            You Are In:
            <a href="menu">Dashboard</a> /
            <a href="<?= $module ?>"><?= ucfirst($module); ?></a> /
            <a href="<?= $module ?>"><?= ucfirst($type); ?></a> /
            <a href="#!" class="teal-text text-darken-1"><?= ucfirst($app); ?></a>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<hr>
<div class="row">
    <div class="col s12 m12">
        <div class="input-field col s3">
            <select id="alamacen">
                <option value="" disabled selected>Choose your option</option>
            </select>
            <label>Almacen</label>
        </div>
        <div class="input-field col s3">
            <select id="suplidor">
                <option value="" disabled selected>Choose your option</option>
            </select>
            <label>Suplidor</label>
        </div>
        <div class="col s2">
            <label>Date From</label>
            <input type="text" class="datepicker" id="dateFrom">
        </div>
        <div class="col s2">
            <label>Date To</label>
            <input type="text" class="datepicker" id="dateTo">
        </div>
        <br>
        <div class="col s2">
            <a class="waves-effect waves-light btn" id="btnSearch"><i class="fa fa-search" aria-hidden="true"></i> SEARCH</a>
        </div>
    </div>
</div>
<?php  $style = "style='text-align: center;'"; ?>
<div class="row container">
    <table class="bordered">
        <thead class="text-primary-color accent-color">
        <tr>
            <th <?= $style ?> >No. Factura</th>
            <th <?= $style ?> >Cliente</th>
            <th <?= $style ?> >Qty</th>
            <th <?= $style ?> >Importe</th>
            <th <?= $style ?> >Fecha Factura</th>
        </tr>
        </thead>
        <tbody id="table">

        </tbody>
    </table>
</div>
<!--/ table-->