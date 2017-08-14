<?php
/**
 * Created by PhpStorm.
 * User: paul9
 * Date: 8/6/2017
 * Time: 1:57 AM
 */

namespace Facturacion\Models;

use abstracts\ORM;

class CxpModel extends ORM
{
    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null)
    {
        parent::__construct($properties);
        $this->table = "cuenta_por_pagar";
        $this->primary_key = "id_recird";
        $this->value = 0;
        $this->find_by = "";
        $this->alias = "cxp";
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

    /**
     * this function update records
     * @param \stdClass $params
     * @return boolean
     */
    public function updateProp()
    {
        $id_record = parent::update();
        return $id_record;
    }

    /**
     * @param $params
     * @return object
     */
    public function getCxp($params)
    {
        $condition = $params->id_suplidor > 0 ? " AND sc.id_suplidor = " . $params->id_suplidor : "";
        $condition .= $params->id_almacen > 0 ? " AND sc.id_almacen = " . $params->id_almacen : "";
        $condition .= $params->from != "" ? " AND CAST(cxp.created_on as date) BETWEEN '" . date_format(date_create($params->from), 'Y-m-d') . "' AND '" . ($params->to != "" ? date_format(date_create($params->to), 'Y-m-d') : date_format(date_create($params->from), 'Y-m-d')) . "' " : "";
        $condition .= $params->estado == 0 ? " " : ($params->estado != 1 ? " AND cxp.id_tipo in ($params->estado)" : " AND cxp.id_tipo not in (33)");
        $sql = "
        SELECT
          com.id_solicitud,
          sup.id_record id_suplidor,
          cxp.id_recird,
          concat(ter.nombre, ' ', per.apellidos)  suplidor,
          CONCAT(UCASE(LEFT(tip.description, 1)),
                 SUBSTRING(tip.description, 2))   status,
          com.no_factura,
          uni.qty * sum(ds.qty)                   qty,
           sum(pa.precio)                          monto,
           (
            SELECT COALESCE(sum(mc.monto),0)
              FROM movimiento_cuenta mc
            WHERE mc.id_cuenta = cxp.id_recird
          )                                       pagado,
          DATE_FORMAT(cxp.created_on, '%d/%m/%Y') created_on
        FROM cuenta_por_pagar cxp
          INNER JOIN compra com ON com.id_record = cxp.id_compra
          INNER JOIN solicitud_compra sc ON sc.id_record = com.id_solicitud AND sc.id_tipo = 3
          INNER JOIN detalle_solicitud ds ON ds.id_solicitud = sc.id_record
          INNER JOIN unidad uni ON uni.id_record = ds.id_unidad
          INNER JOIN suplidor sup ON sup.id_record = sc.id_suplidor
          INNER JOIN persona per ON per.id_record = sup.id_persona
          INNER JOIN tercero ter ON ter.id_record = per.id_tercero
          INNER JOIN tipo tip ON tip.id_record = cxp.id_tipo
           INNER JOIN precio_articulo pa ON pa.id_suplidor = sc.id_suplidor AND pa.id_articulo = ds.id_articulo
        WHERE cxp.active = 1 AND com.tipo_pago = 21  $condition
        GROUP BY 1, 2, 3
        ORDER BY cxp.created_on DESC 
        ";
//        echo $sql;die;
        return $this->query($sql)->objectList();
    }
}