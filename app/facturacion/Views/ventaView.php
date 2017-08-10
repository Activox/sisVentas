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
<?php  $style = "style='text-align: center;'"; ?>
<div class="row container">
    <table class="bordered">
        <thead class="text-primary-color accent-color">
        <tr>
            <th <?php echo $style ?> >No. Factura</th>
            <th <?php echo $style ?> >Cliente</th>
            <th <?php echo $style ?> >Qty</th>
            <th <?php echo $style ?> >Importe</th>
            <th <?php echo $style ?> >Fecha Factura</th>
        </tr>
        </thead>
        <tbody id="table">

        </tbody>
    </table>
</div>
<!--/ table-->
