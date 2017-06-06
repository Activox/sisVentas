<!--Header-->
<div class="row">
    <div class="col s9 m9 l9">
        <h4 class="header"><span><i class="  material-icons teal-text" style="font-size: 40px">attach_money</i></span> Finanzas </h4>

    </div>
    <div class="col s3 m3 l3 right-align">
        <span class="right-align z-depth-2 return_button" onclick="window.location.href = 'menu'">
            <i class="tiny material-icons">keyboard_return</i> Return
        </span>
    </div>

    <!-- /.col-lg-12 -->
</div>
<hr>
<!--collections-->
<div class="row">

   

    <!--Aplicaciones-->
    <div class="col s12 m12 l4 center-align">
        <ul class="collection with-header z-depth-3">
             <li href="#!" class="collection-header teal white-text"><h4>Aplicaciones</h4></li>
                <a href="finanzas-aplicaciones-facturacion" class="collection-item">Facturacion</a>

        </ul>
    </div>
    <!--/ Aplicaciones-->
    <!--Reportes-->
    <div class="col s12 m12 l4 center-align">
        <ul class="collection with-header z-depth-3">
             <li href="#!" class="collection-header teal white-text"><h4>Reportes</h4></li>
                <a href="finanzas-reportes-ventas" class="collection-item">Ventas</a>
                <a  href="finanzas-reportes-CxC" class="collection-item">Cuentas por Cobrar</a>
                <a  href="finanzas-reportes-CxP" class="collection-item">Cuentas por Pagar</a>
        </ul>
    </div>
    <!--/ Reportes-->

</div>
<!--/ Collections-->
<div class="fixed-action-btn horizontal">
    <a class="btn-floating btn-large accent-color">
        <i class="large material-icons">grade</i>
    </a>
    <ul>
        <li><a class="btn-floating blue tooltipped" data-position="top" data-delay="50" data-tooltip="Facturar" onclick="window.location.href = 'finanzas-aplicaciones-facturacion'" ><i class="material-icons">shopping_cart</i></a></li>
        <li><a class="btn-floating orange darken-1 tooltipped" data-position="top" data-delay="50" data-tooltip="Ventas"><i class="material-icons">receipt</i></a></li>
        <li><a class="btn-floating green tooltipped" data-position="top" data-delay="50" data-tooltip="Productos" onclick="window.location.href = 'almacen-reportes-existencia'" ><i class="material-icons">loyalty</i></a></li>
    </ul>
</div>