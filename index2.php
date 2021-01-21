<?php
//use DI\ContainerBuilder; //para subir archivos
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;
use Slim\Exception\NotFoundException;
use Psr\Http\Message\UploadedFileInterface;

require_once 'vendor/autoload.php';

require_once 'apidatos/clsConexionDB.php';

//require_once '/vendor/autoload.php';
//require 'vendor/autoload.php';

/* ---------------------------------------*/
/*  PARA SUBIR ARCHIVOS SEGUN SLIM        */
/*----------------------------------------*/

//$containerBuilder = new ContainerBuilder();
//$container = $containerBuilder->build();

//$container->set('upload_directory', __DIR__ . '/uploads');
//AppFactory::setContainer($container);
/*----------------------------------------*/

$app = AppFactory::create();
$app->setBasePath("/apialdeas");
$app->addBodyParsingMiddleware();

$app->options('/apialdeas/{routes:.+}', function ($request, $response, $args) {
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');

});



// This middleware will append the response header Access-Control-Allow-Methods with all allowed methods
$app->add(function (Request $request, RequestHandlerInterface $handler){
    $routeContext = RouteContext::fromRequest($request);
    $routingResults = $routeContext->getRoutingResults();
    //$methods = $routingResults->getAllowedMethods();
    //error_log($methods);
    //$requestHeaders = $request->getHeaderLine('Access-Control-Request-Headers');

    $response = $handler->handle($request);

    $response = $response->withHeader('Access-Control-Allow-Origin', '*');
    $response = $response->withHeader('Access-Control-Allow-Methods','GET, POST, PUT, DELETE, PATCH, OPTIONS');
    $response = $response->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization');

    // Optional: Allow Ajax CORS requests with Authorization header
    // $response = $response->withHeader('Access-Control-Allow-Credentials', 'true');

    return $response;
});

// The RoutingMiddleware should be added after our CORS middleware so routing is performed first
$app->addRoutingMiddleware();

// The routes


// aqui  empiezo yo 

$app->get('/',function(Request $request , Response $response){

   
     
   

    $response->getBody()->write("api activa");

    return $response;

});

$app->get('/api/v0/users', function (Request $request, Response $response) {
    $response->getBody()->write('List all users');

    return $response;
});

$app->get('/api/v0/users/{id}', function (Request $request, Response $response, array $arguments) {
    $userId = (int)$arguments['id'];
    $response->getBody()->write(sprintf('Get user: %s', $userId));

    return $response;
});

/************************************************** */

$app->post('/api/v0/users', function (Request $request, Response $response) {
    // Retrieve the JSON data
    $parameters = (array)$request->getParsedBody();

    $response->getBody()->write('Create user');

    return $response;
});

$app->options('/api/v0/users', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});
/******************************************************************* */

$app->delete('/api/v0/users/{id}', function (Request $request, Response $response, array $arguments) {
    $userId = (int)$arguments['id'];
    $response->getBody()->write(sprintf('Delete user: %s', $userId));

    return $response;
});


/***********************************
 *  SUBIR ARCHIVOS
 ************************************/
/************************************************** */

$app->post('/api/v0/upload', function (Request $request, Response $response) {
    try {

    $uploadedFiles = $request->getUploadedFiles();

    // handle single input with single file upload
    $uploadedFile = $uploadedFiles['file'];

    //directory
    $directory = "/uploads";

    require 'apidatos/subirarchivos/clsSubirArchivos.php';
   
    $subir_Archivo =new clsSubirArchivos;
   
    if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
            $filename =   $subir_Archivo->moveUploadedFile();
            $response->getBody()->write( $filename );
        }
  /*  

    $subir_Archivo->subirArchivo();

    $response->getBody()->write($subir_Archivo);*/
   
    return $response->withHeader('Content-Type', 'application/json');
    }catch(Exception $ex){

        error_log(" error en ex " . $ex);

    }
});

$app->options('/api/v0/upload', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});

$app->get('/api/v0/files/{id}', function (Request $request, Response $response,array $args) {
    try {

        $archivoId = (int)$args['id']; 
        
        require 'apidatos/subirarchivos/clsArchivos_getArchivo.php';
   
        $archivo =new clsArchivos_getArchivo;

        $res = $archivo->getArchivo( $archivoId );
       
        $response->getBody()->write( $res );
       
       return $response;

    }catch(Exception $ex){


    }
});

$app->options('/api/v0/files/{id}', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});

/******************************************************************* */


/*======================================== 
// INCIDENTES 
==========================================*/

$app->post('/incidentes', function (Request $request, Response $response) {
    // Retrieve the JSON data
    $parameters = (array)$request->getParsedBody();

    require 'apidatos/incidentes/clsIncidentes_nuevo.php';

    $apidatos = new clsIncidentes_nuevo;

    $id = $apidatos->nuevoIncidente($parameters);

   $response->getBody()->write(json_encode( $id));

    

    return $response->withHeader('Content-Type', 'application/json');
});
$app->options('/incidentes', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});

/*----------------------------------------------------------------------------- 
    con este endpoint recueperamos todos los registros de la tabla de  incidentes
    ----------------------------------------------------------------------------*/

$app->get('/api/v0/incidentes', function (Request $request, Response $response ){

    require 'apidatos/incidentes/clsIncidentes_todosLosIncidentes.php';

    $apiDatos = new clsIncidentes_todosLosIncidentes;
    
    $resultado  = $apiDatos->todosLosIncidentes();

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');


});

$app->options('/api/v0/incidentes', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});

/******************************************************************************************** */
$app->get('/api/v0/incidentes/{id}', function (Request $request, Response $response,  array $args) {
   
    $userId = (int)$args['id'];

    require 'apidatos/incidentes/clsIncidentes_getIncidente.php';

    $apiDatos = new clsIncidentes_getIncidente;
    
    $resultado  = $apiDatos->getIncidente($userId);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/incidentes/{id}', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});
/* **************************************************/

$app->get('/api/v0/incidentes/{id}/valoracionintegral', function (Request $request, Response $response,  array $args) {
   
    $userId = (int)$args['id'];

    require 'apidatos/valoracionintegral/clsValoracion_getValoracion.php';

    $apiDatos = new clsValoracion_getValoracion;
    
    $resultado  = $apiDatos->getValoracion_x_incidenteid($userId);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/incidentes/{id}/valoracionintegral', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});
/******************************************************************************* */
// CIERRE -->
/******************************************************************************** */
/*----------------------------------------------------------------------------------*/

$app->get('/api/v0/incidentes/{id}/cierre', function (Request $request, Response $response,  array $args) {
   
    $id = (int)$args['id'];

    require 'apidatos/cierre/clsCierre_getDatosDelCierre.php';

    $apiDatos = new clsCierre_getDatosDelCierre;
    
    $resultado  = $apiDatos->getcierre($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/incidentes/{id}/cierre', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});


/******************************************************************************* */
// TESTIGOS
/******************************************************************************** */
/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/testigos/{id}', function (Request $request, Response $response,  array $args) {
   
    $id = (int)$args['id'];

    require 'apidatos/testigos/clsTestigo_getTestigo.php';

    $apiDatos = new clsTestigo_getTestigo;
    
    $resultado  = $apiDatos->getTestigo($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/testigos/{id}', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->delete('/api/v0/testigos/{id}', function (Request $request, Response $response,  array $args) {
   
    $id = (int)$args['id'];

    require 'apidatos/testigos/clsTestigos_delete.php';

    $apiDatos = new clsTestigos_delete;
    
    $resultado  = $apiDatos->deleteTestigo($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});


/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/cierre/{id}/testigos', function (Request $request, Response $response, array $args) {
   
    $id = (int)$args['id'];

    require 'apidatos/testigos/clsTestigos_getTodosLosTestigos.php';

    $apiDatos = new clsTestigo_getTodosLosTestigos;
    
    $resultado  = $apiDatos->getTestigos($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/cierre/{id}/testigos', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->post('/api/v0/testigos', function (Request $request, Response $response) {
   
      // Retrieve the JSON data
    $parameters = (array)$request->getParsedBody();

    require 'apidatos/testigos/clsTestigos_nuevo.php';

    $apiDatos = new clsTestigos_nuevo;
    
    $resultado  = $apiDatos->nuevoTestigo( $parameters);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});
 /*
$app->options('/api/v0/testigos', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
}); */

/*----------------------------------------------------------------------------------*/
$app->put('/api/v0/testigos', function (Request $request, Response $response) {
   
    // Retrieve the JSON data
  $parameters = (array)$request->getParsedBody();

  require 'apidatos/testigos/clsTestigos_update.php';

  $apiDatos = new clsTestigos_update;
  
  $resultado  = $apiDatos->updateTestigo($parameters);

  $response->getBody()->write($resultado);

  return $response->withHeader('Content-Type', 'application/json');

  
});

$app->options('/api/v0/testigos', function (Request $request, Response $response) {
  // Retrieve the JSON data
  return $response;
});
/*----------------------------------------------------------------------------------*/
/**  SEGUIMIENTO  */
/*-----------------*/

$app->get('/api/v0/incidentes/{id}/seguimiento', function (Request $request, Response $response,  array $args) {
   
    $id = (int)$args['id'];

    require 'apidatos/seguimiento/clsSeguimiento_getSeguimiento.php';

    $apiDatos = new clsSeguimiento_getSeguimiento;
    
    $resultado  = $apiDatos->getSeguimiento_x_incidenteid($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/incidentes/{id}/seguimiento', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});
/*---------------------------------------------------------------------*/
///api/v0/seguimiento

$app->put('/api/v0/seguimiento', function (Request $request, Response $response,  array $args) {
  
    $parameters = (array)$request->getParsedBody();

    require 'apidatos/seguimiento/clsSeguimiento_update.php';

    $apidatos = new clsSeguimiento_update;

    $msg = $apidatos->updateSeguimiento2($parameters);

   $response->getBody()->write($msg);

    

    return $response->withHeader('Content-Type', 'application/json');

    
});
$app->options('/api/v0/seguimiento', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});


/*---------------------------------------------------------------------*/
$app->put('/api/v0/valoracionintegral', function (Request $request, Response $response,  array $args) {
  
    $parameters = (array)$request->getParsedBody();

    require 'apidatos/valoracionintegral/clsValoracion_update.php';

    $apidatos = new clsValoracion_update;

    $msg = $apidatos->updateValoracion($parameters);

   $response->getBody()->write($msg);

    

    return $response->withHeader('Content-Type', 'application/json');

    
});
$app->options('/api/v0/valoracionintegral', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});

/*======================================== */
// Catch-all route to serve a 404 Not Found page if none of the routes match
// NOTE: make sure this route is defined last
/*$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($req, $res) {
    $handler = $this->notFoundHandler; // handle using the default Slim page not found handler
    return $handler($req, $res);
});*/

/*=========================================*/
/******************************************************************************* */
// denuncialegal
/******************************************************************************** */
/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/denuncialegal/{id}', function (Request $request, Response $response,  array $args) {
   
    $id = (int)$args['id'];

    require 'apidatos/denuncialegal/clsdenuncialegal_getdenuncialegal.php';

    $apiDatos = new clsdenuncialegal_getdenuncialegal;
    
    $resultado  = $apiDatos->getdenuncialegal($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/denuncialegal/{id}', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->delete('/api/v0/denuncialegal/{id}', function (Request $request, Response $response,  array $args) {
   
    $id = (int)$args['id'];

    require 'apidatos/denuncialegal/clsdenuncialegal_delete.php';

    $apiDatos = new clsdenuncialegal_delete;
    
    $resultado  = $apiDatos->deletedenuncialegal($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});


/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/incidente/{id}/denuncialegal', function (Request $request, Response $response, array $args) {
   
    $id = (int)$args['id'];

    require 'apidatos/denuncialegal/clsdenuncialegal_getTodosLosdenuncialegal.php';

    $apiDatos = new clsdenuncialegal_getTodosLosdenuncialegal;
    
    $resultado  = $apiDatos->getdenuncialegal($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/incidente/{id}/denuncialegal', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->post('/api/v0/denuncialegal', function (Request $request, Response $response) {
   
      // Retrieve the JSON data
    $parameters = (array)$request->getParsedBody();

    require 'apidatos/denuncialegal/clsdenuncialegal_nuevo.php';

    $apiDatos = new clsdenuncialegal_nuevo;
    
    $resultado  = $apiDatos->nuevodenuncialegal( $parameters);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});
 /*
$app->options('/api/v0/denuncialegal', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
}); */

/*----------------------------------------------------------------------------------*/
$app->put('/api/v0/denuncialegal', function (Request $request, Response $response) {
   
    // Retrieve the JSON data
  $parameters = (array)$request->getParsedBody();

  require 'apidatos/denuncialegal/clsdenuncialegal_update.php';

  $apiDatos = new clsdenuncialegal_update;
  
  $resultado  = $apiDatos->updatedenuncialegal($parameters);

  $response->getBody()->write($resultado);

  return $response->withHeader('Content-Type', 'application/json');

  
});

$app->options('/api/v0/denuncialegal', function (Request $request, Response $response) {
  // Retrieve the JSON data
  return $response;
});

/******************************************************************************* */
// investigacion
/******************************************************************************** */
/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/investigacion/{id}', function (Request $request, Response $response,  array $args) {
   
    $id = (int)$args['id'];

    require 'apidatos/investigacion/clsinvestigacion_getinvestigacion.php';

    $apiDatos = new clsinvestigacion_getinvestigacion;
    
    $resultado  = $apiDatos->getinvestigacion($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/investigacion/{id}', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->delete('/api/v0/investigacion/{id}', function (Request $request, Response $response,  array $args) {
   
    $id = (int)$args['id'];

    require 'apidatos/investigacion/clsinvestigacion_delete.php';

    $apiDatos = new clsinvestigacion_delete;
    
    $resultado  = $apiDatos->deleteinvestigacion($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});


/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/denuncia/{id}/investigacion', function (Request $request, Response $response, array $args) {
   
    $id = (int)$args['id'];

    require 'apidatos/investigacion/clsinvestigacion_getinvestigacion.php';

   // $apiDatos = new clsinvestigacion_getTodosLosinvestigacion;
    $apiDatos = new clsinvestigacion_getinvestigacion;
    $resultado  = $apiDatos->getinvestigacion_x_incidenteid($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/denuncia/{id}/investigacion', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->post('/api/v0/investigacion', function (Request $request, Response $response) {
   
      // Retrieve the JSON data
    $parameters = (array)$request->getParsedBody();

    require 'apidatos/investigacion/clsinvestigacion_nuevo.php';

    $apiDatos = new clsinvestigacion_nuevo;
    
    $resultado  = $apiDatos->nuevoinvestigacion( $parameters);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});
 /*
$app->options('/api/v0/investigacion', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
}); */

/*----------------------------------------------------------------------------------*/
$app->put('/api/v0/investigacion', function (Request $request, Response $response) {
   
    // Retrieve the JSON data
  $parameters = (array)$request->getParsedBody();

  require 'apidatos/investigacion/clsinvestigacion_update.php';

  $apiDatos = new clsinvestigacion_update;
  
  $resultado  = $apiDatos->updateinvestigacion($parameters);

  $response->getBody()->write($resultado);

  return $response->withHeader('Content-Type', 'application/json');

  
});

$app->options('/api/v0/investigacion', function (Request $request, Response $response) {
  // Retrieve the JSON data
  return $response;
});

/* ******** */
/* cierre */
/*----------------------------------------------------------------------------------*/
$app->put('/api/v0/cierre', function (Request $request, Response $response) {
   
    // Retrieve the JSON data
  $parameters = (array)$request->getParsedBody();

  require 'apidatos/cierre/clsCierre_realizar.php';

  $apiDatos = new clsCierre_realizar;
  
  $resultado  = $apiDatos->getcierre($parameters);

  $response->getBody()->write($resultado);

  return $response->withHeader('Content-Type', 'application/json');

  
});

$app->options('/api/v0/cierre', function (Request $request, Response $response) {
  // Retrieve the JSON data
  return $response;
});
/******************************************************************************* */
// programas
/******************************************************************************** */
/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/programas', function (Request $request, Response $response) {
   
 

    require 'apidatos/programas/clsprogramas_getprogramas.php';

    $apiDatos = new clsprogramas_getprogramas;
    
    $resultado  = $apiDatos->getTodosprogramas();

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});




$app->get('/api/v0/programas/{id}', function (Request $request, Response $response,  array $args) {
   
    $id = (int)$args['id'];

    require 'apidatos/programas/clsprogramas_getprogramas.php';

    $apiDatos = new clsprogramas_getprogramas;
    
    $resultado  = $apiDatos->getprogramas($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/programas/{id}', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->delete('/api/v0/programas/{id}', function (Request $request, Response $response,  array $args) {
   
    $id = (int)$args['id'];

    require 'apidatos/programas/clsprogramas_delete.php';

    $apiDatos = new clsprogramas_delete;
    
    $resultado  = $apiDatos->deleteprogramas($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});


/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/cierre/{id}/programas', function (Request $request, Response $response, array $args) {
   
    $id = (int)$args['id'];

    require 'apidatos/programas/clsprogramas_getTodosLosprogramas.php';

    $apiDatos = new clsprogramas_getTodosLosprogramas;
    
    $resultado  = $apiDatos->getprogramas($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/cierre/{id}/programas', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->post('/api/v0/programas', function (Request $request, Response $response) {
   
      // Retrieve the JSON data
    $parameters = (array)$request->getParsedBody();

    require 'apidatos/programas/clsprogramas_nuevo.php';

    $apiDatos = new clsprogramas_nuevo;
    
    $resultado  = $apiDatos->nuevoprogramas( $parameters);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});
 /*
$app->options('/api/v0/programas', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
}); */

/*----------------------------------------------------------------------------------*/
$app->put('/api/v0/programas', function (Request $request, Response $response) {
   
    // Retrieve the JSON data
  $parameters = (array)$request->getParsedBody();

  require 'apidatos/programas/clsprogramas_update.php';

  $apiDatos = new clsprogramas_update;
  
  $resultado  = $apiDatos->updateprogramas($parameters);

  $response->getBody()->write($resultado);

  return $response->withHeader('Content-Type', 'application/json');

  
});

$app->options('/api/v0/programas', function (Request $request, Response $response) {
  // Retrieve the JSON data
  return $response;
});
/******************************************************************************* */
// cargos
/******************************************************************************** */
/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/cargos/{id}', function (Request $request, Response $response,  array $args) {
   
    $id = (int)$args['id'];

    require 'apidatos/cargos/clscargos_getcargos.php';

    $apiDatos = new clscargos_getcargos;
    
    $resultado  = $apiDatos->getcargos($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/cargos/{id}', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->delete('/api/v0/cargos/{id}', function (Request $request, Response $response,  array $args) {
   
    $id = (int)$args['id'];

    require 'apidatos/cargos/clscargos_delete.php';

    $apiDatos = new clscargos_delete;
    
    $resultado  = $apiDatos->deletecargos($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});


/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/cargos', function (Request $request, Response $response) {
   
   
    require 'apidatos/cargos/clscargos_getTodosLoscargos.php';

    $apiDatos = new clscargos_getTodosLoscargos;
    
    $resultado  = $apiDatos->get_todos_los_cargos();

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});


$app->get('/api/v0/cierre/{id}/cargos', function (Request $request, Response $response, array $args) {
   
    $id = (int)$args['id'];

    require 'apidatos/cargos/clscargos_getTodosLoscargos.php';

    $apiDatos = new clscargos_getTodosLoscargos;
    
    $resultado  = $apiDatos->getcargos($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/cierre/{id}/cargos', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->post('/api/v0/cargos', function (Request $request, Response $response) {
   
      // Retrieve the JSON data
    $parameters = (array)$request->getParsedBody();

    require 'apidatos/cargos/clscargos_nuevo.php';

    $apiDatos = new clscargos_nuevo;
    
    $resultado  = $apiDatos->nuevocargos( $parameters);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});
 /*
$app->options('/api/v0/cargos', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
}); */

/*----------------------------------------------------------------------------------*/
$app->put('/api/v0/cargos', function (Request $request, Response $response) {
   
    // Retrieve the JSON data
  $parameters = (array)$request->getParsedBody();

  require 'apidatos/cargos/clscargos_update.php';

  $apiDatos = new clscargos_update;
  
  $resultado  = $apiDatos->updatecargos($parameters);

  $response->getBody()->write($resultado);

  return $response->withHeader('Content-Type', 'application/json');

  
});

$app->options('/api/v0/cargos', function (Request $request, Response $response) {
  // Retrieve the JSON data
  return $response;
});
/******************************************************************************* */
// evidencias
/******************************************************************************** */
/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/evidencias/{id}', function (Request $request, Response $response,  array $args) {
   
    $id = (int)$args['id'];

    require 'apidatos/evidencias/clsevidencias_getevidencias.php';

    $apiDatos = new clsevidencias_getevidencias;
    
    $resultado  = $apiDatos->getevidencias($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/evidencias/{id}', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->delete('/api/v0/evidencias/{id}', function (Request $request, Response $response,  array $args) {
   
    $id = (int)$args['id'];

    require 'apidatos/evidencias/clsevidencias_delete.php';

    $apiDatos = new clsevidencias_delete;
    
    $resultado  = $apiDatos->deleteevidencias($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});


/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/investigacion/{id}/evidencias', function (Request $request, Response $response, array $args) {
   
    $id = (int)$args['id'];

    require 'apidatos/evidencias/clsevidencias_getTodosLosevidencias.php';

    $apiDatos = new clsevidencias_getTodosLosevidencias;
    
    $resultado  = $apiDatos->getevidencias_de_una_denuncia($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/investigacion/{id}/evidencias', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->post('/api/v0/evidencias', function (Request $request, Response $response) {
   
      // Retrieve the JSON data
    $parameters = (array)$request->getParsedBody();

    require 'apidatos/evidencias/clsevidencias_nuevo.php';

    $apiDatos = new clsevidencias_nuevo;
    
    $resultado  = $apiDatos->nuevoevidencias( $parameters);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});
 /*
$app->options('/api/v0/evidencias', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
}); */

/*----------------------------------------------------------------------------------*/
$app->put('/api/v0/evidencias', function (Request $request, Response $response) {
   
    // Retrieve the JSON data
  $parameters = (array)$request->getParsedBody();

  require 'apidatos/evidencias/clsevidencias_update.php';

  $apiDatos = new clsevidencias_update;
  
  $resultado  = $apiDatos->updateevidencias($parameters);

  $response->getBody()->write($resultado);

  return $response->withHeader('Content-Type', 'application/json');

  
});

$app->options('/api/v0/evidencias', function (Request $request, Response $response) {
  // Retrieve the JSON data
  return $response;
});
/******************************************************************************* */
// roles
/******************************************************************************** */
/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/roles/{id}', function (Request $request, Response $response,  array $args) {
   
    $id = (int)$args['id'];

    require 'apidatos/roles/clsroles_getroles.php';

    $apiDatos = new clsroles_getroles;
    
    $resultado  = $apiDatos->getroles($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/roles/{id}', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->delete('/api/v0/roles/{id}', function (Request $request, Response $response,  array $args) {
   
    $id = (int)$args['id'];

    require 'apidatos/roles/clsroles_delete.php';

    $apiDatos = new clsroles_delete;
    
    $resultado  = $apiDatos->deleteroles($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});


/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/roles', function (Request $request, Response $response) {
   
   
    error_log(" aquie andamos");
    require 'apidatos/roles/clsroles_getTodosLosroles.php';

    $apiDatos = new clsroles_getTodosLosroles;
    
    $resultado  = $apiDatos->getroles();

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/cierre/{id}/roles', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->post('/api/v0/roles', function (Request $request, Response $response) {
   
      // Retrieve the JSON data
    $parameters = (array)$request->getParsedBody();

    require 'apidatos/roles/clsroles_nuevo.php';

    $apiDatos = new clsroles_nuevo;
    
    $resultado  = $apiDatos->nuevoroles( $parameters);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});
 /*
$app->options('/api/v0/roles', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
}); */

/*----------------------------------------------------------------------------------*/
$app->put('/api/v0/roles', function (Request $request, Response $response) {
   
    // Retrieve the JSON data
  $parameters = (array)$request->getParsedBody();

  require 'apidatos/roles/clsroles_update.php';

  $apiDatos = new clsroles_update;
  
  $resultado  = $apiDatos->updateroles($parameters);

  $response->getBody()->write($resultado);

  return $response->withHeader('Content-Type', 'application/json');

  
});

$app->options('/api/v0/roles', function (Request $request, Response $response) {
  // Retrieve the JSON data
  return $response;
});
/******************************************************************************* */
// usuarios
/******************************************************************************** */
/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/usuarios/{id}', function (Request $request, Response $response,  array $args) {
   
    $id = (int)$args['id'];

    require 'apidatos/usuarios/clsusuarios_getusuarios.php';

    $apiDatos = new clsusuarios_getusuarios;
    
    $resultado  = $apiDatos->getusuarios($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/usuarios/{id}', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->delete('/api/v0/usuarios/{id}', function (Request $request, Response $response,  array $args) {
   
    $id = (int)$args['id'];

    require 'apidatos/usuarios/clsusuarios_delete.php';

    $apiDatos = new clsusuarios_delete;
    
    $resultado  = $apiDatos->deleteusuarios($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});


/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/usuarios', function (Request $request, Response $response) {
   
  

    require 'apidatos/usuarios/clsusuarios_getTodosLosusuarios.php';

    $apiDatos = new clsusuarios_getTodosLosusuarios;
    
    $resultado  = $apiDatos->getTodosLosusuarios();

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/cierre/{id}/usuarios', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->post('/api/v0/usuarios', function (Request $request, Response $response) {
   
      // Retrieve the JSON data
    $parameters = (array)$request->getParsedBody();

    require 'apidatos/usuarios/clsusuarios_nuevo.php';

    $apiDatos = new clsusuarios_nuevo;
    
    $resultado  = $apiDatos->nuevousuarios( $parameters);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});
 /*
$app->options('/api/v0/usuarios', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
}); */

/*----------------------------------------------------------------------------------*/
$app->put('/api/v0/usuarios', function (Request $request, Response $response) {
   
    // Retrieve the JSON data
  $parameters = (array)$request->getParsedBody();

  require 'apidatos/usuarios/clsusuarios_update.php';

  $apiDatos = new clsusuarios_update;
  
  $resultado  = $apiDatos->updateusuarios($parameters);

  $response->getBody()->write($resultado);

  return $response->withHeader('Content-Type', 'application/json');

  
});

$app->options('/api/v0/usuarios', function (Request $request, Response $response) {
  // Retrieve the JSON data
  return $response;
});
///////////////////////////
// S E S I O N           //
//////////////////////////
$app->get('/api/v0/login/usuario/{correo}/pass/{pass}', function (Request $request, Response $response,  array $args) {
   
    $correo = (String)$args['correo'];
    $pass = (String)$args['pass'];
    require 'apidatos/sesion/clssesion_login.php';

    $apiDatos = new clssesion_login;
    
    $resultado  = $apiDatos->getSesion($correo,$pass);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});
$app->options('/api/v0/login/usuario/{correo}/pass/{pass}', function (Request $request, Response $response) {
    // Retrieve the JSON data
    return $response;
  });


$app->run();