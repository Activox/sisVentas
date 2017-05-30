<?php

namespace Defaults\Models;

//use abstracts\ORM;
use abstracts\Model;

class DefaultModel extends Model {

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null) {
        parent::__construct($properties);
    }

    public function getUser($params) {
        $query = ""
                . "SELECT us.username,us.id_record,CONCAT(ter.nombre,' ',per.apellidos) nombre, ter.email"
                . " FROM usuario us "
                . " INNER JOIN empleado em ON em.id_record = us.id_empleado"
                . " INNER JOIN persona per ON per.id_record = em.id_persona"
                . " INNER JOIN tercero ter ON ter.id_record = per.id_tercero"
                . " WHERE us.username='$params->username' and us.clave = '$params->clave' ";
        $result = $this->getDbo()->getObjectList($query);
        return $result;
    }

}
