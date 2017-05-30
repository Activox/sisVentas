<?php

namespace it\Controllers;

use abstracts\Controller;

class ArticuloController extends Controller {

    private $model = null;
    private $input = null;

    /**
     * execute parent contruct..
     */
    public function __construct() {
        parent::__construct($this);
        $this->model = $this->getModel();
    }

    /**
     * 
     * @param string $view
     * @return string
     */
    public function display($view = '', array $params = array()) {

        /**
         * set params to view
         */
        \Factory::setParametersView($params);

        /**
         * write all content HTML
         */
        $define_view_here = '';

        /**
         * render view
         */
        $render = $view;

        if (empty($define_view_here)) {
            $render .= ".php";
        } else {
            $render = $define_view_here;
        }

        return $render;
    }

    /**
     * get Model from references
     * @param string $model
     * @param stdClass $properties
     * @return object model
     */
    public function getModel($model = '', $properties = null) {
        return parent::getModel($model, $properties);
    }

    /**
     * build main table
     */
    public function getArticulo() {
        $json = $this->model->getArticulo();

        $html = "";
        foreach ($json as $key) {
            $record = $this->getModel("it/Suplidor")->getSuplidorById($key->id_suplidor);
            $html .= "<tr>
                        <td>$key->id_record</td>
                        <td>$key->categoria</td>
                        <td>$key->sub_categoria</td>
                        <td>$key->product</td>
                        <td>$key->codigo_barra</td>
                        <td>" . $record[0]->nombre . " " . $record[0]->apellidos . "</td>
                        <td>$key->active</td>";
            $html .= '<td data-id="' . $key->id_record . '" data-descripcion="' . $key->description . '" data-active="' . $key->active . '" 
                            style="cursor:pointer" class="edit tooltip">  <span class="tooltiptext">Update Record</span>
                            <i class="material-icons teal-text">edit</i></td>';
            $html .= "</tr>";
        }
        return $html;
    }

    /**
     *  This function insert records
     * @return type
     */
    public function setArticulo() {
        $params = new \stdClass();
        $data = \Factory::getInput("data");
        $params->subcategoria = $data['subcategoria'];
        $params->description = $data['description'];
        $params->suplidor = $data['suplidor'];
        $params->codigobarra = $data['codigobarra'];
        return $this->model->setArticulo($params);
    }

    /**
     *  This function update records
     * @return type
     */
    public function updateArticulo() {
        $params = new \stdClass();
        $data = \Factory::getInput("data");
        $params->categoria = $data['categoria'];
        $params->description = $data['description'];
        $params->active = $data['active'];
        $params->id_record = $data['id_record'];
        return $this->model->updateArticulo($params);
    }

    /**
     * This function return the subcategory's
     * @return type
     */
    public function getSubCategoria() {
        $subcategoriaModel = $this->getModel("it/Subcategoria");
        $data = \Factory::getInput("id");
        echo '{"data": ' . json_encode($subcategoriaModel->getSubcategoriaByCategoria($data)) . ' }';
    }

    /**
     * This function return the unidades
     * @return type
     */
    public function getUnidad() {
        $unidadModel = $this->getModel("it/unidad");
        echo '{"data": ' . json_encode($unidadModel->getUnidad()) . ' }';
    }

    public function getSuplidor2() {
        $record = $this->getModel("it/Suplidor");
        echo '{"data": ' . json_encode($record->getSuplidor()) . ' }';
    }

}
