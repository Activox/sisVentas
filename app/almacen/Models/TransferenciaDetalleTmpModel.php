<?php

namespace Almacen\Models;

use abstracts\ORM;

//use abstracts\Model;

class TransferenciaDetalleTmpModel extends ORM
{

    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null)
    {
        parent::__construct($properties);
        $this->table = "detalle_transferencia_mercancia_tmp";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "";
        $this->alias = "dtmt";
        $this->session = \Factory::getSession();
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
            "dtmt.created_by" => ["operator" => "=", "value" => $this->session->id_record, "nextcondition" => "AND"],
            "dtmt.created_on" => ["operator" => "=", "value" => date("Y-m-d"), "nextcondition" => ""]
        ])->
        objectList();
    }

}
