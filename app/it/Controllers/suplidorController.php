<?php

namespace it\Controllers;

use abstracts\Controller;

class SuplidorController extends Controller
{

    private $model = null;
    private $input = null;

    /**
     * execute parent contruct..
     */
    public function __construct()
    {
        parent::__construct($this);
        $this->model = $this->getModel();
    }

    /**
     *
     * @param string $view
     * @return string
     */
    public function display($view = '', array $params = array())
    {

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
    public function getModel($model = '', $properties = null)
    {
        return parent::getModel($model, $properties);
    }

    /**
     *
     */
    public function getSuplidor()
    {
        $id = \Factory::getInput("id");
        $html = "";
        if (isset($id)) {
            $direccion = $this->getModel('it/Direccion')->getDireccionPersona($id);
            $result = $this->model->getSuplidor($id);
            foreach ($result as $key) {
                $html =
                    "
                     <div class=\"col m6 container \">
                        <p><b>Nombre Completo:</b> $key->description</p>
                        <p><b>Email:</b> $key->email</p>
                        <p><b>Direccion:</b> " . $direccion[0]->direccion . " </p>
                        <p><b>Fecha de Nacimiento:</b> $key->birthdate</p>
                    </div>
                    <div class=\"col m6 container\">
                        <p><b>Cedula:</b> $key->cedula</p>
                        <p><b>Telefono:</b> $key->telefono</p>
                        <p><b>Sexo:</b> $key->sexo</p>
                        <p><b>Tipo de Cliente:</b> $key->tipo</p>
                    </div>
                ";
            }
        } else {
            $json = $this->model->getSuplidor(0);
            foreach ($json as $key) {
                $html .= "<tr>
                        <td>$key->id_record</td>
                        <td>$key->description</td>
                        <td>$key->email</td>
                        <td>$key->cedula</td>
                        <td>$key->telefono</td>                        
                        <td>$key->active</td>
                       <td >
                            <i class='material-icons teal-text edit' data-id='$key->id_tercero' style='cursor:pointer;' >edit</i>
                            <i class='material-icons cyan-text info' data-id='$key->id_tercero' style='cursor:pointer;' >info</i>
                        </td>
                    </tr>";
            }
        }
        return $html;
    }

    /**
     *  This function insert records
     * @return type
     */
    public function setSuplidor()
    {
        $params = new \stdClass();
        $data = \Factory::getInput("data");
        $params->name = $data['name'];
        $params->last_name = $data['last_name'];
        $params->cedula = $data['cedula'];
        $params->sexo = $data['sexo'];
        $params->email = $data['email'];
        $params->phone = $data['phone'];
        $params->empresa = $data['empresa'];
        $params->date = $data['date'];
        $params->nacionalidad = $data['nacionalidad'];
        $params->sector = $data['sector'];
        $params->tipo = $data['tipo'];
        $params->direccion = $data['direccion'];
//         print_r($params); die;
        return $this->model->setSuplidor($params);
    }
}
