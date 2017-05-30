<?php

namespace it\Controllers;

use abstracts\Controller;

class CategoriaController extends Controller {

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
    public function getCategoria() {
        $json = $this->model->getCategoria();

        $html = "";
        foreach ($json as $key) {
            $html .= "<tr>
                        <td>$key->id_record</td>
                        <td>$key->description</td>
                        <td>$key->active</td>";
            $html.='<td data-id="' . $key->id_record . '" data-descripcion="' . $key->description . '" data-active="' . $key->active . '" 
                            style="cursor:pointer" class="edit tooltip">  <span class="tooltiptext">Update Record</span>
                            <i class="material-icons teal-text">edit</i></td>';
            $html.="</tr>";
        }
        
        return $html;
    }

    /**
     *  This function insert records
     * @return type
     */
    public function setCategoria() {
        $params = new \stdClass();
        $data = \Factory::getInput("data");
        $params->tipo = $data['tipo'];
        $params->description = $data['description'];
        return $this->model->setCategoria($params);
    }
    /**
     *  This function update records
     * @return type
     */
    public function updateCategoria() {
        $params = new \stdClass();
        $data = \Factory::getInput("data");
        $params->tipo = $data['tipo'];
        $params->description = $data['description'];
        $params->active = $data['active'];
        $params->id_record = $data['id_record'];
        return $this->model->updateCategoria($params);
    }

}
