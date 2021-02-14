<?php 
    require_once 'meekrodb.2.3.1/db.class.php';
    /*DB::$user = 'aisosmx_rebelbot';
    DB::$password = 'Rebelware10*';
    DB::$dbName = 'aisosmx_apialdeas';*/

   /* DB::$host='';
    DB::$user = 'mcabrera';
    DB::$password = '2478';
    DB::$dbName = 'apialdeas';*/

    DB::$host='mysqlApiAldeas.mysql.database.azure.com';
    //DB::$user = 'macapower@mysqlApiAldeas';
    //DB::$password = 'Rbl2020*.';
 DB::$user = 'phpappuser@mysqlApiAldeas';
    DB::$password = 'mysqlazure2017';
    DB::$dbName = 'sampledb';

    /*

    PHP Fatal error:  Uncaught Slim\\Exception\\HttpNotFoundException: Not found. in /home/site/wwwroot/vendor/slim/slim/Slim/Middleware/RoutingMiddleware.php:91\nStack trace:\n
    #0 /home/site/wwwroot/vendor/slim/slim/Slim/Middleware/RoutingMiddleware.php(58): 
    Slim\\Middleware\\RoutingMiddleware->performRouting(Object(Slim\\Psr7\\Request))\n
    
    #1 /home/site/wwwroot/vendor/slim/slim/Slim/MiddlewareDispatcher.php(147): 
    Slim\\Middleware\\RoutingMiddleware->process(Object(Slim\\Psr7\\Request), 
    Object(class@anonymous))\n
    
    #2 /home/site/wwwroot/vendor/slim/slim/Slim/MiddlewareDispatcher.php(81): 
    class@anonymous->handle(Object(Slim\\Psr7\\Request))\n
    
    #3 /home/site/wwwroot/vendor/slim/slim/Slim/App.php(215): 
    Slim\\MiddlewareDispatcher->handle(Object(Slim\\Psr7\\Request))\n
    
    #4 /home/site/wwwroot/vendor/slim/slim/Slim/App.php(199): 
    Slim\\App->handle(Object(Slim\\Psr7\\Request))\n
    
    #5 /home/site/wwwroot/index.php(1685): Slim\\App->run()\n
    
    6 {main}\n  thrown in/home/site/wwwroot/vendor/slim/slim/Slim/Middleware/RoutingMiddleware.php on line 91*/