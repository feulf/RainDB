<?php

    // base folder
    define("BASE_DIR", dirname(__DIR__) );


    // require RainDB
    require BASE_DIR . "/library/Rain/DB.php";


    // use the namespace Rain
    use Rain\DB;

    
    // 
    // set the configuration
    //
    $config = array( 
                     "config_dir"=> BASE_DIR . "/config/",  // set the configuration folder
                     "fetch_mode"=>\PDO::FETCH_OBJ          // set the fetch mode as object
                   );

    DB::configure( $config );
    
    
    // init the database class
    DB::init();
    

    // execute getAll
    $list = DB::getAll("SELECT title FROM content ORDER BY content_id ASC LIMIT 3");
    var_dump( $list );


    // Get the result of a query row by row to save memory
    DB::query("SELECT title FROM content ORDER BY content_id ASC LIMIT 3");
    while( $row = DB::getRow() ){
        var_dump( $row );
    }