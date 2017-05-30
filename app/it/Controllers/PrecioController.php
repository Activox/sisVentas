<?php

namespace it\Controllers;

use abstracts\Controller;

class PrecioController extends Controller
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
     * build main table
     */
    public function getPrecio()
    {
        $json = $this->model->getPrecio();

        $html = "";
        $tmp = 0;
        foreach ($json as $key) {
            if ($tmp != $key->id_suplidor) {
                $html .= "<tr class='teal lighten-5'>
                        <td colspan='5' >$key->suplidor</td>
                        </tr>
                        <tr>";
                $tmp = $key->id_suplidor;
                $count = 1;
            }
            $html .= "
                        <td>" . $count++ . "</td>
                        <td>$key->product</td>
                        <td>$key->precio</td>
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
    public function setPrecio()
    {
        $params = new \stdClass();
        $data = \Factory::getInput("data");
        $params->articulo = $data['articulo'];
        $params->suplidor = $data['suplidor'];
        $params->precio = $data['precio'];
        return $this->model->setPrecio($params);
    }

    /**
     *  This function update records
     * @return type
     */
    public function updatePrecio()
    {
        $params = new \stdClass();
        $data = \Factory::getInput("data");
        $params->categoria = $data['categoria'];
        $params->description = $data['description'];
        $params->active = $data['active'];
        $params->id_record = $data['id_record'];
        return $this->model->updatePrecio($params);
    }

    /**
     * This function return the subcategory's
     * @return type
     */
    public function getArticulo2()
    {
        $subcategoriaModel = $this->getModel("it/Articulo");
        echo '{"data": ' . json_encode($subcategoriaModel->getArticulo()) . ' }';
    }

    /**
     * This function return the unidades
     * @return type
     */
    public function getImpuesto2()
    {
        $unidadModel = $this->getModel("it/Itbs");
        echo '{"data": ' . json_encode($unidadModel->getItbs()) . ' }';
    }

    /**
     * This function set the percent by subcategory or product
     * @return mixed
     */
    public function setPorcentaje()
    {
        $params = new \stdClass();
        $data = \Factory::getInput('data');
//        print_r($data);
        switch ($data['option']) {
            case 1:
                $params->id_subcategoria = $data['subcategoria'];
                $params->id_articulo = 0;
                break;
            case 2:
                $params->id_articulo = $data['articulo'];
                $params->id_subcategoria = 0;
                break;
        }
        $params->porcentaje = $data['porcentaje'];

        return $this->getModel('it/Porcentaje')->setPorcentaje($params);

    }

    /**
     *
     */
    public function getPorcentajeBySubcategoria()
    {
        $records = $this->getModel('it/Porcentaje')->getPorcentajeBySubcategoria();
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

    public function getPorcentajeByArticulo()
    {
        $records = $this->getModel('it/Porcentaje')->getPorcentajeByArticulo();
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
}
