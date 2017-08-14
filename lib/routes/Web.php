<?php

namespace lib\routes;

class Web
{

    /**
     * if you want show any view, you must call 'display' method and send one parameter with the name view (Verify the key sensitive)
     * @var array All routes interfaces
     */
    public static $_rules = array(
//      -----------------------------------------------------------
//      Menu's
//      -----------------------------------------------------------
        "menu" => "Defaults@Default.display*menu",
        "login" => "Defaults@Default.display*login",
        "logout" => "Defaults@Default.display*logout",
        "it" => "Defaults@Default.display*it",
        "compras" => "Defaults@Default.display*compras",
        "finanzas" => "Defaults@Default.display*finanzas",
        "facturacion" => "Defaults@Default.display*facturacion",
        "almacen" => "Defaults@Default.display*almacen",
        "test-test-test" => "Defaults@Default.display*test",
//      -----------------------------------------------------------
//      It
//      -----------------------------------------------------------// General
        "it-general-tipos" => "it@Tipo.display*tipo",
        "it-general-usuarios" => "it@Usuario.display*usuario",
        "it-general-empresas" => "it@Empresa.display*empresa",
        "it-general-terminales" => "it@Terminal.display*terminal",
        "it-general-almacenes" => "it@Almacen.display*almacen",
        "it-general-impuestos" => "it@Itbs.display*itbs",
        "it-mantenimientos-apps"                  => "it@App.display*app",
//      ----------------------------------------------------------- // Productos
        "it-productos-categorias" => "it@Categoria.display*categoria",
        "it-productos-unidades" => "it@Unidad.display*unidad",
        "it-productos-subcategorias" => "it@Subcategoria.display*subcategoria",
        "it-productos-articulos" => "it@Articulo.display*articulo",
        "it-productos-asignarPrecios" => "it@Precio.display*precio",
        "it-productos-margenGanancia" => "it@Precio.display*porcentaje",
        "it-productos-descuento" => "it@Precio.display*descuento",
//      ----------------------------------------------------------- // Direcciones
        "it-direcciones-paises" => "it@Pais.display*pais",
        "it-direcciones-ciudades" => "it@Ciudad.display*ciudad",
        "it-direcciones-sectores" => "it@Sector.display*sector",
//      ----------------------------------------------------------- // Personas
        "it-personas-empleados" => "it@Empleado.display*empleado",
        "it-personas-clientes" => "it@Cliente.display*cliente",
        "it-personas-suplidores" => "it@Suplidor.display*suplidor",
//      ----------------------------------------------------------- 
//        Compra
//      -----------------------------------------------------------
        "compras-aplicaciones-solicitudes" => "compras@Compra.display*solicitudes",
        "compras-aplicaciones-ReportesOrdenes" => "compras@Compra.display*ordenreport",
        "compras-aplicaciones-ReportesSolicitudes" => "compras@Compra.display*solicitudreport",
        "compras-aplicaciones-ordenes" => "compras@Compra.display*ordenes",
        "compra/[view]/[id_solicitud]" => "compras@Compra.display*invoice",

//      -----------------------------------------------------------
//        Almacen
//      -----------------------------------------------------------
        "almacen-aplicaciones-inventario" => "almacen@Almacen.display*entrada",
        "almacen-reportes-existencia" => "almacen@Almacen.display*inventario",
//      -----------------------------------------------------------
//        Finanzas
//      -----------------------------------------------------------
        "finanzas-aplicaciones-facturacion" => "facturacion@Facturacion.display*facturacion",
        "finanzas-reportes-ventas" => "facturacion@Facturacion.display*venta",
        "finanzas-reportes-CxC" => "facturacion@Facturacion.display*cxc",
        "finanzas-reportes-CxP" => "facturacion@Facturacion.display*cxp",
        "facturacion/[view]/[id_factura]" => "facturacion@Facturacion.display*invoice",
        "finanzas-aplicaciones-pagoFacturas" => "facturacion@Facturacion.display*pagoCxp"
//      -----------------------------------------------------------

    );

}
