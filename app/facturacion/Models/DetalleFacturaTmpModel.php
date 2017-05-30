<?php

namespace Facturacion\Models;

use abstracts\ORM;

//use abstracts\Model;

class DetalleFacturaTmpModel extends ORM
{
    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null)
    {
        parent::__construct($properties);
        $this->table = "detalle_factura_tmp";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "";
        $this->alias = "dft";
        $this->session = \Factory::getSession();
    }

    /**
     * @return int
     */
    public function saveProp()
    {
        return parent::save();

    }

    public function getDetalleTmp($id)
    {
        $sql = "
   SELECT 
          a.id_articulo,
          a.description,
          a.inv_qty,
          a.qty,
          a.precio + ((a.precio * COALESCE(a.por_articulo/100,a.por_categoria/100)) - ((precio * COALESCE(a.por_articulo/100,a.por_categoria/100)) * COALESCE(a.des_articulo/100,a.des_categoria/100)) - ((a.precio * COALESCE(a.por_articulo/100,a.por_categoria/100))*COALESCE(a.tipo_descuento/100,0))) precio,
          ((a.precio * COALESCE(a.por_articulo/100,a.por_categoria/100))*COALESCE(a.tipo_descuento/100,0)) * 100 descuento
    FROM (
           SELECT
           dft.id_articulo,
             CONCAT(CONCAT(ca.description, ' ', sc.description), ' ', ar.description) description,
             inv.qty                inv_qty,
             sum(dft.qty) qty,
             pa.precio ,
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
             )                      por_categoria,
             (
             SELECT td.porcentaje
             FROM tipo_descuento td
             WHERE td.id_record = $id
             ) tipo_descuento
           FROM detalle_factura_tmp dft
             INNER JOIN articulo ar ON ar.id_record = dft.id_articulo
             INNER JOIN subcategoria sc ON sc.id_record = ar.id_subcategoria
             INNER JOIN categoria ca ON ca.id_record = sc.id_categoria
             INNER JOIN inventario inv ON inv.id_articulo = ar.id_record
             INNER JOIN precio_articulo pa ON pa.id_articulo = ar.id_record
            WHERE dft.id_usuario = " . $this->session->id_record . "
           GROUP BY 1, 2,3,5
        ) a
      GROUP BY 1,2,3,5
        ";
        return $this->query($sql)->objectList();
    }

    public function gerRecord()
    {
        $sql = "SELECT id_record FROM detalle_factura_tmp dft WHERE dft.id_usuario = " . $this->session->id_record;
        return $this->query($sql)->objectList();
    }

    /**
     * @return bool
     */
    public function deleteProp()
    {
        $result = TRUE;
        $records = $this->gerRecord();
        foreach ($records as $key) {
            $this->value = $key->id_record;
            $id_record = parent::delete();
            if ($id_record == 0) {
                $result = FALSE;
                break;
            }
        }
        return $result;
    }


}
