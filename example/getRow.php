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
    

    $group_id=1;
    // getRow
    $row = DB::getRow("SELECT `name` FROM `group` WHERE group_id=:group_id", array(":group_id"=>$group_id) );
    var_dump( $row );