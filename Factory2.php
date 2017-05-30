<?php

use lib\Config;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * 
 */
class Factory {

    /**
     *
     * @var object reference application
     */
    private static $_application = null;

    /**
     *
     * @var stdClass session variables
     */
    private static $_session = null;

    /**
     *
     * @var array
     */
    private static $_parameters = null;

    /**
     * set application controller
     * @param string $app give 'Module/Reference'
     */
    public static function set($app) {
        $clearNS = str_replace("\\", "/", $app);
        $split = explode("/", $clearNS);
        $application = $app;
        //control just module + reference
        if (count($split) == 2) {
            $application = Config::$_MODULES_ . '\\' . $split[0] . '\\Controllers\\' . $split[1] . 'Controller';
        }

        self::$_application = new $application();
    }

    /**
     * 
     * @return object get reference application
     */
    public static function get() {
        return self::$_application;
    }

    /**
     * define object by session variables
     */
    public static function setSession() {

        self::$_session = new stdClass();

        if (isset($_SESSION)) {
            foreach ($_SESSION as $key => $value) {
                self::$_session->$key = $value;
            }
        }
    }

    /**
     * 
     * @return stdClass get session var by key
     */
    public static function getSession() {

        return self::$_session;
    }

    /**
     * verify if request variable was defined
     * @param string $name
     * @return boolean
     */
    private static function isRequest($name) {
        if (isset($_REQUEST[$name])) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * get Variable Request
     * @param string $name
     * @return mixed
     */
    public static function getInput($name) {

        $validRequest = self::isRequest($name);

        if ($validRequest) {
            return $_REQUEST[$name];
        }

        return NULL;
    }

    /**
     * redirect into application
     */
    public static function redirectTo() {
        return _HOST_ . _DIRECTORY_ . _DS_;
    }

    /**
     * scape html
     * @param string $escapestring
     * @param flag $flags
     * @param string $charset
     * @param boolean $double_encode
     * @return string
     */
    public static function escapeHtml($escapestring, $flags = ENT_QUOTES, $charset = 'UTF-8', $double_encode = TRUE) {

        return htmlentities($escapestring, $flags, $charset, $double_encode);
    }

    /**
     * log error file
     * @param string $error
     */
    public static function loggerError($error) {

        $path_log = _BASE_ . _DS_ . Config::$_LOGS . _DS_ . 'error_' . date("d_m_Y") . '.text';

        $log = new Logger("test");

        $log->pushHandler(new StreamHandler($path_log, Logger::DEBUG));

        $log->addInfo($error);
    }

    /**
     * 
     * @param array $params set parameters from view
     */
    public static function setParametersView($params) {
        self::$_parameters = $params;
    }

    /**
     * 
     * @return array get parameters from view
     */
    public static function getParametersView() {
        return self::$_parameters;
    }

    /**
     * render another view from view
     * @param string $url url defined
     * @param array $params
     * @return string
     */
    public static function renderView($url, $params = array()) {

        self::setParametersView($params, FALSE);

        return Route::_get($url);
    }

}
