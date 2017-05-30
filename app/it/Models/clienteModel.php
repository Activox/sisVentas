<?php

namespace it\Models;

use abstracts\ORM;

//use abstracts\Model;

class ClienteModel extends ORM {
    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null) {
        parent::__construct($properties);
        $this->table = "cliente";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "";
        $this->alias = "ci";
        $this->session = \Factory::getSession();
    }

    /**
     * @return object
     */
    public function getCliente() {
        $this->param1 = "ter.id_record";
        $this->param2 = "ter.nombre";
        $this->param3 = "ter.email";
        $this->param4 = "na.description";
        $this->param5 = "per.apellidos";
        $this->param14 = "per.cedula";
        $this->param6 = "ci.telefono";
        $this->param7 = "per.sexo";
        $this->param8 = "DATE_FORMAT(per.birthdate,'%M/%d/%Y') birthdate";
        $this->param11 = "t.description tipo";
        $this->param12 = "(Case when ci.active = 1 THEN 'TRUE' ELSE 'FALSE' END) active";
        return $this->get()->
                        inner("persona per", ["per.id_record" => "ci.id_persona"])->
                        inner("tercero ter", ["ter.id_record" => "per.id_tercero"])->
                        inner("nacionalidad na", ["na.id_record" => "ter.id_nacionalidad"])->
                        inner("tipo t", ["t.id_record" => "ci.id_tipo"])->
                        where(["ci.active" => ["operator" => "=", "value" => 1, "nextcondition" => ""]])->objectList();
    }

    /**
     * @return object
     */
    public function getClienteName(){
        $sql ="
        SELECT cli.id_record,
                CONCAT(ter.nombre,' ',per.apellidos) description
        FROM tercero ter
          INNER JOIN persona per ON per.id_tercero = ter.id_record /*AND per.active = 1*/
          INNER JOIN cliente cli ON cli.id_persona = per.id_record /*AND cli.active = 1*/
        GROUP BY 1
        ";
        return $this->query($sql)->objectList();
    }

    /**
     *
     * @param stdClass|\stdClass $params
     * @return bool
     */
    public function setCliente(\stdClass $params) {
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
//            Persona
            $PersonaModel = new PersonaModel();
            $PersonaModel->id_tercero = $id_tercero;
            $PersonaModel->apellidos = $this->escape($params->last_name);
            $PersonaModel->cedula = $this->escape($params->cedula);
            $PersonaModel->sexo = $this->escape($params->sexo);
            $PersonaModel->birthdate = date('Y-m-d', strtotime($params->date));
            $PersonaModel->created_by = $this->escape($this->session->id_record);
            $id_persona = $PersonaModel->saveProp();
            if ($id_persona < 1) {
                $this->rollback("", FALSE);
                $result = FALSE;
            } else {
//                Cliente
                $this->id_persona = $id_persona;
                $this->telefono = $this->escape($params->phone);
                $this->id_tipo = $this->escape($params->tipo);
                $this->created_by = $this->escape($this->session->id_record);
                $id_record = parent::save();
                if ($id_record < 1) {
                    $this->rollback("", FALSE);
                    $result = FALSE;
                } else {
//                    Direccion
                    $DireccionModel = new DireccionModel();
                    $DireccionModel->id_tercero = $id_tercero;
                    $DireccionModel->id_sector = $this->escape($params->sector);
                    $DireccionModel->direccion = $this->escape($params->direccion);
                    $DireccionModel->created_by = $this->escape($this->session->id_record);
                    $id_direccion = $DireccionModel->saveProp();
                    if ($id_direccion < 1) {
                        $this->rollback("", FALSE);
                        $result = FALSE;
                    } else {
                        $this->commit();
                    }
                }
            }
        }
        return $result;
    }

}
