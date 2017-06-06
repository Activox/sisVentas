<?php

namespace it\Controllers;

use abstracts\Controller;

class AppController extends Controller
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
    public function getAppTable()
    {
        $json = $this->model->getApp();
        $html = "";
        foreach ($json as $key) {
            $html .= "<tr class='center-align' >
                        <td>$key->id_record</td>
                        <td>$key->description</td>
                        <td>$key->icon</td>
                        <td>$key->url</td>
                        <td>$key->father</td>
                        <td>$key->tipo</td>
                        <td>$key->active</td>";
            $html .= '<td data-id="' . $key->id_record . '" style="cursor:pointer" class="edit"> 
                    <i class="mdi-editor-border-color blue-grey-text"></i></td>';
            $html .= "</tr>";
        }
        return $html;
    }

    /**
     * get all app
     */
    public function getApp(){
        echo '{"data": ' . json_encode($this->model->getAppDescription()) . ' }';
    }

    /**
     * This function return the app information filter by app_id
     */
    public function getAppById()
    {
        $data = \Factory::getInput("id");
        echo '{"data": ' . json_encode($this->model->getAppById($data)) . ' }';
    }

    /**
     *  This function insert records
     * @return type
     */
    public function setApp()
    {
        $params = new \stdClass();
        $data = \Factory::getInput("data");
        $params->description = $data['description'];
        $params->icon = $data['icon'];
        $params->url = $data['url'];
        $params->id_father = $data['id_father'];
        $params->id_tipo = $data['id_tipo'];
        return $this->model->setApp($params);
    }

    /**
     *  This function update records
     * @return type
     */
    public function updateApp()
    {
        $params = new \stdClass();
        $data = \Factory::getInput("data");
        $params->description = $data['description'];
        $params->icon = $data['icon'];
        $params->url = $data['url'];
        $params->id_father = $data['id_father'];
        $params->id_tipo = $data['id_tipo'];
        $params->active = $data['active'];
        $params->id_record = $data['id_record'];
        return $this->model->updateApp($params);
    }

}
