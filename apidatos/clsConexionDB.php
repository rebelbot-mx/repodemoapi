<?php 
    require_once 'meekrodb.2.3.1/db.class.php';
    /*DB::$user = 'aisosmx_rebelbot';
    DB::$password = 'Rebelware10*';
    DB::$dbName = 'aisosmx_apialdeas';*/

    if($EN_PRODUCCION=='SI') {

   // DB::$host='';
    DB::$user = 'mcabrera';
    DB::$password = '2478';
    DB::$dbName = 'apialdeas';
    }else {

    DB::$host='mysqlApiAldeas.mysql.database.azure.com';
    DB::$user = 'phpappuser@mysqlApiAldeas';
    DB::$password = 'mysqlazure2017';
    DB::$dbName = 'sampledb';       
    }




