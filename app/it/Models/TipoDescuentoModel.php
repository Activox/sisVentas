<?php

namespace it\Models;
use abstracts\ORM;
class TipoDescuentoModel extends ORM
{

    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null)
    {
        parent::__construct($properties);
        $this->table = "tipo_descuento";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "";
        $this->alias = "td";
        $this->session = \Factory::getSession();
    }

    /**
     * @param $params
     * @return bool
     */
    public function setTipoDescuento($params)
    {
        $result = TRUE;
        $this->begin();
        $this->id_tipo = $params->id_tipo;
        $this->porcentaje = $params->porcentaje;
        $id_record = parent::save();
        if ($id_record < 1) {
            $this->rollback('', FALSE);
            $result = FALSE;
        } else {
            $this->commit();
        }
        return $result;
    }
}
