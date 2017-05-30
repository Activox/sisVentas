<?php

namespace Facturacion\Models;

use abstracts\ORM;

//use abstracts\Model;

class FacturacionModel extends ORM
{
    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null)
    {
        parent::__construct($properties);
        $this->table = "factura";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "";
        $this->alias = "fat";
        $this->session = \Factory::getSession();
    }

    /**
     * @param \stdClass $params
     * @return arrays
     */
    public function setDetalleTmp($params)
    {
        $detalleTmp = new DetalleFacturaTmpModel();
        $this->begin();
        $detalleTmp->id_articulo = $params->id_record;
        $detalleTmp->id_usuario = $this->session->id_record;
        $detalleTmp->qty = $params->qty;
        $detalleTmp->date = date("Y-m-d");
        $id = $detalleTmp->saveProp();
        if ($id < 1) {
            $this->rollback('', FALSE);
            $result = [];
        } else {
            $this->commit();
            $result = $detalleTmp->getDetalleTmp($params->descuento);
        }
        return $result;
    }

    /**
     * @param $params
     * @return bool
     */
    public function setFactura($params)
    {
        $model = new FacturacionModel();
        $result = TRUE;
        $this->begin();
        $this->id_cliente = $params->cliente;
        $this->descuento = $params->descuento;
        $this->monto = $params->total;
        $this->no_factura = $model->getCurrentId()[0]->id;
        $this->created_by = $this->session->id_record;
        $id_record = parent::save(false);
        if ($id_record < 1) {
            $this->rollback('', FALSE);
            $result = FALSE;
        } else {
            $detalleFactura = new DetalleFacturaModel();
            $detalleTmp = new DetalleFacturaTmpModel();
            $records = $detalleTmp->getDetalleTmp($params->descuento);
            foreach ($records as $key) {
                $detalleFactura->id_factura = $id_record;
                $detalleFactura->id_articulo = $key->id_articulo;
                $detalleFactura->created_by = $this->session->id_record;
                $detalleFactura->precio = $key->precio;
                $detalleFactura->qty = $key->qty;
                $id_detalle = $detalleFactura->saveProp();
                if ($id_detalle < 1) {
                    $this->rollback('', FALSE);
                    $result = FALSE;
                    break;
                }
            }
        }
        $resul = $detalleTmp->deleteProp();
        if (!$resul) {
            $result = FALSE;
            $this->rollback('', FALSE);
        } else {
            $this->commit();
            $result = getNoFactura($id_record)[0]->no_factura;
        }
        return $result;
    }

    /**
     * This function get the current id to insert
     * @return object
     */
    public function getCurrentId()
    {
        $this->param1 = "COALESCE(max(fat.id_record) +1,1) id";
        return $this->get()->objectList();
    }

    public function getNoFactura($id)
    {
        $sql = "
        SELECT fac.no_factura
        FROM factura fac
        where fac.id_record = $id
        ";
        return $this->query($sql)->objectList();
    }

    public function getVenta()
    {
        $sql = "
        SELECT
          
          a.description,
          a.qty,
          a.precio                                                                  compra,
          a.monto,
           a.precio_venta venta,
          a.precio_venta- a.precio ganancia
        FROM (
               SELECT       
                 df.id_articulo,
                 CONCAT(CONCAT(ca.description, ' ', sc.description), ' ', ar.description) description,
                 sum(df.qty)                                                    qty,
                 df.precio precio_venta,
                 fac.monto,
                 pa.precio
               FROM factura fac
                 INNER JOIN detalle_factura df ON df.id_factura = fac.id_record
                 INNER JOIN articulo ar ON ar.id_record = df.id_articulo
                 INNER JOIN subcategoria sc ON sc.id_record = ar.id_subcategoria
                 INNER JOIN categoria ca ON ca.id_record = sc.id_categoria
                 INNER JOIN precio_articulo pa ON pa.id_articulo = ar.id_record
                 WHERE fac.active = 1
                 GROUP BY 1,2,4,5,6
                 ORDER BY 2
             ) a
        ";
        return $this->query($sql)->objectList();
    }

    /**
     * @param $id
     * @return object
     */
    public function printFactura($id)
    {
        $sql = "
        SELECT
          'Debito'                                                                    tipo_pago,
          CONCAT(CONCAT(cat.description, ' ', subc.description), ' ', ar.description) articulo,
          df.qty,
          (df.qty * df.precio)                                                        precio
        FROM factura fac
          INNER JOIN detalle_factura df ON df.id_factura = fac.id_record
          INNER JOIN articulo ar ON ar.id_record = df.id_articulo
          INNER JOIN subcategoria subc ON subc.id_record = ar.id_subcategoria
          INNER JOIN categoria cat ON cat.id_record = subc.id_categoria
        WHERE fac.no_factura = $id
        GROUP BY 1, 2, 3, 4
        ";
        return $this->query($sql)->objectList();
    }
}
