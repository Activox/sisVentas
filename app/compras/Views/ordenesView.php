<?php
Route::getJs(array("ordenesScript"), "compras", array(), FALSE);
$url = "{$_SERVER['REQUEST_URI']}";

$escaped_url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
list($url2, $framework, $actual_url) = explode("/", $escaped_url);
list($module, $type, $app) = explode("-", $actual_url);
?>
<style>
    .modal {
        width: 45% !important;
        max-height: 45% !important;
    }
</style>
<!--Header-->
<div class="row">
    <div class="col s4 m4 l4">
        <h4><i class="small material-icons teal-text">book</i>&nbsp;Ordenes de compra</h4>
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
    <a class="waves-effect waves-light btn blue" id="search"><i class="material-icons left">search</i>Search</a>
</div>
<!--table-->
<div class="row container">

    <table class="bordered striped highlight centered responsive-table ">
        <thead>
        <tr class="accent-color white-text">
            <th>#</th>
            <th> Proveedor</th>
            <th>No. Solicitud</th>
            <th>Cantidad</th>
            <th>Sub-Total</th>
            <th>Estado</th>
            <th>Option</th>
        </tr>
        </thead>
        <tbody id="details">

        </tbody>

    </table>

</div>
<!--/ table-->

<!-- Modal Structure-->
<div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4>Enviar Orden Compra</h4>
        <div class="row">
            <form class="col s12" id="records">
                <div class="input-field col s6">
                    <select id="tipo">
                        <option value="" disabled selected> Choose your option</option>
                    </select>
                    <label>Tipo de Pago</label>
                </div>
                <div class="input-field col s6">
                    <input id="date" type="date" class="datepicker">
                    <label for="date">Fecha de Requisicion</label>
                </div>
            </form>
        </div>
    </div>
    <div class="modal-footer right-align">
        <a class="waves-effect waves-light waves-green btn-flat" id="send">Send</a>
        <a class="waves-effect waves-light waves-red btn-flat modal-action modal-close" id="cancel">Cancel</a>
    </div>
</div>
<!--/ Modal Structure-->

<!-- Modal Structure update-->
<div id="modal2" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4>Completar Orden de Compra</h4>
        <div class="row">
            <form class="col s12" id="records">
                <div class="input-field col s6">
                    <input id="factura" type="text" class="validate">
                    <label for="factura">No Factura</label>
                </div>
            </form>
        </div>
    </div>
    <div class="modal-footer right-align">
        <a class="waves-effect waves-light waves-green btn-flat" id="completed">Completed</a>
        <a class="waves-effect waves-light waves-red btn-flat modal-action modal-close" id="cancel">Cancel</a>
    </div>
</div>
<!--/ Modal Structure-->