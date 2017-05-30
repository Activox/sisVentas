<?php

namespace it\Models;

use abstracts\ORM;

//use abstracts\Model;

class DescuentoModel extends ORM
{

    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null)
    {
        parent::__construct($properties);
        $this->table = "descuento";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "";
        $this->alias = "des";
        $this->session = \Factory::getSession();
    }

    /**
     * @param $params
     * @return bool
     */
    public function setDescuento($params)
    {
//        print_r($params);die;
        $result = TRUE;
        $this->id_articulo = $this->escape($params->id_articulo);
        $this->id_subcategoria = $this->escape($params->id_subcategoria);
        $this->porcentaje = $this->escape($params->porcentaje);
        $this->created_by = $this->escape($this->session->id_record);
        $id_record = parent::save();
        if ($id_record < 1) {
            $this->rollback("", FALSE);
            $result = FALSE;
        }
        return $result;
    }

    /**
     * @return object
     */
    Public function getDescuentoBySubcategoria()
    {
        $sql = "
        SELECT
          pg.id_record,
          pg.id_subcategoria,
          upper(CONCAT(ca.description, ' ', sc.description)) subcategoria,
          CONCAT(pg.porcentaje, ' ', '%')                     porcentaje,
          CASE WHEN pg.active = 1
            THEN 'TRUE'
          ELSE 'FALSE' END                                   active
        FROM descuento pg
          INNER JOIN subcategoria sc ON sc.id_record = pg.id_subcategoria AND sc.active = 1
          INNER JOIN categoria ca ON ca.id_record = sc.id_categoria AND ca.active = 1
        WHERE pg.id_subcategoria != 0
        GROUP BY 1, 2, 3, 4";
        return $this->query($sql)->objectList();
    }

    Public function getDescuentoByArticulo()
    {
        $sql = "
          SELECT
              pg.id_record,
              pg.id_subcategoria,
              pg.id_articulo,
              upper(CONCAT(CONCAT(ca.description, ' ', sc.description), ' ', ar.description)) articulo,
              CONCAT(pg.porcentaje, ' ', '%')                                                  porcentaje,
              CASE WHEN pg.active = 1
                THEN 'TRUE'
              ELSE 'FALSE' END                                                                active
          FROM descuento pg
              INNER JOIN articulo ar ON ar.id_record = pg.id_articulo
              INNER JOIN subcategoria sc ON sc.id_record = ar.id_subcategoria AND sc.active = 1
              INNER JOIN categoria ca ON ca.id_record = sc.id_categoria AND ca.active = 1
          WHERE pg.id_articulo != 0
          GROUP BY 1, 2, 3, 4";
        return $this->query($sql)->objectList();
    }

    Public function getDescuentoByTipo()
    {
        $sql = "
          SELECT
              pg.id_record,
              pg.id_tipo,
              UPPER(ar.description)                              tipo,
              UPPER(ar.description)                              description,
              CONCAT(pg.porcentaje, ' ', '%')                    porcentaje,
              CASE WHEN pg.active = 1
                THEN 'TRUE'
              ELSE 'FALSE' END                                   active
          FROM tipo_descuento pg
              INNER JOIN tipo ar ON ar.id_record = pg.id_tipo          
          GROUP BY 1, 2, 3, 4,5";
        return $this->query($sql)->objectList();
    }


}
