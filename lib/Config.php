<?php

namespace lib;

/**
 * Description of Configuration
 *
 * @author Miguel Peralta
 */
class Config
{     
    /**
     * @var bool define if application will connect to database ( TRUE OR FALSE )
     */    
    public static $_USE_DB,    
    /**
     *
     * @var bool define if application is in development, present defference errors
     */    
    $_DEVELOPING_,   
    /**
     * set database to application
     * @var string
     */    
    $_DATABASE_,    
    /**
     * directory all modules
     * @var string
     */    
    $_MODULES_,    
    /**
     * directory all layouts
     * @var string 
     */
    $_LAYOUTS_,    
    /**
     * HOST APPLICATION
     * @var string 
     */    
    $_HOST_,    
    /**
     * MAIN DIRECTORY APPLICATION
     * @var string 
     */
    $_MAIN_DIRECTORY,    
    /**
     * DIRECTORY LOGS
     * @var string
     */
    $_LOGS,    
    /**
     * root directory to js
     * @var string
     */
    $_ROOT_JS,    
    /**
     * root directory to css
     * @var string
     */
    $_ROOT_CSS,    
    /**
     * LAYOUT ERROR
     * @var string
     */
    $_ERROR_LAYOUT,    
    /**
     * define route root key
     * @var string 
     */
    $_ROUTES_ROOT_KEY,
    /**
     * TITLE APPLICATION
     * @var string
     */
    $_TITLE_APP,     
    /**
     * Specify if the application will use session storage
     * @var boolean
     */
    $_USING_SESSION_STORAGE,    
    /**
     * Table data to sessions
     * @var string
     */
    $_DATA_SESSION,   
    /**
     * Field STORAGE session id
     * @var string 
     */
    $_SESSION_ID,   
    /**
     * FIELD STORAGE THE DATA
     * @var string MUST BE NULL
     */
    $_SESSION_DATA,    
    /**
     * AUTOINCREMENT FIELD
     * @var string
     */
    $_SERIAL_ID;
    
    
    public static function constructor (){
        //search configurations
        $jsonConfiguration = file_get_contents("lib/configuration.json");
        $decode = json_decode( $jsonConfiguration );
        
        self::$_USE_DB                          =           $decode->useDatabase;
        self::$_DEVELOPING_                     =           $decode->appInDeveloping;
        self::$_DATABASE_                       =           $decode->instanceDatabase;
        self::$_MODULES_                        =           $decode->dirModules;
        self::$_LAYOUTS_                        =           $decode->dirLayouts;
        self::$_HOST_                           =           $decode->server;        
        self::$_MAIN_DIRECTORY                  =           $decode->dirProject;
        self::$_LOGS                            =           $decode->dirLogs;
        self::$_ROOT_JS                         =           $decode->dirMainFileJs; 
        self::$_ROOT_CSS                        =           $decode->dirMainFileCss;
        self::$_ERROR_LAYOUT                    =           $decode->fileLayoutError;
        self::$_ROUTES_ROOT_KEY                 =           $decode->defaultKeyRouting;
        self::$_TITLE_APP                       =           $decode->title; 
        self::$_USING_SESSION_STORAGE           =           $decode->useStorageSession;
        self::$_DATA_SESSION                    =           $decode->storageTable;
        self::$_SESSION_ID                      =           $decode->storageIdField;
        self::$_SESSION_DATA                    =           $decode->StorageDataField;
        self::$_SERIAL_ID                       =           $decode->primaryKeyField;
        
    }
    
}

Config::constructor();