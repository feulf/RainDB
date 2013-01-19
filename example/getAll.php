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
    

    //
    // DB::getAll
    // ----------
    // The getAll method it comes handy when you need to get the entire result 
    // of your query in an array. 
    // This method is really useful to be used with RainTPL, because you can save the result
    // in a variable, assign it to a template, and show the element with {loop}.
    //
    $query =   "SELECT CONCAT( u.firstname, ' ', u.lastname ) AS username, g.name AS `group`
                FROM user u
                JOIN user_in_group ug ON u.user_id=ug.user_id
                JOIN `group` g ON g.group_id=ug.group_id
                ORDER BY g.group_id
                LIMIT 10";

    $list = DB::getAll($query);
    var_dump( $list );


    
    //
    // Another solution to get the result of a query with multiple rows is to use
    // DB::query() and then DB::getRow() inside a loop.
    // This solution could also use less memory than DB::getAll()
    // because you may stop the loop for example after 3 iterations
    //
    DB::query( $query );
    while( $row = DB::getRow() ){
        var_dump( $row );
    }