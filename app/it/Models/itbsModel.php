<?php

namespace it\Models;

use abstracts\ORM;

//use abstracts\Model;

class ItbsModel extends ORM
{

    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null)
    {
        parent::__construct($properties);
        $this->table = "impuesto";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "field_name_table";
        $this->alias = "u";
        $this->session = \Factory::getSession();
    }

    /**
     * get records of main table.
     * @return type
     */
    public function getItbs()
    {
        $this->param1 = "u.id_record";
        $this->param2 = "u.description";
        $this->param3 = "u.porcentaje";
        $this->param4 = "case when u.active = 1 then 'TRUE' else 'FALSE' end active";
        return $this->get()->objectList();
    }

    /**
     * save records.
     * @param \it\Models\stdClass $params
     */
    public function setItbs(\stdClass $params)
    {

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
     * this function update records
     * @param \stdClass $params
     * @return boolean
     */
    public function updateItbs(\stdClass $params)
    {
        $result = TRUE;
        $this->description = $this->escape($params->description);
        $this->porcentaje = $this->escape($params->porcentaje);
        $this->created_by = $this->escape($this->session->id_record);
        if ($params->active == "TRUE") {
            $active = 1;
        } else {
            $active = 0;
        }
        $this->active = $this->escape($active);
        $this->value = $this->escape($params->id_record);
        $id_record = parent::update();
        if ($id_record < 1) {
            $this->rollback("", FALSE);
            $result = FALSE;
        }
        return $result;
    }

    /**
     * @return object
     */
    Public function getImpuestoBySubcategoria()
    {
        $sql = "
        SELECT
          pg.id_record,
          pg.id_subcategoria,
          upper(CONCAT(ca.description, ' ', sc.description)) subcategoria,
          CONCAT(pg.porcentaje, ' ', '%')                    porcentaje,
          CASE WHEN pg.active = 1
            THEN 'TRUE'
          ELSE 'FALSE' END                                   active
        FROM impuesto pg
          INNER JOIN subcategoria sc ON sc.id_record = pg.id_subcategoria AND sc.active = 1
          INNER JOIN categoria ca ON ca.id_record = sc.id_categoria AND ca.active = 1
        WHERE pg.id_subcategoria != 0
        GROUP BY 1, 2, 3, 4";
        return $this->query($sql)->objectList();
    }

    Public function getImpuestoByArticulo()
    {
        $sql = "
          SELECT
              pg.id_record,
              pg.id_subcategoria,
              pg.id_articulo,
              upper(CONCAT(CONCAT(ca.description, ' ', sc.description),' ',ar.description)) articulo,
              CONCAT(pg.porcentaje, ' ', '%')                    porcentaje,
              CASE WHEN pg.active = 1
                THEN 'TRUE'
              ELSE 'FALSE' END                                   active
          FROM impuesto pg
              INNER JOIN articulo ar ON ar.id_record = pg.id_articulo
              INNER JOIN subcategoria sc ON sc.id_record = ar.id_subcategoria AND sc.active = 1
              INNER JOIN categoria ca ON ca.id_record = sc.id_categoria AND ca.active = 1
          WHERE pg.id_articulo != 0
          GROUP BY 1, 2, 3, 4";
        return $this->query($sql)->objectList();
    }

}
