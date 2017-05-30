<?php

namespace compras\Controllers;

use abstracts\Controller;

class CompraController extends Controller
{

    /**
     * execute parent contruct..
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
     * This function get the almacen list.
     */
    public function getAlmacen()
    {
        $record = $this->getModel("it/Almacen");
        echo '{"data": ' . json_encode($record->getAlmacen()) . ' }';
    }

    /**
     *
     */
    public function getArticulo()
    {
        $record = $this->getModel("it/Articulo");
        $id = \Factory::getInput('id');
        echo '{"data": ' . json_encode($record->getArticuloBySuplidor($id)) . ' }';
    }

    /**
     * this function build the table with the articulos the user has add for this request
     */
    public function getDetalleSolicitudTmp()
    {
        $record = $this->getModel("compras/detallesolicitudtmp");
        $html = "";
        $count = 1;
        foreach ($record->getDetallesolicitudtmpTable() as $key) {
            $html .= "
            <tr>
                <td>" . $count++ . "</td>
                <td>$key->articulo</td>
                <td>$key->qty $key->unidad</td>
                <td><i class=\"material-icons red-text cancel\" style=\"cursor: pointer;\" data-id='$key->id_record'>clear</i></td>
            </tr>";
        }
        return $html;
    }

    /**
     * This function set the request.
     */
    public function setSolicitud()
    {
        $solicitud = $this->getModel('compras/Solicitud');
        $return = null;
        $data = \Factory::getInput('data');
        $option = \Factory::getInput('option');
        $params = new \stdClass();
        $params->id_articulo = $data['articulo'];
        $params->qty = $data['qty'];
        $params->id_unidad = $data['unidad'];
        if ($option == 'tmp') {
            $return = $solicitud->setDetalletmp($params);
        } else {
            $params->id_almacen = $data['almacen'];
            $params->id_suplidor = $data['suplidor'];
            $return = $solicitud->setSolicitud($params);
        }
        return $return;
    }

    /**
     *
     */
    public function setCancel()
    {
        $detalleTmp = $this->getModel('compras/detallesolicitudtmp');
        $id = \Factory::getInput('data');
        $result = TRUE;
        if ($id > 0) {
            $result = $detalleTmp->deletePropById($id);
        } else {
            $result = $detalleTmp->deleteProp();
        }
        return $result;
    }

    /**
     *
     */
    public function getSolicitud()
    {
        $params = new \stdClass();
        $params->almacen = \Factory::getInput('data');
        $solicitudModel = $this->getModel('compras/Solicitud');
        $records = $solicitudModel->getSolicitud($params->almacen);
        $tbody = "";
        $tfoot = "";
        $count = 1;
        $tqty = 0;
        $tsub_total = 0;
        foreach ($records as $key) {
            switch ($key->status) {
                case "pendiente":
                    $color = "black-text";
                    $icon = "<i data-target=\"modal1\" class=\"material-icons blue-text\" style='cursor: pointer' id='send' data-id='$key->id_record'>send</i>";
                    $icon .= "&nbsp;&nbsp;<i class=\"material-icons red-text\" style='cursor: pointer' id='cancel' data-id='$key->id_record'>clear</i>";
                    break;
                case "enviado":
                    $color = "blue-text";
                    $icon = "<i data-target=\"modal2\" class=\"material-icons teal-text\" style='cursor: pointer' id='check' data-id='$key->id_record' data-id_compra='$key->id_compra'>check</i>";
                    $icon .= "&nbsp;&nbsp;<i class=\"material-icons red-text\" style='cursor: pointer' id='cancel' data-id='$key->id_record' data-id_compra='$key->id_compra'>clear</i>";
                    break;
                case "completado":
                    $color = "teal-text";
                    break;
            }
            $tbody .= "<tr>
                        <td>" . $count++ . "</td>
                        <td>$key->suplidor</td>
                        <td>$key->no_solicitud</td>
                        <td>$key->qty</td>
                        <td>DOP$ " . number_format("$key->sub_total", 0, '.', ',') . "</td>
                        <td class='$color'>" . strtoupper("$key->status") . "</td>
                        <td>$icon</td>
                    </tr>";
            $tqty += $key->qty;
            $tsub_total += $key->sub_total;
        }
        $tfoot .= " <tr class=\"blue-grey lighten-2 white-text\">
                    <td></td>
                    <td></td>
                    <td ><b>Totales</b></td>
                    <td><b>$tqty</b></td>
                    <td><b>DOP$ " . number_format("$tsub_total", 0, '.', ',') . " </b ></td >
                    <td ></td >
                    <td ></td >
                </tr > ";
        $html = $tbody . "" . $tfoot;
        echo $html;
    }

    /**
     *
     */
    public function updateSolicitud()
    {
        $result = TRUE;
        $solicitud = $this->getModel('compras/Solicitud');
        $params = new \stdClass();
        $data = \Factory::getInput('data');
        $params->id = $data['id'];
        $params->id_compra = $data['id_compra'];
        $params->option = $data['option'];

        if ($params->option == 2) {
            $records = $solicitud->updateSolicitud($params);
            if ($records) {
                $record = $this->getModel()->setCompra($params);
                if (!$record) {
                    $result = FALSE;
                }
            } else {
                $result = FALSE;
            }
        } else {
            $params->date = date("Y-m-d", strtotime($data['date']));
            $params->tipo = $data['tipo'];
            $params->factura = $data['factura'];
            $records = $solicitud->updateSolicitud($params);
            if ($records) {
                $record = $this->getModel()->setCompra($params);
                if (!$record) {
                    $result = FALSE;
                }
            } else {
                $result = FALSE;
            }
        }
        return $result;
    }

    public function getDetalleOrder($id)
    {
        return $this->getModel()->getDetalleOrder($id);
    }
}
