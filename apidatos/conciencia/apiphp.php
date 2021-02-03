/******************************************************************************* */
// conciencia
/******************************************************************************** */
/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/conciencia/{id}', function (Request $request, Response $response,  array $args): Response {
   
    $id = (int)$args['id'];

    require 'apidatos/conciencia/clsconciencia_getconciencia.php';

    $apiDatos = new clsconciencia_getconciencia;
    
    $resultado  = $apiDatos->getconciencia($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/conciencia/{id}', function (Request $request, Response $response): Response {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->delete('/api/v0/conciencia/{id}', function (Request $request, Response $response,  array $args): Response {
   
    $id = (int)$args['id'];

    require 'apidatos/conciencia/clsconciencia_delete.php';

    $apiDatos = new clsconciencia_delete;
    
    $resultado  = $apiDatos->deleteconciencia($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});


/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/conciencia', function (Request $request, Response $response): Response {
   


    require 'apidatos/conciencia/clsconciencia_getTodosLosconciencia.php';

    $apiDatos = new clsconciencia_getTodosLosconciencia;
    
    $resultado  = $apiDatos->getTodosLosconciencia($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/conciencia', function (Request $request, Response $response): Response {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->post('/api/v0/conciencia', function (Request $request, Response $response): Response {
   
      // Retrieve the JSON data
    $parameters = (array)$request->getParsedBody();

    require 'apidatos/conciencia/clsconciencia_nuevo.php';

    $apiDatos = new clsconciencia_nuevo;
    
    $resultado  = $apiDatos->nuevoconciencia( $parameters);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});


/*----------------------------------------------------------------------------------*/
$app->put('/api/v0/conciencia', function (Request $request, Response $response): Response {
   
    // Retrieve the JSON data
  $parameters = (array)$request->getParsedBody();

  require 'apidatos/conciencia/clsconciencia_update.php';

  $apiDatos = new clsconciencia_update;
  
  $resultado  = $apiDatos->updateconciencia($parameters);

  $response->getBody()->write($resultado);

  return $response->withHeader('Content-Type', 'application/json');

  
});

$app->options('/api/v0/conciencia', function (Request $request, Response $response): Response {
  // Retrieve the JSON data
  return $response;
});
