<?php

namespace lib\routes;

class Post
{

    /**
     * Define all routes to server petition
     * @var array All routes interfaces
     */
    public static $_rules = array(
//        default
        "validateUser"                      =>          "Defaults@Default.validatedUser",
        "test"                              =>          "Defaults@Default.test",
//      -----------------------------------------------------------
//      -----------------------------------------------------------
//        It
        "getTipo"                           =>          "it@Tipo.getTipo", // Tipo
        "setTipo"                           =>          "it@Tipo.setTipo",
        "updateTipo"                        =>          "it@Tipo.updateTipo",
//        ---------------------------------------------------------

        "getAppTable"                       =>          "it@App.getAppTable", // App
        "getApp"                            =>          "it@App.getApp",
        "setApp"                            =>          "it@Tipo.setApp",
        "updateApp"                         =>          "it@Tipo.updateApp",
//        ---------------------------------------------------------
        "getCategoria"                      =>          "it@Categoria.getCategoria", // Categoria
        "setCategoria"                      =>          "it@Categoria.setCategoria",
        "updateCategoria"                   =>          "it@Categoria.updateCategoria",
//      -----------------------------------------------------------
        "getUnidad"                         =>          "it@Unidad.getUnidad", // Unidad
        "setUnidad"                         =>          "it@Unidad.setUnidad",
        "updateUnidad"                      =>          "it@Unidad.updateUnidad",
//      -----------------------------------------------------------
        "getPais"                           =>          "it@Pais.getPais", // Pais
        "setPais"                           =>          "it@Pais.setPais",
        "updatePais"                        =>          "it@Pais.updatePais",
//      -----------------------------------------------------------
        "getSubcategoria"                   =>          "it@Subcategoria.getSubcategoria", // Subcategoria
        "setSubcategoria"                   =>          "it@Subcategoria.setSubcategoria",
        "updateSubcategoria"                =>          "it@Subcategoria.updateSubcategoria",
        "getCategoria2"                     =>          "it@Subcategoria.getCategoria",
//      -----------------------------------------------------------
        "getCiudad"                         =>          "it@Ciudad.getCiudad", //Ciudad
        "setCiudad"                         =>          "it@Ciudad.setCiudad",
        "getPais2"                          =>          "it@Ciudad.getPais",
//      -----------------------------------------------------------
        "getSector"                         =>          "it@Sector.getSector", //Sector
        "setSector"                         =>          "it@Sector.setSector",
        "getCiudad2"                        =>          "it@Sector.getCiudad",
//      -----------------------------------------------------------
        "getEmpleado"                       =>          "it@Empleado.getEmpleado", //Empleado
        "getNacionalidad"                   =>          "it@Empleado.getNacionalidad",
        "getCiudadByPais"                   =>          "it@Empleado.getCiudadByPais",
        "getSectorByCiudad"                 =>          "it@Empleado.getSectorByCiudad",
        "getDescriptionByTipo"              =>          "it@Empleado.getDescriptionByTipo",
//      -----------------------------------------------------------
        "getCliente"                        =>          "it@Cliente.getCliente", // Cliente
        "setCliente"                        =>          "it@Cliente.setCliente",
//      -----------------------------------------------------------
        "getSuplidor"                       =>          "it@Suplidor.getSuplidor", // Suplidor
        "setSuplidor"                       =>          "it@Suplidor.setSuplidor",
//      -----------------------------------------------------------
        "getArticulo"                       =>          "it@Articulo.getArticulo", // Articulo
        "setArticulo"                       =>          "it@Articulo.setArticulo",
        "updateArticulo"                    =>          "it@Articulo.updateArticulo",
        "getSubcategoria2"                  =>          "it@Articulo.getSubcategoria",
        "getUnidad2"                        =>          "it@Articulo.getUnidad",
        "getSuplidor2"                      =>          "it@Articulo.getSuplidor2",
//      -----------------------------------------------------------
        "getEmpresa"                        =>          "it@Empresa.getEmpresa", // Empresa
        "setEmpresa"                        =>          "it@Empresa.setEmpresa",
        //      -----------------------------------------------------------
        "getUsuario"                        =>          "it@Usuario.getUsuario", // Usuario
        "setUsuario"                        =>          "it@Usuario.setUsuario",
        "getEmpleado2"                      =>          "it@Usuario.getEmpleado",
        "getTerminal2"                      =>          "it@Usuario.getTerminal2",
        //      -----------------------------------------------------------
        "getTerminal"                       =>          "it@Terminal.getTerminal", // Terminal
        "setTerminal"                       =>          "it@Terminal.setTerminal",
        "updateTerminal"                    =>          "it@Terminal.updateTerminal",
        //      -----------------------------------------------------------
        "getAlmacen"                        =>          "it@Almacen.getAlmacen", // Almacen
        "setAlmacen"                        =>          "it@Almacen.setAlmacen",
        "updateAlmacen"                     =>          "it@Almacen.updateAlmacen",
        //      -----------------------------------------------------------
        "getItbs"                           =>          "it@Itbs.getItbs", // Itbs
        "setItbs"                           =>          "it@Itbs.setItbs",
        "updateItbs"                        =>          "it@Itbs.updateItbs",
        "getImpuestoBySubcategoria"         =>          "it@Itbs.getImpuestoBySubcategoria",
        "getImpuestoByArticulo"             =>          "it@Itbs.getImpuestoByArticulo",
        //      -----------------------------------------------------------
        "getPrecio"                         =>          "it@Precio.getPrecio", // Precio
        "setPrecio"                         =>          "it@Precio.setPrecio",
        "updatePrecio"                      =>          "it@Precio.updatePrecio",
        "getArticulo2"                      =>          "it@Precio.getArticulo2",
        "getImpuesto2"                      =>          "it@Precio.getImpuesto2",
        "setPorcentaje"                     =>          "it@Precio.setPorcentaje",
        "getPorcentajeBySubcategoria"       =>          "it@Precio.getPorcentajeBySubcategoria",
        "getPorcentajeByArticulo"           =>          "it@Precio.getPorcentajeByArticulo",
        //      -----------------------------------------------------------
        "setDescuento"                      =>          "it@Descuento.setDescuento", // Descuento
        "getDescuentoBySubcategoria"        =>          "it@Descuento.getDescuentoBySubcategoria",
        "getDescuentoByArticulo"            =>          "it@Descuento.getDescuentoByArticulo",
        "getDescuentoByTipo"                =>          "it@Descuento.getDescuentoByTipo",
        //      -----------------------------------------------------------
        //        Compra
        //      -----------------------------------------------------------
        "getAlmacen2"                       =>          "compras@Compra.getAlmacen",// Compra
        "getDetalleSolicitudTmp"            =>          "compras@Compra.getDetalleSolicitudTmp",
        "setSolicitud"                      =>          "compras@Compra.setSolicitud",
        "setCancel"                         =>          "compras@Compra.setCancel",
        "getArticulo3"                      =>          "compras@Compra.getArticulo",
        "getSolicitud"                      =>          "compras@Compra.getSolicitud",
        "updateSolicitud"                   =>          "compras@Compra.updateSolicitud",
        //      -----------------------------------------------------------
        //      Almacen
        //      -----------------------------------------------------------
        "getCompra"                         =>          "almacen@Almacen.getCompra", // Almacen
        "setInventario"                     =>          "almacen@Almacen.setInventario",
        "getInventorio"                     =>          "almacen@Almacen.getInventorio",
        //      -----------------------------------------------------------
        //      Facturacion
        //      -----------------------------------------------------------
        "getDescuento"                      =>          "facturacion@Facturacion.getDescuento",
        "getClienteName"                    =>          "facturacion@Facturacion.getClienteName",
        "scanArticulo"                      =>          "facturacion@Facturacion.scanArticulo",
        "setFactura"                        =>          "facturacion@Facturacion.setFactura",
        "getVenta"                          =>          "facturacion@Facturacion.getVenta",
        "getCxp"                            =>          "facturacion@Facturacion.getCxp",
        "setPay"                            =>          "facturacion@Facturacion.setPay"

    );
}
