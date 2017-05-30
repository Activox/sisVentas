<?php

namespace it\Models;

use abstracts\ORM;

//use abstracts\Model;

class CiudadModel extends ORM {

    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null) {
        parent::__construct($properties);
        $this->table = "ciudad";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "";
        $this->alias = "ci";
        $this->session = \Factory::getSession();
    }

    public function getCiudad() {
        $this->param1 = "ci.id_record";
        $this->param2 = "ci.description";
        $this->param5 = "Case when ci.active = 1 THEN 'TRUE' ELSE 'FALSE' END active ";
        $this->param6 = "p.description pais";
        return $this->get()->
                        inner("pais p", ["p.id_record" => "ci.id_pais"])->
                        where(["ci.active" => ["operator" => "=", "value" => 1, "nextcondition" => ""]])->objectList();
    }

    public function getCiudadByPais($id_pais) {
        $this->param1 = "ci.id_record";
        $this->param2 = "ci.description";
        $this->param5 = "Case when ci.active = 1 THEN 'TRUE' ELSE 'FALSE' END active ";
        $this->param6 = "p.description pais";
        return $this->get()->
                        inner("pais p", ["p.id_record" => "ci.id_pais"])->
                        where(["ci.id_pais" => ["operator" => "=", "value" => $id_pais, "nextcondition" => ""]])->objectList();
    }

    /**
     * 
     * @param \it\Models\stdClass $params
     */
    public function setCiudad(\stdClass $params) {
        $result = TRUE;
        $this->begin();
        $this->id_pais = $this->escape($params->pais);
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
