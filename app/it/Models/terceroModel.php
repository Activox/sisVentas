<?php

namespace it\Models;

use abstracts\ORM;

//use abstracts\Model;

class TerceroModel extends ORM {

    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null) {
        parent::__construct($properties);
        $this->table = "tercero";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "";
        $this->alias = "ci";
        $this->session = \Factory::getSession();
    }

    public function getTerceroById($id) {
        $this->param1 = "ci.id_record";
        $this->param2 = "ci.nombre";
        return $this->get()->
                        where(["ci.id_record" => ["operator" => "=", "value" => $id, "nextcondition" => ""]])->
                objectList();
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
