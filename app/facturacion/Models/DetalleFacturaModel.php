<?php

namespace Facturacion\Models;

use abstracts\ORM;

//use abstracts\Model;

class DetalleFacturaModel extends ORM
{
    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null)
    {
        parent::__construct($properties);
        $this->table = "detalle_factura";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "";
        $this->alias = "fat";
        $this->session = \Factory::getSession();
    }

    /**
     * @return int
     */
    public function saveProp()
    {
        return parent::save(false);
    }

}
