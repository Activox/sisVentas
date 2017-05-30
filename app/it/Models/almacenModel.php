<?php

namespace it\Models;

use abstracts\ORM;

//use abstracts\Model;

class AlmacenModel extends ORM {

    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null) {
        parent::__construct($properties);
        $this->table = "almacen";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "";
        $this->alias = "ar";
        $this->session = \Factory::getSession();
    }

    /**
     * get records of main table.
     * @return type
     */
    public function getAlmacen() {
        $this->param1 = "ar.id_record";
        $this->param2 = "ar.id_tercero";
        $this->param3 = "ar.id_empleado";
        $this->param5 = "ter.nombre description";
        $this->param4 = "case when ar.active = 1 then 'TRUE' else 'FALSE' end active";
        return $this->get()->
        inner("tercero ter", ["ter.id_record" => "ar.id_tercero"])->
                        objectList();
    }

    /**
     * save records.
     * @param \it\Models\stdClass $params
     */
    public function setAlmacen(\stdClass $params) {
        $result = TRUE;
        $this->begin();
//        Tercero
        $TerceroModel = new TerceroModel();
        $TerceroModel->nombre = $this->escape($params->almacen);
        $id_tercero = $TerceroModel->saveProp();
        if ($id_tercero < 1) {
            $this->rollback("", FALSE);
            $result = FALSE;
        } else {
            $this->id_tercero = $id_tercero;
            $this->id_empleado = $this->escape($params->empleado);
            $this->created_by = $this->escape($this->session->id_record);
            $id_record = parent::save();
            if ($id_record < 1) {
                $this->rollback("", FALSE);
                $result = FALSE;
            } else {
//                Direccion
                $DireccionModel = new DireccionModel();
                $DireccionModel->id_tercero = $id_tercero;
                $DireccionModel->id_sector = $this->escape($params->sector);
                $DireccionModel->direccion = $this->escape($params->description);
                $DireccionModel->created_by = $this->escape($this->session->id_record);
                $id_direccion = $DireccionModel->saveProp();
                if ($id_direccion < 1) {
                    $this->rollback("", FALSE);
                    $result = FALSE;
                } else {
                    $this->commit();
                }
            }
        }
        return $result;
    }

    /**
     * this function update records
     * @param \stdClass $params
     * @return boolean
     */
    public function updateAlmacen(\stdClass $params) {
        $result = TRUE;
        $this->begin();
        $this->id_categoria = $this->escape($params->categoria);
        $this->description = $this->escape($params->description);
        $this->created_by = $this->escape($this->session->id_record);
        if ($params->active == "TRUE") {
            $active = 1;
        } else {
            $active = 0;
        }
        $this->active = $this->escape($active);
        $this->value = $this->escape($params->id_record);
        $id_record = parent::update();
        if ($id_record < 1) {
            $this->rollback("", FALSE);
            $result = FALSE;
        }
        return $result;
    }

}
