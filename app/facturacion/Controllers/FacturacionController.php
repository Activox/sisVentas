<?php

namespace Facturacion\Controllers;

use abstracts\Controller;
use lib\vendor\TableGenerator;

class FacturacionController extends Controller
{
    private $table = null;

    /**
     * execute parent contruct..
     */
    public function __construct()
    {
        parent::__construct($this);
        $this->table = new TableGenerator();
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
     *
     */
    public function getDescuento()
    {
        echo '{"data": ' . json_encode($this->getModel('it/Descuento')->getDescuentoByTipo()) . ' }';
    }

    /**
     *
     */
    public function getClienteName()
    {
        echo '{"data": ' . json_encode($this->getModel('it/Cliente')->getClienteName()) . ' }';
    }

    /**
     *
     */
    public function scanArticulo()
    {
        $articuloModel = $this->getModel('it/Articulo');
        $params = new \stdClass();
        $data = new \stdClass();
        $data2 = \Factory::getInput('data');
        $data->barcode = $data2['barcode'];
        $data->qty = $data2['qty'];
        $data->descuento = $data2['descuento'] == "" ? 0 : $data2['descuento'];
        $info = $articuloModel->getInfoByBarcode($data);
        if (count($info) > 0) {
            if ($info[0]->descuento > 0 || $info[0]->ganancia > 0) {
                if ($info[0]->qty_inv >= ($info[0]->qty + 1)) {
                    $data->id_record = $info[0]->id_record;
                    $result = $this->getModel()->setDetalleTmp($data);
                    $html = "";
                    $count = 1;
                    $precio = 0;
                    $descuento = 0;
                    foreach ($result as $key) {
                        $precio += $key->precio * $key->qty;
                        $descuento += $key->descuento * $key->qty;
                        $html .= "
                        <tr>
                            <td>" . $count++ . "</td>
                            <td>$key->description</td>
                            <td>$key->qty</td>
                            <td>DOP$ " . number_format(($key->precio * $key->qty), 2) . "</td>
                        ";
                        $html .= "</tr>";
                    }
                    $params->code = 200;
                    $params->msg = "complete";
                    $params->data = $html;
                    $params->stotal = $precio;
                    $params->desc = $descuento;
                } else {
                    $params->code = 404;
                    $params->msg = 'Existencia insuficiente de este articulo!';
                    $params->data = [];
                }
            } else {
                $params->code = 404;
                $params->msg = 'Este Articulo no posee Configuracion. Favor contactar a un administrador.';
                $params->data = [];
            }
        } else {
            $params->code = 404;
            $params->msg = 'No hay existencia de este articulo!';
            $params->data = [];
        }
        echo json_encode($params);
    }

    /**
     * @return mixed
     */
    public function setFactura()
    {

        $data = new \stdClass();
        $input = \Factory::getInput('data');
        $data->cliente = $input['cliente'] == "" ? 16 : $input['cliente'];
        $data->descuento = $input['descuento'] == "" ? 0 : $input['descuento'];
        $data->tipo = $input['tipo'];
        $data->total = $input['total'];
        return $this->getModel()->setFactura($data);
    }

    public function getVenta()
    {
        $getcolse = 'description';// value for collapse
        $getdata = ['qty', 'compra', 'venta', 'ganancia'];//content of the table
        $sumvalue = 'ganancia';
        $result = $this->getModel()->getVenta();
        /**
         * status. if you want to create total
         */
        $this->table->collapseTable($result, $getcolse, $getdata, $sumvalue, true);//call method
    }

    public function printFactura($id)
    {
        return $this->getModel()->printFactura($id);
    }
}
