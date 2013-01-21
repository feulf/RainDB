<?php


// register the autoloader
spl_autoload_register( "RainFormAutoloader" );


// autoloader
function RainFormAutoloader( $class ){
    
    // transform the namespace in path
    $path = str_replace("\\", DIRECTORY_SEPARATOR, $class );
    
    // filepath
    $abs_path = BASE_DIR . "/library/" . $path . ".php";
    
    // require the file
    require_once $abs_path;
    
}