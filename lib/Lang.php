<?php

namespace lib;

class Lang { 
    
    /**
     * get All Language
     * @param string $lang
     * @return json
     */
    public static function getJsonLanguage($lang){
        $json = file_get_contents( _BASE_ . _DS_ . "lib" ._DS_. "lang" . _DS_ .$lang.".json");
        return $json;
    }    
    /**
     * get json for language
     * @param string $lang
     * @return json
     */
    private static function chargeJson($lang){
        $json = self::getJsonLanguage($lang);
        return json_decode($json,true);
    }    
    /**
     * get string with the language specified
     * @param string $key
     * @param stirng $lang
     * @return string
     */
    public static function get($key,$lang = 'en'){
        if( isset( $_SESSION["_LANG_APP_"] ) ){
            $lang = $_SESSION["_LANG_APP_"];
        }        
        $alllang = Lang::chargeJson($lang);
        $valor = (isset($alllang[$key]))?$alllang[$key]:$key;    
        return html_entity_decode( $valor );
    }        
}
