<?php

namespace it\Models;

use abstracts\ORM;

//use abstracts\Model;

class UnidadModel extends ORM {

    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null) {
        parent::__construct($properties);
        $this->table = "unidad";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "field_name_table";
        $this->alias = "u";
        $this->session = \Factory::getSession();
    }

    /**
     * get records of main table.
     * @return type
     */
    public function getUnidad() {
        $this->param1 = "u.id_record";
        $this->param2 = "u.description";
        $this->param3 = "u.short";
        $this->param4 = "u.qty";
        $this->param5 = "case when u.active = 1 then 'TRUE' else 'FALSE' end active";
        return $this->get()->objectList();
    }

    /**
     * save records.
     * @param stdClass|\stdClass $params
     * @return bool
     */
    public function setUnidad(\stdClass $params) {
        $result = TRUE;
        $this->begin();
        $this->description = $this->escape($params->description);
        $this->short = $this->escape($params->sdescription);
        $this->qty = $this->escape($params->cant);
        $this->created_by = $this->escape($this->session->id_record);
        $id_record = parent::save();
        if ($id_record < 1) {
            $this->rollback("", FALSE);
            $result = FALSE;
        } else {
            $this->commit();
        }
        return $result;
    }

    /**
     * this function update records
     * @param \stdClass $params
     * @return boolean
     */
    public function updateUnidad(\stdClass $params) {
        $result = TRUE;
        $this->description = $this->escape($params->description);
        $this->short_description = $this->escape($params->sdescription);
        $this->qty_reference = $this->escape($params->cant);
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
