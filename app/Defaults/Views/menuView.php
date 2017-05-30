<style>
    .card .card-action a:not(.btn):not(.btn-large):not(.btn-large):not(.btn-floating) {
        margin-right: 0 !important;
    }
</style>
<div class="row">
    <div class="col s9 m9 l9">
        <h4>Internal Applications</h4>
    </div>
    <div class="input-field col s3 m3 l3">
        <i class="material-icons prefix teal-text" style="margin-top: 10px;">search</i>
        <input id="icon_prefix" type="text" class="validate">
        <label for="icon_prefix">Search App</label>
    </div>
</div>
<hr>
<div class="row ">
    <div class="col s12 m4 l3">
        <div class="card  blue-grey lighten-5 z-depth-3" onclick="window.location.href = 'it'"
             style="cursor: pointer !important;">
            <div class="card-content teal-text">
                <center><i class="large material-icons">desktop_windows</i></center>
            </div>
            <div class="card-action">
                <center><a href="it">IT</a></center>
            </div>
        </div>
    </div>
    <div class="col s12 m4 l3">
        <div class="card  blue-grey lighten-5 z-depth-3" onclick="window.location.href = 'compras'"
             style="cursor: pointer !important;">
            <div class="card-content teal-text">
                <center><i class="large material-icons">shopping_cart</i></center>
            </div>
            <div class="card-action">
                <center><a href="compras">Compras</a></center>
            </div>
        </div>
    </div>
    <div class="col s12 m4 l3">
        <div class="card  blue-grey lighten-5 z-depth-3" onclick="window.location.href = 'finanzas'"
             style="cursor: pointer !important;">
            <div class="card-content teal-text">
                <center><i class="large material-icons">attach_money</i></center>
            </div>
            <div class="card-action">
                <center><a href="finanzas">Finanzas</a></center>
            </div>
        </div>
    </div>

    <div class="col s12 m4 l3">
        <div class="card  blue-grey lighten-5 z-depth-3" onclick="window.location.href = 'almacen'"
             style="cursor: pointer !important;">
            <div class="card-content teal-text">
                <center><i class="large material-icons">store</i></center>
            </div>
            <div class="card-action">
                <center><a href="almacen">Almacen</a></center>
            </div>
        </div>
    </div>
</div>
<div class="fixed-action-btn horizontal">
    <a class="btn-floating btn-large accent-color">
        <i class="large material-icons">grade</i>
    </a>
    <ul>
        <li><a class="btn-floating blue tooltipped" data-position="top" data-delay="50" data-tooltip="Facturar" onclick="window.location.href = 'finanzas-aplicaciones-facturacion'" ><i class="material-icons">shopping_cart</i></a></li>
        <li><a class="btn-floating orange darken-1 tooltipped" data-position="top" data-delay="50" data-tooltip="Ventas" onclick="window.location.href = 'finanzas-reportes-ventas'"><i class="material-icons">receipt</i></a></li>
        <li><a class="btn-floating green tooltipped" data-position="top" data-delay="50" data-tooltip="Productos" onclick="window.location.href = 'almacen-reportes-existencia'" ><i class="material-icons">loyalty</i></a></li>
    </ul>
</div>