<?php

namespace it\Controllers;

use abstracts\Controller;

class DescuentoController extends Controller
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
     * This function set the percent by subcategory or product
     * @return mixed
     */
    public function setDescuento()
    {
        $params = new \stdClass();
        $data = \Factory::getInput('data');
//        print_r($data);
        $params->porcentaje = $data['porcentaje'];
        switch ($data['option']) {
            case 1:
                $params->id_subcategoria = $data['subcategoria'];
                $params->id_articulo = 0;
                $result = $this->model->setDescuento($params);
                break;
            case 2:
                $params->id_articulo = $data['articulo'];
                $params->id_subcategoria = 0;
                $result = $this->model->setDescuento($params);
                break;
            case 3:
                $params->id_tipo = $data['tipo'];
                $result = $this->getModel('it/TipoDescuento')->setTipoDescuento($params);
                break;
        }


        return $result;

    }

    /**
     *
     */
    public function getDescuentoBySubcategoria()
    {
        $records = $this->model->getDescuentoBySubcategoria();
        $html = "";
        $count = 1;
        foreach ($records as $key) {
            $html .= "<tr>
                        <td>" . $count++ . "</td>
                        <td>$key->subcategoria</td>
                        <td>$key->porcentaje</td>
                        <td>$key->active</td>";
            $html .= '<td data-id="' . $key->id_record . '" data-descripcion="' . $key->description . '" data-active="' . $key->active . '" 
                            style="cursor:pointer" class="edit tooltip">  <span class="tooltiptext">Update Record</span>
                            <i class="material-icons teal-text">edit</i></td>';
            $html .= " </tr>";
        }
        echo $html;
    }

    public function getDescuentoByArticulo()
    {
        $records = $this->model->getDescuentoByArticulo();
        $html = "";
        $count = 1;
        foreach ($records as $key) {
            $html .= "<tr>
                        <td>" . $count++ . "</td>
                        <td>$key->articulo</td>
                        <td>$key->porcentaje</td>
                        <td>$key->active</td>";
            $html .= '<td data-id="' . $key->id_record . '"data-active="' . $key->active . '" 
                            style="cursor:pointer" class="edit tooltip">  <span class="tooltiptext">Update Record</span>
                            <i class="material-icons teal-text">edit</i></td>';
            $html .= " </tr>";
        }
        echo $html;
    }

    public function getDescuentoByTipo()
    {
        $records = $this->model->getDescuentoByTipo();
        $html = "";
        $count = 1;
        foreach ($records as $key) {
            $html .= "<tr>
                        <td>" . $count++ . "</td>
                        <td>$key->tipo</td>
                        <td>$key->porcentaje</td>
                        <td>$key->active</td>";
            $html .= '<td data-id="' . $key->id_record . '"data-active="' . $key->active . '" 
                            style="cursor:pointer" class="edit tooltip">  <span class="tooltiptext">Update Record</span>
                            <i class="material-icons teal-text">edit</i></td>';
            $html .= " </tr>";
        }
        echo $html;
    }
}
