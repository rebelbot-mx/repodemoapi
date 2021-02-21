<?php 
    require_once 'meekrodb.2.3.1/db.class.php';
    /*DB::$user = 'aisosmx_rebelbot';
    DB::$password = 'Rebelware10*';
    DB::$dbName = 'aisosmx_apialdeas';*/
   
    $EN_PRODUCCION =  $_ENV['PRODUCCION']; 
    

    if($EN_PRODUCCION=='SI') {

   // DB::$host='';
    DB::$host='mysqlApiAldeas2.mysql.database.azure.com';
    DB::$user = 'rblprod@mysqlApiAldeas2';
    DB::$password = 'maca2478*';
    DB::$dbName = 'apialdeasbdd';  
   
    

    }else {
    DB::$user = 'mcabrera';
    DB::$password = '2478';
    DB::$dbName = 'apialdeas';
     
    }




