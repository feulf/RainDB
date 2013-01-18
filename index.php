<?php

    // require RainDB
    require "library/Rain/DB.php";


    // use the Rain namespace
    use Rain\DB;
    

    // init the database class
    DB::init();
    
    
    DB::query("SHOW DATABASES");
    
    $row = DB::getRow("SHOW TABLES");
    var_dump( $row );