<?php

    // require RainDB
    require "library/Rain/DB.php";


    // use the Rain namespace
    use Rain\DB;
    

    // init the database class
    DB::init();
    

    // execute query
    DB::query("SHOW DATABASES");
    

    // getField
    $field = DB::getField("SELECT title FROM content LIMIT 1");
    var_dump( $field );

    
    // getRow
    $row = DB::getRow("SHOW TABLES");
    var_dump( $row );


    // execute getAll
    $list = DB::getAll("SELECT title FROM content ORDER BY content_id ASC LIMIT 3");
    var_dump( $list );


    // Get the result of a query row by row to save memory
    DB::query("SELECT title FROM content ORDER BY content_id ASC LIMIT 3");
    while( $row = DB::getRow() ){
        var_dump( $row );
    }