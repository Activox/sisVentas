<?php

namespace almacen\Models;

use abstracts\ORM;
use compras\Models\CompraModel;
use compras\Models\SolicitudModel;

//use abstracts\Model;

class InventarioModel extends ORM
{
    private $session = null;

    /**
     *  Init class
     * @param \stdClass $properties
     */
    public function __construct(\stdClass $properties = null)
    {
        parent::__construct($properties);
        $this->table = "inventario";
        $this->primary_key = "id_record";
        $this->value = 0;
        $this->find_by = "";
        $this->alias = "inv";
        $this->session = \Factory::getSession();
    }

    /**
     * This function insert the inventory and movements of items.
     * @param $params
     * @return bool
     */
    public function setInventario($params)
    {
        $result = TRUE;
        $this->begin();
        $compraModel = new CompraModel();
        $id_records = $compraModel->getCompra($params);
        $records = $this->getDetalleSolicitud($id_records[0]->id_record);

        foreach ($records as $key) {
            $this->id_articulo = $key->id_articulo;
            // if the product exist on the inventory this will update the qty
            switch ($key->exist) {
                // Insert
                case 0:
                    if ($result) { // Insert inventory
                        $this->qty = ($key->qty * $key->qty_und);
                        $this->created_by = $this->session->id_record;
                        $this->id_almacen = $params->id_almacen;
                        $id_record = parent::save(false);
                        if ($id_record < 1) {
                            echo "inventario ".$key->id_articulo;
                            $this->rollback('', FALSE);
                            $result = FALSE;
                        } else { // Insert Movements
                            $movimientoModel = new MovimientoModel();
                            $movimientoModel->id_inventario = $id_record;
                            $movimientoModel->qty = ($key->qty * $key->qty_und);
                            $movimientoModel->id_tipo = 26;
                            $movimientoModel->created_by = $this->session->id_record;
                            $id_movimiento = $movimientoModel->saveProp();
                            if ($id_movimiento < 1) {
                                echo "rollback movimiento ".$key->id_articulo;
                                $this->rollback('', FALSE);
                                $result = FALSE;
                                break;
                            } else { // Update Purchases Orders
                                $compraModel = new CompraModel();
                                $compraModel->value = $params->id_compra;
                                $compraModel->status = 25;
                                $id_compra = $compraModel->updateProp();
                                if ($id_compra < 0) {
                                    echo "rollback compra ".$key->id_articulo;
                                    $this->rollback('', FALSE);
                                    $result = FALSE;
                                    break;
                                } else { // Update Requests Orders
                                    $solicitudModel = new SolicitudModel();
                                    $solicitudModel->value = $id_records[0]->id_record;
                                    $solicitudModel->id_tipo = 25;
                                    $id_solicitud = $solicitudModel->updateProp();
                                    if ($id_solicitud < 0) {
                                        echo "rollback solicitud ".$key->id_articulo;
                                        $this->rollback('', FALSE);
                                        $result = FALSE;
                                        break;
                                    }
                                }
                            }
                        }
                    }
                    break;
                // Update
                case 1:
                    if ($result) { // update inventory ...
                        $this->qty = ($key->qty * $key->qty_und) + $key->inv_qty;
                        $this->value = $key->inv_id;
                        $id_record = parent::update(false);
                        if ($id_record < 1) {
                            $this->rollback('', FALSE);
                            $result = FALSE;
                        } else { // insert movements ...
                            $movimientoModel = new MovimientoModel();
                            $movimientoModel->id_inventario = $key->inv_id;
                            $movimientoModel->qty = ($key->qty * $key->qty_und);
                            $movimientoModel->id_tipo = 26;
                            $movimientoModel->created_by = $this->session->id_record;
                            $id_movimiento = $movimientoModel->saveProp();
                            if ($id_movimiento < 1) {
                                $this->rollback('', FALSE);
                                $result = FALSE;
                                break;
                            } else { // update purchases order ...
                                $compraModel->value = $params;
                                $compraModel->status = 25;
                                $id_compra = $compraModel->updateProp();
                                if ($id_compra < 0) {
                                    $this->rollback('', FALSE);
                                    $result = FALSE;
                                    break;
                                } else { // update requests order ...
                                    $solicitudModel = new SolicitudModel();
                                    $solicitudModel->value = $id_records[0]->id_record;
                                    $solicitudModel->id_tipo = 25;
                                    $id_solicitud = $solicitudModel->updateProp();
                                    if ($id_solicitud < 0) {
                                        $this->rollback('', FALSE);
                                        $result = FALSE;
                                        break;
                                    }
                                }
                            }
                        }
                    }
                    break;
            }
        }
        if ($id_record < 1) {
            $this->rollback('', FALSE);
            $result = FALSE;
        } else {
            $this->commit();
        }
        return $result;
    }

    /**
     * $this function get all products of purchase order
     * @param $params
     * @return object
     */
    public function getDetalleSolicitud($params)
    {
        $query = "
        SELECT
          ds.id_articulo,
          sum(ds.qty)               qty,
          CASE WHEN inv.id_record IS NOT NULL
            THEN 1
          ELSE 0 END                exist,
          COALESCE(sum(inv.qty), 0) inv_qty,
          COALESCE(inv.id_record, 0) inv_id,
          un.qty qty_und
        FROM detalle_solicitud ds
          LEFT JOIN inventario inv ON inv.id_articulo = ds.id_articulo
          INNER JOIN unidad un ON un.id_record = ds.id_unidad 
        WHERE ds.id_solicitud = $params
        GROUP BY 1
        ";
        return $this->query($query)->objectList();
    }

    /**
     * This function get the inventory of products.
     * @var integer $params
     * @return object
     */
    public function getInventory($params)
    {
        /** @var integer $params */
        $sql = "
            SELECT
              inv.id_record,
              CONCAT(CONCAT(ca.description, ' ', sc.description), ' ', ar.description) articulo,
              sum(inv.qty)                                                             qty
            FROM inventario inv
              INNER JOIN articulo ar ON ar.id_record = inv.id_articulo AND ar.active = 1
              INNER JOIN subcategoria sc ON sc.id_record = ar.id_subcategoria AND sc.active = 1
              INNER JOIN categoria ca ON ca.id_record = sc.id_categoria AND ca.active = 1
            WHERE inv.active = 1 AND (inv.id_almacen = $params OR  $params = 0 )
            GROUP BY 1,2
            ORDER BY 2
            ";
        return $this->query($sql)->objectList();
    }


}
