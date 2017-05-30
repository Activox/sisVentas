<?php

namespace it\Models;

use abstracts\ORM;

//use abstracts\Model;

class PrecioModel extends ORM
{

    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null)
    {
        parent::__construct($properties);
        $this->table = "precio_articulo";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "";
        $this->alias = "pa";
        $this->session = \Factory::getSession();
    }

    /**
     * get records of main table.
     * @return type
     */
    public function getPrecio()
    {
        $query = "
        SELECT
          pa.id_record,
          CONCAT(ter.nombre, ' ', per.apellidos)                                   suplidor,
          pa.id_suplidor,
          CONCAT(CONCAT(ca.description, ' ', sc.description), ' ', ar.description) product,
          pa.precio,
          CASE WHEN pa.active = 1
            THEN 'TRUE'
          ELSE 'FALSE' END                                                         active
        FROM precio_articulo pa INNER JOIN articulo ar ON ar.id_record = pa.id_articulo
          INNER JOIN subcategoria sc ON sc.id_record = ar.id_subcategoria
          INNER JOIN categoria ca ON ca.id_record = sc.id_categoria
          INNER JOIN suplidor su ON su.id_record = pa.id_suplidor
          INNER JOIN persona per ON per.id_record = su.id_persona
          INNER JOIN tercero ter ON ter.id_record = per.id_tercero
          GROUP BY 1,2,3,4,5
        ";
        return $this->query($query)->objectList();
    }

    /**
     * save records.
     * @param stdClass|\stdClass $params
     * @return bool
     */
    public function setPrecio(\stdClass $params)
    {
        $result = TRUE;
        $this->begin();
        $this->id_articulo = $this->escape($params->articulo);
        $this->id_suplidor = $this->escape($params->suplidor);
        $this->precio = $this->escape($params->precio);
        $this->created_by = $this->escape($this->session->id_record);
        $id_record = parent::save();
        if ($id_record < 1) {
            $this->rollback("", FALSE);
            $result = FALSE;
        } else {
            $this->commit();
        }
        return $result;
    }

    /**
     * this function update records
     * @param \stdClass $params
     * @return boolean
     */
    public function updatePrecio(\stdClass $params)
    {
        $result = TRUE;
        $this->begin();
        $this->id_categoria = $this->escape($params->categoria);
        $this->description = $this->escape($params->description);
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

}
