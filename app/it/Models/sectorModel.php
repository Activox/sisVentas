<?php

namespace it\Models;

use abstracts\ORM;

//use abstracts\Model;

class SectorModel extends ORM {

    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null) {
        parent::__construct($properties);
        $this->table = "sector";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "";
        $this->alias = "sc";
        $this->session = \Factory::getSession();
    }

    public function getSector() {
        $this->param1 = "sc.id_record";
        $this->param2 = "sc.description";
        $this->param5 = "(Case when sc.active = 1 THEN 'TRUE' ELSE 'FALSE' END) active ";
        $this->param6 = "ci.description ciudad";
        return $this->get()->
                        inner("ciudad ci", ["ci.id_record" => "sc.id_ciudad"])->
                        where(["sc.active" => ["operator" => "=", "value" => 1, "nextcondition" => ""]])->objectList();
    }

    public function getSectorByCiudad($id_sector) {
        $this->param1 = "sc.id_record";
        $this->param2 = "sc.description";
        $this->param5 = "(Case when sc.active = 1 THEN 'TRUE' ELSE 'FALSE' END) active ";
        $this->param6 = "ci.description ciudad";
        return $this->get()->
                        inner("ciudad ci", ["ci.id_record" => "sc.id_ciudad"])->
                        where(["sc.id_ciudad" => ["operator" => "=", "value" => $id_sector, "nextcondition" => ""]])->objectList();
    }

    /**
     * 
     * @param \it\Models\stdClass $params
     */
    public function setSector(\stdClass $params) {
        $result = TRUE;
        $this->begin();
        $this->id_ciudad = $this->escape($params->ciudad);
        $this->description = $this->escape($params->description);
        $this->created_by = $this->escape($this->session->id_record);
        $this->begin();
        $id_record = parent::save();
        if ($id_record < 1) {
            $this->rollback("", FALSE);
            $result = FALSE;
        } else {
            $this->commit();
        }
        return $result;
    }

}
