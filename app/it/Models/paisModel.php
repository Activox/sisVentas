<?php

namespace it\Models;

use abstracts\ORM;

//use abstracts\Model;

class PaisModel extends ORM {

    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null) {
        parent::__construct($properties);
        $this->table = "pais";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "field_name_table";
        $this->alias = "p";
        $this->session = \Factory::getSession();
    }

    /**
     * get records of main table.
     * @return type
     */
    public function getPais() {
        $this->param1 = "p.id_record";
        $this->param3 = "p.description";
        $this->param4 = "case when p.active = 1 then 'TRUE' else 'FALSE' end active";
        return $this->get()->objectList();
    }

    /**
     * save records.
     * @param \it\Models\stdClass $params
     */
    public function setPais(\stdClass $params) {
        $result = TRUE;
        $this->begin();
        $this->description = $this->escape($params->description);
        $this->created_by = $this->escape($this->session->id_record);
        $id_record = parent::save();
        if ($id_record < 1) {
            $this->rollback("", FALSE);
            $result = FALSE;
        } else {
            $nacionalidadModel = new NacionalidadModel();
            $nacionalidadModel->description = $this->escape($params->nacionalidad);
            $id_nacionalidad = $nacionalidadModel->saveProp();
            if ($id_nacionalidad < 1) {
                $this->rollback("", FALSE);
                $result = FALSE;
            } else {
                $this->commit();
            }
        }
        return $result;
    }

    /**
     * this function update records
     * @param \stdClass $params
     * @return boolean
     */
    public function updatePais(\stdClass $params) {
        $result = TRUE;
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
