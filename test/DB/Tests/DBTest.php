<?php


// use the Rain namespace
use Rain\DB;


// set the include path
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
     * Test the DB::init
     */
    function testInit(){
        $this->assertTrue( true === DB::init() );
    }
    
    
    /** 
     * Test DB::query
     */
    function testQuery(){
        $this->assertTrue( get_class( DB::query("SHOW DATABASES") ) == "PDOStatement" );
    }
    
    /**
     * Test DB::getRow
     */
    function testGetRow(){
        $row = DB::getRow("SHOW TABLES");
        $this->assertTrue( is_array($row) );
    }

    function config(){
        $config = array(
            'config_dir' => 'config/',
            'config_file'=> 'db.php'
        );
        DB::configure( $config );
    }
    
    
}
