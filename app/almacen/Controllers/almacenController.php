<?php

namespace Almacen\Controllers;

use abstracts\Controller;

class AlmacenController extends Controller
{

    /**
     * execute parent contruct.
     */
    public function __construct()
    {
        parent::__construct($this);
    }

    /**
     *
     * @param string $view
     * @return string
     */
    public function display($view = '', array $params = array())
    {

        /**
         * set params to view
         */
        \Factory::setParametersView($params);

        /**
         * write all content HTML
         */
        $define_view_here = '';

        /**
         * render view
         */
        $render = $view;

        if (empty($define_view_here)) {
            $render .= ".php";
        } else {
            $render = $define_view_here;
        }

        return $render;
    }

    /**
     * get Model from references
     * @param string $model
     * @param stdClass $properties
     * @return object model
     */
    public function getModel($model = '', $properties = null)
    {
        return parent::getModel($model, $properties);
    }

    /**
     * This function to generate html table
     */
    public function getCompra()
    {
        $params = new \stdClass();
        $params->id_almacen = \Factory::getInput('data');
        $params->id_compra = 0;
        $compraModel = $this->getModel('compras/Compra');
        $records = $compraModel->getCompra($params);
        $tbody = "";
        $tfoot = "";
        $count = 1;
        $tqty = 0;
        $tsub_total = 0;
        if (count($records) > 0) {
            foreach ($records as $key) {
                $icon = "<i data-target=\"modal2\" class=\"material-icons teal-text\" style='cursor: pointer' id='insert' data-id='$key->id_compra' >present_to_all</i>";
                $icon .= "&nbsp;&nbsp;<i class=\"material-icons red-text\" style='cursor: pointer' id='cancel' data-id='$key->id_compra' >clear</i>";
                $tbody .= "<tr>
                        <td>" . $count++ . "</td>
                        <td>$key->suplidor</td>
                        <td>$key->no_factura</td>
                        <td>$key->qty " . strtoupper("$key->unidad") . "</td>
                        <td>$icon</td>
                    </tr>";
                $tqty += $key->qty;
                $tsub_total += $key->sub_total;
            }
        } else {
            $tbody .= "<tr><td colspan='5' >WITHOUT INFORMATION</td></tr>";
        }
        $tfoot .= " <tr class=\"blue-grey lighten-3 primary-text-color\">
                    <td></td>
                    <td></td>
                    <td ><b>Totales</b></td>
                    <td><b>$tqty</b></td>
                    <td ></td >
                </tr > ";
        $html = $tbody . "" . $tfoot;
        echo $html;
    }

    /**
     * This function insert on inventory
     */
    public function setInventario()
    {
        $params = new \stdClass();
        $data = \Factory::getInput('data');
        $params->id_compra = $data['id'];
        $params->id_almacen = $data['id_almacen'];
        $inventarioModel = $this->getModel('almacen/Inventario');
        return $inventarioModel->setInventario($params);
    }

    /**
     *
     */
    public function getInventorio()
    {
        $params = \Factory::getInput('data');
        $html = "";
        $tbody = "";
        $head = "";

        $count = 1;

        $inventarioModel = $this->getModel('almacen/Inventario');
        $records = $inventarioModel->getInventory($params);
//        print_r($records);die;

        foreach ($records as $key) {

            $html .= "
            <tr class='teal lighten-5'>
               
                <td colspan='3'> $key->articulo</td>
                <td> $key->qty</td>
            </tr >
            ";
            $movimientoModel = $this->getModel('almacen/Movimiento');
            if ($count == 1) {
                $html .= "
                <tr class='text-center blue-grey lighten-4'>
                   
                    <td>Qty</td>
                    <td>Tipo</td>
                    <td>Creado en</td>
                    <td>Creado Por</td>
                </tr>
            ";
            }
            $count++;
            $record = $movimientoModel->getMovements($key->id_record);
            $count2 = 1;
            foreach ($record as $key2) {
                $html .= "
            <tr>
               
                <td>$key2->qty</td>
                <td>$key2->tipo</td>
                <td>$key2->created_on</td>
                <td>$key2->created_by</td>
            </tr>
            ";
            }

        }
        echo $html;
    }

}
