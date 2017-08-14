<?php
/**
 * Created by PhpStorm.
 * User: paul9
 * Date: 8/13/2017
 * Time: 10:37 PM
 */
Route::getJs(array("pagocxpscript"), "facturacion", array(), FALSE);
$url = "{$_SERVER['REQUEST_URI']}";
$escaped_url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
list($url2, $framework, $actual_url) = explode("/", $escaped_url);
list($module, $type, $app) = explode("-", $actual_url);
?>
<!--Header-->
<div class="row">
    <div class="col s4 m4 l4">
        <h4><i class="small material-icons teal-text">credit_card</i>&nbsp;Pagos de Facturas</h4>

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
        <from id="frmReport">
            <div class="input-field col s3">
                <select id="suplidor" name="suplidor">
                    <option value="" disabled selected>Choose your option</option>
                </select>
                <label>Suplidor</label>
            </div>
        </from>
        <br>
        <div class="col s2">
            <a class="waves-effect waves-light btn" id="btnSearch"><i class="fa fa-search" aria-hidden="true"></i>
                SEARCH</a>
        </div>
    </div>
</div>
<?php $style = "style='text-align: center;'"; ?>
<div class="row container">
    <table class="bordered">
        <thead class="text-primary-color accent-color">
        <tr>
            <th <?= $style ?> >No. Factura</th>
            <th <?= $style ?> >Qty</th>
            <th <?= $style ?> >Monto</th>
            <th <?= $style ?> >Fecha Factura</th>
        </tr>
        </thead>
        <tbody id="table">

        </tbody>
    </table>
</div>
<!--/ table-->
<div class="row">
    <div class="col s12">
        <div class="col s2 paybtn" style="margin-left: 77%;">

        </div>
    </div>
</div>