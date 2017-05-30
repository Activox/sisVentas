<?php

namespace it\Models;

use abstracts\ORM;

//use abstracts\Model;

class EmpresaModel extends ORM {

    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null) {
        parent::__construct($properties);
        $this->table = "empresa";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "field_name_table";
        $this->alias = "em";
        $this->session = \Factory::getSession();
    }

    /**
     * get records of main table.
     * @return type
     */
    public function getEmpresa() {
        $this->param1 = "ter.id_record";
        $this->param2 = "ter.nombre";
        $this->param3 = "ter.email";
        $this->param4 = "em.rnc";
        $this->param5 = "em.telefono";
        $this->param6 = "t.description tipo";
        $this->param7 = "(case when em.active = 1 then 'TRUE' else 'FALSE' end) active";
        return $this->get()->
                        inner("tercero ter", ["ter.id_record" => "em.id_tercero"])->
                        inner("nacionalidad na", ["na.id_record" => "ter.id_nacionalidad"])->
                        inner("tipo t", ["t.id_record" => "em.id_tipo"])
                        ->objectList();
    }

    /**
     * save records.
     * @param \it\Models\stdClass $params
     */
    public function setEmpresa(\stdClass $params) {
        $result = TRUE;
        $this->begin();
        //        Tercero
        $TerceroModel = new TerceroModel();
        $TerceroModel->nombre = $this->escape($params->name);
        $TerceroModel->id_nacionalidad = $this->escape($params->nacionalidad);
        $TerceroModel->email = $this->escape($params->email);
        $id_tercero = $TerceroModel->saveProp();
        if ($id_tercero < 1) {
            $this->rollback("", FALSE);
            $result = FALSE;
        } else {
            $this->id_tercero = $this->escape($id_tercero);
            $this->id_tipo = $this->escape($params->tipo);
            $this->telefono = $this->escape($params->telefono);
            $this->rnc = $this->escape($params->rnc);
            $this->created_by = $this->escape($this->session->id_record);
            $id_record = parent::save();
            if ($id_record < 1) {
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
    public function updateEmpresa(\stdClass $params) {
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
