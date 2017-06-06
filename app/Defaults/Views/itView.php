<!--Header-->
<div class="row">
    <div class="col s9 m9 l9">
        <h4 class="header"><span><i class="material-icons teal-text" style="font-size: 40px">desktop_windows</i></span> IT</h4>

    </div>
    <div class="col s3 m3 l3 right-align ">
        <span class="right-align z-depth-2 return_button" onclick="window.location.href = 'menu'">
             <i class="tiny  material-icons">keyboard_return</i> Return
        </span>
    </div>

    <!-- /.col-lg-12 -->
</div>
<hr>

<!--collections-->
<div class="row">

    <!--General-->
    <div class="col s12 m12 l4 center-align">
        <ul class="collection with-header z-depth-3">
                <li href="#!" class="collection-header blue-grey lighten-1 white-text"><h4>General</h4></li>
                <a href="it-general-tipos" class="collection-item">Tipos</a>
                <a href="it-general-usuarios" class="collection-item">Usuarios</a>
                <a href="it-general-empresas" class="collection-item">Empresas</a>
                <a href="it-general-almacenes" class="collection-item">Almacenes</a>
                <a href="it-general-terminales" class="collection-item">Terminales</a>
                <a href="it-general-impuestos" class="collection-item">Impuestos</a>
        </ul>
    </div> 
    <!--/ General-->

    <!--Productos-->
    <div class="col s12 m12 l4 center-align">
        <ul class="collection with-header z-depth-3">

                <li href="#!" class="collection-header blue-grey lighten-1 white-text"><h4>Productos</h4></li>
                <a href="it-productos-categorias" class="collection-item">Categorias</a>
                <a href="it-productos-subcategorias" class="collection-item">Sub Categorias</a>
                <a href="it-productos-articulos" class="collection-item">Articulos</a>
                <a href="it-productos-unidades" class="collection-item">Unidades</a>
                <a href="it-productos-asignarPrecios" class="collection-item">Asignar Precio a Productos por Suplidor</a>
                <a href="it-productos-margenGanancia" class="collection-item">Porcentaje Ganancias</a>
                <a href="it-productos-descuento" class="collection-item">Asignar Descuentos</a>

        </ul>
    </div>
    <!--/ Productos-->

    <!--Personas-->
    <div class="col s12 m12 l4 center-align">
        <ul class="collection with-header z-depth-3">

                <li href="#!" class="collection-header blue-grey lighten-1 white-text"><h4>Personas</h4></li>
                <a href="it-personas-clientes" class="collection-item">Clientes</a>
                <a href="it-personas-empleados" class="collection-item">Empleados</a>
                <a href="it-personas-suplidores" class="collection-item">Suplidores</a>

        </ul>
    </div>
    <!--/ Personas-->   

</div>
<!--/ Collections-->

<!--collections-->
<div class="row">
    <!--Direcciones-->
    <div class="col s12 m12 l4 center-align">
        <ul class="collection with-header z-depth-3">

                <li href="#!" class="collection-header blue-grey lighten-1 white-text"><h4>Direcciones</h4></li>
                <a href="it-direcciones-paises" class="collection-item">Paises</a>
                <a href="it-direcciones-ciudades" class="collection-item">Ciudades</a>
                <a href="it-direcciones-sectores" class="collection-item">Sectores</a>

        </ul>
    </div>
    <!--/ Direcciones-->
</div>
<div class="fixed-action-btn horizontal">
    <a class="btn-floating btn-large accent-color">
        <i class="large material-icons">grade</i>
    </a>
    <ul>
        <li><a class="btn-floating blue tooltipped" data-position="top" data-delay="50" data-tooltip="Facturar" onclick="window.location.href = 'finanzas-aplicaciones-facturacion'" ><i class="material-icons">shopping_cart</i></a></li>
        <li><a class="btn-floating orange darken-1 tooltipped" data-position="top" data-delay="50" data-tooltip="Ventas" onclick="window.location.href = 'finanzas-reportes-ventas'"><i class="material-icons" >receipt</i></a></li>
        <li><a class="btn-floating green tooltipped" data-position="top" data-delay="50" data-tooltip="Productos" onclick="window.location.href = 'almacen-reportes-existencia'" ><i class="material-icons">loyalty</i></a></li>
    </ul>
</div>