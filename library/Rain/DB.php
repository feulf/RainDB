<?php

namespace Rain;   

/**
 * DB - PDO Wrapper library to manage Database
 * 
 * @package Rain
 * @version 3
 * @author Federico Ulfo
 * @link http://rainframework.com
 */


/**
 * DB is the main class of the library
 */
class DB {

    // internal variables
    protected static $db,          // databases list
                     $link,        // database connection object
                     $link_list;   // database connection object list

    // configurations
    protected static $conf = array(

        "config_dir"              => "config/",
        "config_file"             => "db.php",
        "default_connection_name" => "dev"

    );


    /**
     * Initialize the connection
     * @param string $name Name of the connection
     */
    public static function init( $name = null ){

        // set the database list
        if (!self::$db) {

            // load the variables
            require_once self::$conf['config_dir'] . self::$conf['config_file'];

            // set the $db list
            self::$db = $db;

        }

        // db account info
        if( !$name ){
            $name = self::$conf['default_connection_name'];
        }

        $driver      = self::$db[$name]['driver'];
        $hostname    = self::$db[$name]['hostname'];
        $database    = self::$db[$name]['database'];
        $username    = self::$db[$name]['username'];
        $password    = self::$db[$name]['password'];
        $pdo_options = isset(self::$db[$name]['pdo_options'])?self::$db[$name]['pdo_options']:array();

        if (!in_array($driver, \PDO::getAvailableDrivers())) {
            die("Error!: could not find a <a href=\"http://php.net/pdo.drivers.php\" target=\"_blank\">" . $driver . "</a> driver<br/>");
        }

        switch ($driver) {
            case 'mysql':
                $string = "mysql:host=$hostname;dbname=$database";
                $pdo_options = array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
                break;
            case 'pgsql':
                $string = "pqsql:host=$hostname;dbname=$database";
                break;
            case 'sqlite':
                $string = "sqlite:$database_path";
                break;
            case 'oracle':
                $string = "OCI:";
                break;
            case 'odbc':
                // $database path
                $string = "odbc:Driver={Microsoft Access Driver (*.mdb)};Dbq=$database;Uid=$username";
                break;
            default:
                die("Error!: Driver $driver not recognized in DB class");
        }

        // connect
        self::setup($string, $username, $password, $name, $pdo_options);

    }




    /**
     * Connect to the database
     */
    static function setup($string, $username, $password, $name ) {

        try {
            self::$link = new \PDO($string, $username, $password);
            self::$link->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
            self::$link_list[$name] = self::$link;  
        } catch (PDOException $e) {
            die("Error!: " . $e->getMessage() . "<br/>");
        }
    }
    
    
    /**
     * Configure the settings
     */
    static function configure( $setting, $value = null ) {
        
        if (is_array($setting))
            foreach ($setting as $key => $value)
                self::configure($key, $value);
        else if (property_exists(__CLASS__, $setting))
            self::$$setting = $value;
    }


}

// -- end