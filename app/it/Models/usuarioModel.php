<?php

namespace it\Models;

use abstracts\ORM;

//use abstracts\Model;

class UsuarioModel extends ORM {

    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null) {
        parent::__construct($properties);
        $this->table = "usuario";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "field_name_table";
        $this->alias = "us";
        $this->session = \Factory::getSession();
    }

    /**
     * get records of main table.
     * @return type
     */
    public function getUsuario() {
        $this->param1 = "us.id_record";
        $this->param2 = "CONCAT(ter.nombre,' ',per.apellidos) nombre";
        $this->param3 = "ter.email";
        $this->param6 = "us.username";
        $this->param4 = "t.description tipo";
        $this->param7 = "COALESCE(upper(term.description),'-') terminal";
        $this->param5 = "case when us.active = 1 then 'TRUE' else 'FALSE' end active";
        return $this->get()->
                        inner("tipo t", ["t.id_record" => "us.id_tipo"])->
                        inner("empleado em", ["em.id_record" => "us.id_empleado"])->
                        inner("persona per", ["per.id_record" => "em.id_persona"])->
                        inner("tercero ter", ["ter.id_record" => "per.id_tercero"])->
                        left("terminales term", ["term.id_record" => "us.id_terminal"])->
                        objectList();
    }

    /**
     * save records.
     * @param \it\Models\stdClass $params
     */
    public function setUsuario(\stdClass $params) {
        $result = TRUE;
        $this->begin();
        $this->id_empleado = $this->escape($params->empleado);
        $this->id_tipo = $this->escape($params->tipo);
        $this->username = $this->escape($params->username);
        $this->clave = $this->escape($params->password);
        $this->created_by = $this->escape($this->session->id_record);
        $this->id_terminal = $this->escape($params->terminal);
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
    public function updateUsuario(\stdClass $params) {
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
