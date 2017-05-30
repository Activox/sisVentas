<?php

namespace it\Models;

use abstracts\ORM;

//use abstracts\Model;

class NacionalidadModel extends ORM {

    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null) {
        parent::__construct($properties);
        $this->table = "nacionalidad";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "";
        $this->alias = "p";
        $this->session = \Factory::getSession();
    }

    /**
     * get records of main table.
     * @return type
     */
    public function getNacionalidad() {
        $this->param1 = "p.id_record";
        $this->param3 = "p.description";
        $this->param4 = "case when p.active = 1 then 'TRUE' else 'FALSE' end active";
        return $this->get()->objectList();
    }

    /**
     * get records by pais.
     * @return type
     */
    public function getNacionalidadByPais($id_pais) {
        $this->param1 = "p.id_record";
        $this->param3 = "p.description";
        $this->param4 = "case when p.active = 1 then 'TRUE' else 'FALSE' end active";
        return $this->get()->where(["p.id_pais" => ["operator" => "=", "value" => $id_pais, "nextcondition" => ""]])->objectList();
    }

    /**
     * Save records
     * @return type
     */
    public function saveProp() {
        $id_record = parent::save();
        return $id_record;
    }

    /**
     * this function update records
     * @param \stdClass $params
     * @return boolean
     */
    public function updateProp() {
        $id_record = parent::update();
        return $id_record;
    }

}
