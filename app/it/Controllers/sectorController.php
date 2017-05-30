<?php

namespace it\Controllers;

use abstracts\Controller;

class SectorController extends Controller {

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
    public function getSector() {
        $json = $this->model->getSector();
        $html = "";
        foreach ($json as $key) {
            $html .= "<tr>
                                    <td>$key->id_record</td>
                                    <td>$key->ciudad</td>
                                    <td>$key->description</td>
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
    public function setSector() {
        $params = new \stdClass();
        $data = \Factory::getInput("data");
        $params->ciudad = $data['ciudad'];
        $params->description = $data['description'];
        return $this->model->setSector($params);
    }

    public function getCiudad() {
        $result = $this->getModel('it/ciudad');
        echo '{"data": ' . json_encode($result->getCiudad()) . ' }';
    }

}
