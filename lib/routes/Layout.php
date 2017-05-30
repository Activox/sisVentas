<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace lib\routes;

/**
 * Description of Layout
 *
 * @author Miguel Peralta
 */
class Layout
{

    /**
     * @var array you can change the main layouts for any page, just specify the route or rule
     * in this variable and the layout's name.
     */
    public static $_layouts = array(
        "login"     => ["header" => "loginHeader", "footer" => "loginFooter"],
        "logout"    => ["header" => "loginHeader", "footer" => "loginFooter"],
//        "test"      => ["header" => "rawHeader", "footer" => "rawFooter"],
        "test"      => ["header" => "header2", "footer" => "footer2"],
        "compra/[view]/[id_solicitud]"      => ["header" => "rawHeader", "footer" => "rawFooter"],
        "facturacion/[view]/[id_factura]"      => ["header" => "rawHeader", "footer" => "rawFooter"]
    );
}
