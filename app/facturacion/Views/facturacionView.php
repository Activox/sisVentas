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
        <h4><i class="small material-icons teal-text">credit_card</i>&nbsp;Facturacion</h4>

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

<div class="row container">
    <div class="input-field col s3">
        <select id="cliente">
            <option value="" disabled selected> Choose your option</option>
        </select>
        <label>Clientes</label>
    </div>
    <div class="input-field col s3">
        <select id="descuento">
            <option value="" disabled selected> Choose your option</option>
        </select>
        <label>Descuentos</label>
    </div>
    <div class="col s3 center-align">
        <br>
        <div class="switch">
            <label>
                Debito
                <input type="checkbox" id="pay_type">
                <span class="lever"></span>
                Credito
            </label>
        </div>
    </div>
    <div class="right-align">
        <br>
        <a class="waves-effect waves-light btn" id="btnfacturar"><i class="material-icons left">credit_card</i>Facturar</a>
    </div>
</div>
<div class="row container">
    <div class="input-field col s6">
        <input placeholder="Codigo de Barra" id="barcode" type="text" class="validate" style="font-size: 50px">
    </div>

    <div class="input-field col s3">
        <input placeholder="Cantidad" id="qty" type="number" class="validate" style="font-size: 50px">
    </div>
    <div class="input-field col s3">
        <a class="waves-effect waves-light btn" id="btnadd"><i class="material-icons left">add</i>ADD</a>
    </div>
</div>
<!--table-->
<div class="row container scroll ">
    <table class="bordered striped highlight centered responsive-table table-xtra-condensed">
        <thead class="accent-color white-text">
        <tr>
            <th>#</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
        </tr>
        </thead>
        <tbody id="details">

        </tbody>
    </table>
</div>
<div class="row container">
    <div class="s10 right-align">
        <p><b>Sub Total:</b>DOP$ <span id="stotal"></span></p>
        <p><b>Descuento:</b>DOP$ <span id="desc"></span></p>
        <p><b>Total Pagar:</b>DOP$ <span id="total"></span></p>
    </div>
</div>
<!--/ table-->
<!-- Modal Structure Save-->
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Devuelta</h4>
        <div class="row">
            <form class="col s12" id="records">
                <div class="row">
                    <div class="input-field col s12" >
                        <input id="dinero" type="number" class="validate" style="font-size: 30px">
                        <label for="dinero">Dinero</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12" id="devuelta" style="font-size: 30px">

                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal-footer right-align">
        <a class="waves-effect waves-light waves-green btn-flat" id="print">PRINT</a>
    </div>
</div>
<!--/ Modal Structure-->
