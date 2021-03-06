<?php
/**
 * Created by PhpStorm.
 * User: paul9
 * Date: 8/6/2017
 * Time: 1:57 AM
 */

namespace Facturacion\Models;

use abstracts\ORM;

class MovimientoCuentaModel extends ORM
{
    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null)
    {
        parent::__construct($properties);
        $this->table = "movimiento_cuenta";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "";
        $this->alias = "mc";
        $this->session = \Factory::getSession();
    }

    /**
     * @return int
     */
    public function saveprop()
    {
        $id_record = parent::save();
        return $id_record;
    }

    /**
     *
     */
    public function rollBackProp()
    {
        return $this->rollback("", FALSE);
    }
}