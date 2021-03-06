<?php

namespace interfaces;

interface Controlling
{
    /**
     * main model
     * @param Moduling $module
     */
    function __construct( Moduling $model );       
    /**
     * render view
     */
    public function display();
    /**
     * header layout
     */
    public function header();
    /**
     * footer layout
     */
    public function footer();
    /*
     * set view
     */
    public function setView( $view );
}

?>

