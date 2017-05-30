<?php

namespace it\Models;

use abstracts\ORM;

//use abstracts\Model;

class DireccionModel extends ORM {

    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null) {
        parent::__construct($properties);
        $this->table = "direccion";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "";
        $this->alias = "dir";
        $this->session = \Factory::getSession();
    }

    public function getDireccion() {
//        $this->param1 = "ci.id_record";
//        $this->param2 = "ci.description";
//        $this->param5 = "Case when ci.active = 1 THEN 'TRUE' ELSE 'FALSE' END active ";
//        return $this->get()->
//                        where(["ci.active" => ["operator" => "=", "value" => 1, "nextcondition" => ""]])->objectList();
    }

    public function getDireccionPersona($id_tercero) {
        $this->param1 = "CONCAT(CONCAT(CONCAT(dir.direccion,' ',sec.description),' ',ci.description),' ',pa.description) direccion";
        return $this->get()->
                        inner("sector sec", ["sec.id_record" => "dir.id_sector"])->
                        inner("ciudad ci", ["ci.id_record" => "sec.id_ciudad"])->
                        inner("pais pa", ["pa.id_record" => "ci.id_pais"])->
                        where(["dir.id_tercero" => ["operator" => "=", "value" => $id_tercero, "nextcondition" => ""]
                        ])->objectList();
    }

    /**
     * Save records
     * @return type
     */
    public function saveProp() {
        $id_record = parent::save();
        return $id_record;
    }

}
