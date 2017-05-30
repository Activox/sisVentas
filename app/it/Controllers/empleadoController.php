<?php

namespace it\Controllers;

use abstracts\Controller;

class EmpleadoController extends Controller {

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
     * 
     */
    public function getEmpleado() {
        $json = $this->model->getEmpleado();
        $html = "";
        foreach ($json as $key) {
            $direccion = $this->getModel('it/Direccion')->getDireccionPersona($key->id_record);
            $html .= "<tr>
                        <td>$key->id_empleado</td>
                        <td>$key->nombre $key->apellidos</td>
                        <td>$key->email</td>
                        <td>$key->cedula</td>
                        <td>$key->telefono</td>
                        <td>$key->sexo</td>
                        <td>" . $direccion[0]->direccion . "</td>
                        <td>$key->birthdate</td>                        
                        <td>$key->admission_date</td>
                        <td>$key->estado_civil</td>
                        <td>$key->tipo</td>
                        <td>$key->active</td>
                        <td data-id='$key->id_record' style='cursor:pointer;'><i class='material-icons teal-text'>edit</i></td>
                    </tr>";
        }
        return $html;
    }

    /**
     *  This function insert records
     * @return type
     */
    public function setEmpleado() {
        $params = new \stdClass();
        $data = \Factory::getInput("data");
        $params->name = $data['name'];
        $params->last_name = $data['last_name'];
        $params->cedula = $data['cedula'];
        $params->sexo = $data['sexo'];
        $params->email = $data['email'];
        $params->phone = $data['phone'];
        $params->admission_date = $data['admission_date'];
        $params->estado_civil = $data['estado_civil'];
        $params->date = $data['date'];
        $params->nacionalidad = $data['nacionalidad'];
        $params->sector = $data['sector'];
        $params->tipo = $data['tipo'];
        $params->direccion = $data['direccion'];
        return $this->model->setEmpleado($params);
    }

    /**
     * get the pais list
     */
    public function getPais() {
        $result = $this->getModel('it/Pais');
        echo '{"data": ' . json_encode($result->getPais()) . ' }';
    }

    /**
     * get the nacionalidad list
     */
    public function getNacionalidad() {
        $result = $this->getModel('it/Nacionalidad');
        echo '{"data": ' . json_encode($result->getNacionalidad()) . ' }';
    }

    /**
     *  get the ciudad list
     */
    public function getCiudadByPais() {
        $result = $this->getModel('it/Ciudad');
        $id_pais = \Factory::getInput("id");
        echo '{"data": ' . json_encode($result->getCiudadByPais($id_pais)) . ' }';
    }

    /**
     * get the sector list
     */
    public function getSectorByCiudad() {
        $result = $this->getModel('it/Sector');
        $id_ciudad = \Factory::getInput("id");
        echo '{"data": ' . json_encode($result->getSectorByCiudad($id_ciudad)) . ' }';
    }

    /**
     * Get the type list
     */
    public function getDescriptionByTipo() {
        $result = $this->getModel('it/Tipo');
        $tipo = \Factory::getInput("id");
        echo '{"data": ' . json_encode($result->getDescriptionByTipo($tipo)) . ' }';
    }

}
