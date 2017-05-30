<?php

namespace it\Controllers;

use abstracts\Controller;

class AlmacenController extends Controller {

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
    public function getAlmacen() {
        $json = $this->model->getAlmacen();

        $html = "";
        foreach ($json as $key) {
            $direccion = $this->getModel('it/Direccion')->getDireccionPersona($key->id_tercero);
            $empleado = $this->getModel('it/Empleado')->getEmpleadoById($key->id_empleado);
            $tercero = $this->getModel('it/Tercero')->getTerceroById($key->id_tercero);
            $html .= "<tr>
                        <td>$key->id_record</td>
                        <td>" . $tercero[0]->nombre . "</td>
                        <td>" . $empleado[0]->nombre . " " . $empleado[0]->apellidos . "</td>
                         <td>" . $direccion[0]->direccion . "</td>
                        <td>$key->active</td>";
            $html .= '<td data-id="' . $key->id_record . '"
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
    public function setAlmacen() {
        $params = new \stdClass();
        $data = \Factory::getInput("data");
        $params->almacen = $data['almacen'];
        $params->empleado = $data['empleado'];
        $params->description = $data['description'];
        $params->sector = $data['sector'];
        return $this->model->setAlmacen($params);
    }

    /**
     *  This function update records
     * @return type
     */
    public function updateAlmacen() {
        $params = new \stdClass();
        $data = \Factory::getInput("data");
        $params->categoria = $data['categoria'];
        $params->description = $data['description'];
        $params->active = $data['active'];
        $params->id_record = $data['id_record'];
        return $this->model->updateAlmacen($params);
    }

}
