<?php

namespace it\Models;

use abstracts\ORM;

//use abstracts\Model;

class SubcategoriaModel extends ORM {

    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null) {
        parent::__construct($properties);
        $this->table = "subcategoria";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "";
        $this->alias = "s";
        $this->session = \Factory::getSession();
    }

    /**
     * get records of main table.
     * @return type
     */
    public function getSubcategoria() {
        $this->param1 = "s.id_record";
        $this->param2 = "c.description categoria";
        $this->param3 = "s.description";
        $this->param4 = "case when s.active = 1 then 'TRUE' else 'FALSE' end active";
        return $this->get()->
                        inner("categoria c", ["c.id_record" => "s.id_categoria"])->
                        objectList();
    }

    /**
     * Get sub categoria by
     * @param type $id_categoria
     * @return type
     */
    public function getSubcategoriaByCategoria($id_categoria) {
        $this->param1 = "s.id_record";
        $this->param2 = "c.description categoria";
        $this->param3 = "s.description";
        $this->param4 = "(case when s.active = 1 then 'TRUE' else 'FALSE' end) active";
        return $this->get()->
                        inner("categoria c", ["c.id_record" => "s.id_categoria"])->
                        where(["s.id_categoria" => ["operator" => "=", "value" => $id_categoria, "nextcondition" => ""]])->objectList();
    }

    /**
     * save records.
     * @param \it\Models\stdClass $params
     */
    public function setSubcategoria(\stdClass $params) {
        $result = TRUE;
        $this->begin();
        $this->id_categoria = $this->escape($params->categoria);
        $this->description = $this->escape($params->description);
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
    public function updateSubcategoria(\stdClass $params) {
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
