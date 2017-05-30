<?php

namespace compras\Models;

use abstracts\ORM;

class DetalleSolicitudModel extends ORM
{

    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null)
    {
        parent::__construct($properties);
        $this->table = "detalle_solicitud";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "";
        $this->alias = "ds";
        $this->session = \Factory::getSession();
    }

    /**
     * Save records
     * @return type
     */
    public function saveProp()
    {
        $id_record = parent::save(false);
        return $id_record;
    }

}
