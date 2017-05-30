<?php

namespace Defaults\Controllers;

use abstracts\Controller;

class DefaultController extends Controller
{

    /**
     * execute parent contruct..
     */
    public function __construct()
    {
        parent::__construct($this);
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
     * Validar Usuario y Contraseña, setiar session.
     * @param string $user , $password
     * @return string
     */
    public function validatedUser()
    {
        $condition = 0;
        $params = new \stdClass();
        $data = \Factory::getInput("data");
        $params->username = $data['username'];
        $params->clave = $data['clave'];
        if ($params->username == 'pventa' && $params->clave == 'pventa') {
            $_SESSION['username'] = 'Administrador';
            $_SESSION['name'] = "Administrador";
            $_SESSION['email'] = "pventas@ventas.com";
            $_SESSION['id_record'] = 1;
            \Factory::setSession();
            $this->getModel()->firstInsert();
            $condition = 1;
        } else {
            $params->clave = md5($params->clave);
            $result = $this->getModel()->getUser($params);
            if (count($result) > 0) {
                $_SESSION['username'] = $result[0]->username;
                $_SESSION['name'] = $result[0]->nombre;
                $_SESSION['email'] = $result[0]->email;
                $_SESSION['id_record'] = $result[0]->id_record;
                \Factory::setSession();
                $condition = 1;
            }
        }
        return $condition;
    }

    /**
     *
     */
    public function test()
    {
        print_r($_POST);
    }

}
