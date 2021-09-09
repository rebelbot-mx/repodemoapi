<?php 

class clsValoracion_getValoracion { 
 
    public function getValoracion($id){

        $results = DB::query("SELECT * FROM valoracionintegral where id =%i " ,$id );

        return json_encode($results);


    }

        public function getValoracion_x_incidenteid($id){

        $results = DB::query("SELECT * FROM valoracionintegral where incidenteid =%i " ,$id );
        
        //obtebnemos el folio
        $folio  = clsValoracion_getValoracion::getFolio($id);

        $results[0]['folio'] = $folio;

        $datosInvestigacion  = clsValoracion_getValoracion::getInvestigacion($id);

        $results[0]['investigacion'] = $datosInvestigacion;
        return json_encode($results);


    }

    public function getFolio($id){
       
        $folio = DB::queryFirstField("SELECT folio FROM incidente WHERE id=%i", $id);
        
         return $folio;
    }

    public function getInvestigacion($id){

        $investigacion = DB::queryFirstField("SELECT count(*) FROM investigacion WHERE incidenteid=%i", $id);
        
        $res = false;

        $estado ='';

        $investigacion ==  0 ? $res= false : $res = true;

        if ($res == true ){

            $estado = DB::queryFirstField("SELECT estado FROM investigacion WHERE incidenteid=%i", $id);
        }
         
        $respuesta =  array (
                      'hayInvestigacion' => $res ,
                      'estado'           => $estado
        ) ;

        return $respuesta;
    }






}

/*
Fatal error: Uncaught Slim\Exception\HttpNotFoundException: Not found.
 in C:\laragon\www\apialdeas\vendor\slim\slim\Slim\Middleware\RoutingMiddleware.php:93 
 Stack trace: #0 C:\laragon\www\apialdeas\vendor\slim\slim\Slim\Middleware\RoutingMiddleware.php(59):
  Slim\Middleware\RoutingMiddleware->performRouting(Object(Slim\Psr7\Request)) #1
   C:\laragon\www\apialdeas\vendor\slim\slim\Slim\MiddlewareDispatcher.php(140):
    Slim\Middleware\RoutingMiddleware->process(Object(Slim\Psr7\Request), Object(class@anonymous)) #2 
    C:\laragon\www\apialdeas\vendor\slim\slim\Slim\MiddlewareDispatcher.php(81): class@anonymous->handle(Object(Slim\Psr7\Request)) #3
    C:\laragon\www\apialdeas\vendor\slim\slim\Slim\App.php(215): Slim\MiddlewareDispatcher->handle(Object(Slim\Psr7\Request))
     #4 C:\laragon\www\apialdeas\vendor\slim\slim\Slim\App.php(199): Slim\App->handle(Object(Slim\Psr7\Request)) 
     #5 C:\laragon\www\apialdeas\index.php(1397): Slim\App->run() #6 {main} thrown in C:\laragon\www\apialdeas\vendor\slim\slim\Slim\Middleware\RoutingMiddleware.php on line 93

 */