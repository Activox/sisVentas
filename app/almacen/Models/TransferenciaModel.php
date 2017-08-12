<?php

namespace Almacen\Models;

use abstracts\ORM;

//use abstracts\Model;

class TransferenciaModel extends ORM
{

    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null)
    {
        parent::__construct($properties);
        $this->table = "transferencia_mercancia";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "";
        $this->alias = "tm";
        $this->session = \Factory::getSession();
    }

    /**
     * @param \stdClass $parms
     * @return bool
     */
    public function setDetalletmp(\stdClass $parms)
    {
        $result = TRUE;
        $detalleTmp = new TransferenciaDetalleTmpModel();
        $detalleTmp->id_articulo = $this->escape($parms->id_articulo);
        $detalleTmp->qty = $this->escape($parms->qty);
        $detalleTmp->id_unidad = $this->escape($parms->id_unidad);
        $detalleTmp->created_by = $this->escape($this->session->id_record);
        $detalleTmp->created_on = date("Y-m-d");
        $id = $detalleTmp->saveProp();
        if ($id < 1) {
            $this->rollback("", FALSE);
            $result = FALSE;
        } else {
            $this->commit();
        }
        return $result;
    }

    /**
     * save records.
     * @param \stdClass $params
     * @return bool
     */
    public function setTransferencia(\stdClass $params)
    {
        $result = TRUE;
        $model = new TransferenciaModel();
        $id = $model->getCurrentId()[0]->id;
        $this->begin();
        $this->id_almacen_solicitud = $this->escape($params->id_almacen_solicitud);
        $this->id_almacen_suplidor = $this->escape($params->id_almacen_suplidor);
        $this->id_tipo = $this->escape(1);
        $this->no_transferencia = $id . "" . rand(100, 999);
        $this->created_by = $this->escape($this->session->id_record);
        $id_record = parent::save(false);
        if ($id_record < 1) {
            $this->rollback("", FALSE);
            $result = FALSE;
        } else {
            $detalle = new TransferenciaDetalleModel();
            $detalleTmp = new TransferenciaDetalleTmpModel();
            $records = $detalleTmp->getDetallesolicitudtmp();
            foreach ($records as $key) {
                $detalle->id_transferencia = $id_record;
                $detalle->id_articulo = $key->articulo;
                $detalle->id_unidad = $key->id_unidad;
                $detalle->qty = $key->qty;
                $detalle->created_by = $this->escape($this->session->id_record);
                $id_detalle = $detalle->saveProp();
                if ($id_detalle < 1) {
                    $this->rollback("", FALSE);
                    $result = FALSE;
                    break;
                }
            }
            $result = $detalleTmp->deleteProp();
            if ($result) {
                $this->commit();
            }
        }
        return $result;
    }

    /**
     * This function get the current id to insert
     * @return object
     */
    public function getCurrentId()
    {
        $this->param1 = "COALESCE(max(tm.id_record) +1,1) id";
        return $this->get()->objectList();
    }

}
