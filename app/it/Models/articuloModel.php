<?php

namespace it\Models;

use abstracts\ORM;

//use abstracts\Model;

class ArticuloModel extends ORM
{

    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null)
    {
        parent::__construct($properties);
        $this->table = "articulo";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "";
        $this->alias = "ar";
        $this->session = \Factory::getSession();
    }

    /**
     * get records of main table.
     * @return type
     */
    public function getArticulo()
    {
        $this->param1 = "ar.id_record";
        $this->param7 = "ar.id_suplidor";
        $this->param2 = "ar.description product";
        $this->param8 = "ar.codigo_barra";
        $this->param3 = "sc.description sub_categoria";
        $this->param6 = "c.description categoria";
        $this->param5 = "case when ar.active = 1 then 'TRUE' else 'FALSE' end active";
        return $this->get()->
        inner("subcategoria sc", ["sc.id_record" => "ar.id_subcategoria"])->
        inner("categoria c", ["c.id_record" => "sc.id_categoria"])->
        objectList();
    }

    /**
     * get records by id_suplidor
     * @param $id
     * @return type
     */
    public function getArticuloBySuplidor($id)
    {
        $this->param1 = "ar.id_record";
        $this->param7 = "ar.id_suplidor";
        $this->param2 = "CONCAT(CONCAT(c.description,' ',sc.description),' ',ar.description) description";
        $this->param8 = "ar.codigo_barra";
        $this->param3 = "sc.description sub_categoria";
        $this->param6 = "c.description categoria";
        $this->param5 = "case when ar.active = 1 then 'TRUE' else 'FALSE' end active";
        return $this->get()->
        inner("subcategoria sc", ["sc.id_record" => "ar.id_subcategoria"])->
        inner("categoria c", ["c.id_record" => "sc.id_categoria"])->
        where(["ar.id_suplidor" => ["operator" => "=", "value" => $id, "nextcondition" => ""]])->
        objectList();
    }

    /**
     * save records.
     * @param stdClass|\stdClass $params
     * @return bool
     */
    public function setArticulo(\stdClass $params)
    {
        $result = TRUE;
        $this->begin();
        $this->id_subcategoria = $this->escape($params->subcategoria);
        $this->description = $this->escape($params->description);
        $this->created_by = $this->escape($this->session->id_record);
        $this->id_suplidor = $this->escape($params->suplidor);
        $this->codigo_barra = $this->escape($params->codigobarra);
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
    public function updateArticulo(\stdClass $params)
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

    /**
     * @param $barcode
     * @return object
     */
    public function getInfoByBarcode(\stdClass $params)
    {
        $sql = "
        SELECT
          a.id_record,
          a.description,
          a.precio,
          a.qty_inv,
          COALESCE(a.qty,0) qty,
          COALESCE(COALESCE(a.des_categoria,a.des_articulo),0) descuento,
          COALESCE(COALESCE(a.por_categoria,a.por_articulo),0) ganancia
        FROM
          (
            SELECT
              ar.id_record,
              CONCAT(CONCAT(ca.description, ' ', sc.description), ' ', ar.description) description,
              pa.precio,
              inv.qty                                                                   qty_inv,
              sum(dft.qty)                                                    qty,
              (
                SELECT COALESCE(des.porcentaje, 0)
                FROM descuento des
                WHERE des.id_articulo = ar.id_record
                GROUP BY 1
                ORDER BY 1 ASC
                LIMIT 1
              )                      des_articulo,
              (
                SELECT COALESCE(des.porcentaje, 0)
                FROM descuento des
                WHERE des.id_subcategoria = sc.id_record
                GROUP BY 1
                ORDER BY 1 ASC
                LIMIT 1
              )                      des_categoria,
              (
                SELECT COALESCE(pg.porcentaje, 0)
                FROM porcentaje_ganancia pg
                WHERE pg.id_articulo = ar.id_record
                GROUP BY 1
                ORDER BY 1 ASC
                LIMIT 1
              )                      por_articulo,
              (
                SELECT COALESCE(pg.porcentaje, 0)
                FROM porcentaje_ganancia pg
                WHERE pg.id_subcategoria = sc.id_record
                GROUP BY 1
                ORDER BY 1 ASC
                LIMIT 1
              )                      por_categoria

            FROM articulo ar
              INNER JOIN subcategoria sc ON sc.id_record = ar.id_subcategoria
              INNER JOIN categoria ca ON ca.id_record = sc.id_categoria
              INNER JOIN precio_articulo pa ON pa.id_articulo = ar.id_record
              INNER JOIN inventario inv ON inv.id_articulo = ar.id_record
              LEFT JOIN detalle_factura_tmp dft ON dft.id_articulo = ar.id_record
            WHERE ar.active = 1 AND ar.codigo_barra = '" . $params->barcode . "'
            GROUP BY 1, 2, 3,4
          ) a;
        ";
//        print_r($sql);die;
        return $this->query($sql)->objectList();
    }

}
