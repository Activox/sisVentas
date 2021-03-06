<?php

namespace it\Controllers;

use abstracts\Controller;

class EmpresaController extends Controller {

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
    public function getEmpresa() {
        $json = $this->model->getEmpresa();

        $html = "";
        foreach ($json as $key) {
            $html .= "<tr>
                        <td>$key->id_record</td>
                        <td>$key->nombre</td>
                        <td>$key->email</td>
                        <td>$key->telefono</td>
                        <td>$key->rnc</td>
                        <td>$key->tipo</td>
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
    public function setEmpresa() {
        $params = new \stdClass();
        $data = \Factory::getInput("data");
        $params->name = $data['name'];
        $params->nacionalidad = $data['nacionalidad'];
        $params->email = $data['email'];
        $params->telefono = $data['telefono'];
        $params->tipo = $data['tipo'];
        $params->rnc = $data['rnc'];
        return $this->model->setEmpresa($params);
    }

    /**
     *  This function update records
     * @return type
     */
    public function updateEmpresa() {
        $params = new \stdClass();
        $data = \Factory::getInput("data");
        $params->name = $data['name'];
        $params->nacionalidad = $data['nacionalidad'];
        $params->email = $data['email'];
        $params->tipo = $data['tipo'];
        $params->rnc = $data['rnc'];
        $params->active = $data['active'];
        $params->id_record = $data['id_record'];
        return $this->model->updateEmpresa($params);
    }

}
