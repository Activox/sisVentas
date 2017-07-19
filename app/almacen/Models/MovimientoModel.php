<?php

namespace almacen\Models;

use abstracts\ORM;

//use abstracts\Model;

class MovimientoModel extends ORM
{
    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null)
    {
        parent::__construct($properties);
        $this->table = "movimiento_inventario";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "";
        $this->alias = "mi";
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

    /**
     * This function return the movements of one product
     * @param $params
     * @return object
     */
    public function getMovements($params)
    {
        $sql = "
        SELECT
          CONCAT(CONCAT(ca.description, ' ', sc.description), ' ', ar.description) articulo,
          mi.qty,
          upper(ti.description)                                                           tipo,
           DATE_FORMAT(mi.created_on,'%m-%d-%Y')                                   created_on,
          CONCAT(ter.nombre, ' ', per.apellidos)                                   created_by
        FROM movimiento_inventario mi
          INNER JOIN inventario inv ON inv.id_record = mi.id_inventario AND inv.active = 1
          INNER JOIN articulo ar ON ar.id_record = inv.id_articulo AND ar.active = 1
          INNER JOIN subcategoria sc ON sc.id_record = ar.id_subcategoria AND sc.active = 1
          INNER JOIN categoria ca ON ca.id_record = sc.id_categoria AND ca.active = 1
          INNER JOIN tipo ti ON ti.id_record = mi.id_tipo AND ti.active = 1
          INNER JOIN usuario user ON user.id_record = mi.created_by
          INNER JOIN empleado emp ON emp.id_record = user.id_empleado
          INNER JOIN persona per ON per.id_record = emp.id_persona
          INNER JOIN tercero ter ON ter.id_record = per.id_tercero
        WHERE mi.active = 1 AND mi.id_inventario = $params
        ORDER BY 4 desc
        ";
        return $this->query($sql)->objectList();
    }
}
