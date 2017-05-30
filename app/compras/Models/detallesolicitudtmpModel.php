<?php

namespace compras\Models;

use abstracts\ORM;

class DetalleSolicitudTmpModel extends ORM
{
    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null)
    {
        parent::__construct($properties);
        $this->table = "detalle_solicitud_tmp";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "";
        $this->alias = "dst";
        $this->session = \Factory::getSession();
    }

    /**
     * This function return the articulos by user_id for table
     * @return object
     */
    public function getDetallesolicitudtmpTable()
    {
        $this->param1 = "CONCAT(CONCAT(ca.description,' ',sc.description),' ',ar.description) articulo";
        $this->param2 = "sum(dst.qty) qty";
        $this->param3 = "dst.id_record";
        $this->param4 = "und.short unidad";
        return $this->get()->
        inner("articulo ar", ["ar.id_record" => "dst.id_articulo"])->
        inner("subcategoria sc", ["sc.id_record" => "ar.id_subcategoria"])->
        inner("categoria ca", ["ca.id_record" => "sc.id_categoria"])->
        inner("unidad und", ["und.id_record" => "dst.id_unidad"])->
        where([
            "dst.id_user" => ["operator" => "=", "value" => $this->session->id_record, "nextcondition" => "AND"],
            "dst.date" => ["operator" => "=", "value" => date("Y-m-d"), "nextcondition" => ""]
        ])->
        groupBy('ar.description')->
        objectList();
    }

    /**
     * This function return the articulos by user_id
     * @return object
     */
    public function getDetallesolicitudtmp()
    {
        $this->param1 = "dst.id_articulo articulo";
        $this->param2 = "dst.qty";
        $this->param3 = "dst.id_record";
        $this->param4 = "dst.id_unidad";
        return $this->get()->
        where([
            "dst.id_user" => ["operator" => "=", "value" => $this->session->id_record, "nextcondition" => "AND"],
            "dst.date" => ["operator" => "=", "value" => date("Y-m-d"), "nextcondition" => ""]
        ])->
        objectList();
    }

    /**
     * Save records
     * @return type
     */
    public function saveProp()
    {
        $id_record = parent::save();
        return $id_record;
    }

    /**
     * @return bool
     */
    public function deleteProp()
    {
        $result = TRUE;
        $records = $this->getDetallesolicitudtmp();
        foreach ($records as $key) {
            $this->value = $key->id_record;
            $id_record = parent::delete();
            if ($id_record == 0) {
                $result = FALSE;
                break;
            }
        }
        return $result;
    }

    /**
     * @param $id
     * @return bool
     */
    public function deletePropById($id)
    {
        $result = TRUE;
        $this->value = $id;
        $id_record = parent::delete();
        if ($id_record == 0) {
            $this->rollback('', FALSE);
            $result = FALSE;
        } else {
            $this->commit();
        }
        return $result;
    }
}
