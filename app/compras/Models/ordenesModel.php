<?php

namespace compras\Models;

use abstracts\ORM;

class OrdenModel extends ORM
{

    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null)
    {
        parent::__construct($properties);
        $this->table = "compra";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "";
        $this->alias = "co";
        $this->session = \Factory::getSession();
    }
}
