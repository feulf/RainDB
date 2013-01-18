<?php

// use the Rain namespace
use Rain\DB;

\set_include_path(
	BASE_DIR . DIRECTORY_SEPARATOR . 'library'
	. PATH_SEPARATOR . \get_include_path()
);

// require Rain DB
require "Rain/DB.php";


class DBTest extends PHPUnit_Framework_TestCase
{
    function setup(){
        $this->config();
    }
    
    
    /**
     * 
     */
    function testInit(){
        DB::init();
    }

    function config(){
        $config = array(
            'config_dir' => 'config/',
            'config_file'=> 'db.php'
        );
        DB::configure( $config );
    }
    
    
}
