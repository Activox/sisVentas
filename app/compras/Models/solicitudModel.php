<?php

namespace compras\Models;

use abstracts\ORM;

class SolicitudModel extends ORM
{

    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null)
    {
        parent::__construct($properties);
        $this->table = "solicitud_compra";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "";
        $this->alias = "sc";
        $this->session = \Factory::getSession();
    }

    /**
     * get records of main table.
     * @return type
     */
    public function getSolicitud($params)
    {
        $query = "SELECT
                      sc.id_record,
                      COALESCE (co.id_record,0) id_compra,
                      sc.id_suplidor,
                      sc.no_solicitud,
                      concat(ter.nombre, '', per.apellidos)                          suplidor,
                      sum(ds.qty)                                                    qty,
                      un.description                                                 unidad,
                      round(sum(ds.qty) * (sum(pa.precio)), 2)    sub_total,
                      ti.description                                                 status
                    FROM solicitud_compra sc
                      INNER JOIN detalle_solicitud ds ON ds.id_solicitud = sc.id_record
                      INNER JOIN articulo ar ON ar.id_record = ds.id_articulo
                        INNER JOIN precio_articulo pa ON pa.id_articulo = ar.id_record
                      INNER JOIN unidad un ON un.id_record = ds.id_unidad
                      INNER JOIN almacen al ON al.id_record = sc.id_almacen
                      INNER JOIN tipo ti ON ti.id_record = sc.id_tipo AND ti.tipo = 'status'
                      INNER JOIN suplidor su ON su.id_record = sc.id_suplidor
                      INNER JOIN persona per ON per.id_record = su.id_persona
                      INNER JOIN tercero ter ON ter.id_record = per.id_tercero
                      LEFT JOIN compra co ON co.id_solicitud = sc.id_record
                    WHERE sc.active = 1 AND sc.id_almacen = $params AND sc.id_tipo not in (24,3,25)
                    GROUP BY 1";
//        echo "$query";die;
        return $this->query($query)->objectList();
    }

    /**
     * save records.
     * @param \stdClass $params
     * @return bool
     */
    public function setSolicitud(\stdClass $params)
    {
        $result = TRUE;

        $model = new SolicitudModel();
        $id = $model->getCurrentId()[0]->id;
        $this->begin();
        $this->id_almacen = $this->escape($params->id_almacen);
        $this->id_suplidor = $this->escape($params->id_suplidor);
        $this->id_tipo = $this->escape(1);
        $this->no_solicitud = $id . "" . rand(100, 999);
        $this->created_by = $this->escape($this->session->id_record);
        $id_record = parent::save(false);
        if ($id_record < 1) {
            $this->rollback("", FALSE);
            $result = FALSE;
        } else {
            $detalle = new DetalleSolicitudModel();
            $detalleTmp = new DetalleSolicitudTmpModel();
            $records = $detalleTmp->getDetallesolicitudtmp();
            foreach ($records as $key) {
                $detalle->id_solicitud = $id_record;
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
     * @param \stdClass $parms
     * @return bool
     */
    public function setDetalletmp(\stdClass $parms)
    {
        $result = TRUE;
        $detalleTmp = new DetalleSolicitudTmpModel();
        $detalleTmp->id_articulo = $this->escape($parms->id_articulo);
        $detalleTmp->qty = $this->escape($parms->qty);
        $detalleTmp->id_unidad = $this->escape($parms->id_unidad);
        $detalleTmp->id_user = $this->escape($this->session->id_record);
        $detalleTmp->date = date("Y-m-d");
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
     * This function get the current id to insert
     * @return object
     */
    public function getCurrentId()
    {
        $this->param1 = "COALESCE(max(sc.id_record) +1,1) id";
        return $this->get()->objectList();
    }

    /**
     * @param $params
     * @return bool
     * @internal param $id
     */
    public function updateSolicitud($params)
    {
        $result = TRUE;
        $this->begin();
        switch ($params->option) {
            case 1:
                $this->id_tipo = 2;
                break;
            case 2:
                $this->id_tipo = 24;
                break;
            default:
                $this->id_tipo = 3;
                break;
        }
        $this->value = $params->id;
        $id_record = parent::update();
        if ($id_record < 1) {
            $result = FALSE;
            $this->rollback("", FALSE);
        } else {
            $this->commit();
        }
        return $result;
    }

    /**
     * This function update properties
     * @return int
     */
    public function updateProp()
    {
        return parent::update(FALSE);
    }
}
