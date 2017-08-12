<?php

namespace Almacen\Models;

use abstracts\ORM;
//use abstracts\Model;

class TransferenciaDetalleModel extends ORM {

    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null) {
        parent::__construct($properties);
        $this->table = "detalle_transferencia_mercancia";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "";
        $this->alias = "dtm";
        $this->session = \Factory::getSession();
    }

}
