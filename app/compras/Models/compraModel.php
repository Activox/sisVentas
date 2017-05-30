<?php

namespace compras\Models;

use abstracts\ORM;

//use abstracts\Model;

class CompraModel extends ORM
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
        $this->alias = "cr";
        $this->session = \Factory::getSession();
    }

    /**
     * @param $params
     * @return bool
     */
    public function setCompra($params)
    {
        $result = TRUE;
        $this->begin();
        switch ($params->option) {
            case 1:
                $this->id_solicitud = $params->id;
                $this->status = 2;
                $this->tipo_pago = $params->tipo;
                $this->requisition_date = $params->date;
                $this->created_by = $this->session->id_record;
                $id_record = parent::save();
                break;
            case 2:
                $this->status = 24;
                $this->value = $params->id_compra;
                $id_record = parent::update();
                break;
            default:
                $this->status = 3;
                $this->no_factura = $params->factura;
                $this->value = $params->id_compra;
                $id_record = parent::update();
                break;
        }
        if ($id_record < 1) {
            $result = FALSE;
            $this->rollback("", FALSE);
        } else {
            $this->commit();
        }
        return $result;
    }

    /**
     * @param $params
     * @return object
     */
    public function getCompra($params)
    {
        $query = "
        SELECT
          sc.id_record,
          COALESCE(co.id_record, 0)                                   id_compra,
          sc.id_suplidor,
          co.no_factura,
          concat(ter.nombre, ' ', per.apellidos)                       suplidor,
          sum(ds.qty)                                                 qty,
          un.short                                              unidad,
          round(sum(ds.qty) * (pa.precio ), 2) sub_total,
          un.qty                                                      qty_und,
          ti.description                                              status
        FROM solicitud_compra sc
          INNER JOIN detalle_solicitud ds ON ds.id_solicitud = sc.id_record
          INNER JOIN articulo ar ON ar.id_record = ds.id_articulo
          INNER JOIN precio_articulo pa ON pa.id_articulo = ar.id_record
          INNER JOIN unidad un ON un.id_record = ds.id_unidad
          INNER JOIN almacen al ON al.id_record = sc.id_almacen
          INNER JOIN tipo ti ON ti.id_record = sc.id_tipo AND ti.tipo = 'status'
          INNER JOIN suplidor su ON su.id_record = sc.id_suplidor
          INNER JOIN persona per ON per.id_record = su.id_persona
          INNER JOIN tercero ter ON ter.id_record = per.id_tercero
          INNER JOIN compra co ON co.id_solicitud = sc.id_record
        WHERE sc.active = 1 AND sc.id_almacen = $params->id_almacen AND co.status = 3 AND (co.id_record = $params->id_compra OR $params->id_compra = 0)
        GROUP BY 1";
        return $this->query($query)->objectList();
    }

    /**
     * This function update records.
     * @return int
     */
    public function updateProp()
    {
        return parent::update();
    }

    public function getDetalleOrder($id){
        $sql="
       SELECT
          em.nombre                                                                   empresa,
          CONCAT(ter.nombre, ' ', per.apellidos)                                      persona,
          ter.email,
          tip.description                                                             tipo_pago,
          CONCAT(CONCAT(cat.description, ' ', subc.description), ' ', ar.description) articulo,
          un.short                                                              unidad,
          ds.qty,
          (ds.qty * pa.precio)                                                        precio
        FROM compra ca
          INNER JOIN solicitud_compra sc ON sc.id_record = ca.id_solicitud
          INNER JOIN detalle_solicitud ds ON ds.id_solicitud = sc.id_record
          INNER JOIN articulo ar ON ar.id_record = ds.id_articulo
          INNER JOIN subcategoria subc ON subc.id_record = ar.id_subcategoria
          INNER JOIN categoria cat ON cat.id_record = subc.id_categoria
          INNER JOIN precio_articulo pa ON pa.id_articulo = ar.id_record
          INNER JOIN unidad un ON un.id_record = ds.id_unidad
          INNER JOIN suplidor sup ON sup.id_record = sc.id_suplidor
          INNER JOIN persona per ON per.id_record = sup.id_persona
          INNER JOIN tercero ter ON ter.id_record = per.id_tercero
          INNER JOIN (SELECT
                        emp.id_record,
                        ter2.nombre
                      FROM empresa emp INNER JOIN tercero ter2 ON ter2.id_record = emp.id_tercero) em
            ON em.id_record = sup.id_empresa
          INNER JOIN tipo tip ON tip.id_record = ca.tipo_pago
        WHERE ca.id_solicitud = $id
        GROUP BY 1, 2, 3, 4, 5, 6,7
        ";
        return $this->query($sql)->objectList();
    }
}
