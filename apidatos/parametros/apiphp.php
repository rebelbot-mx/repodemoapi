/******************************************************************************* */
// parametros
/******************************************************************************** */
/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/parametros/{id}', function (Request $request, Response $response,  array $args): Response {
   
    $id = (int)$args['id'];

    require 'apidatos/parametros/clsparametros_getparametros.php';

    $apiDatos = new clsparametros_getparametros;
    
    $resultado  = $apiDatos->getparametros($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/parametros/{id}', function (Request $request, Response $response): Response {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->delete('/api/v0/parametros/{id}', function (Request $request, Response $response,  array $args): Response {
   
    $id = (int)$args['id'];

    require 'apidatos/parametros/clsparametros_delete.php';

    $apiDatos = new clsparametros_delete;
    
    $resultado  = $apiDatos->deleteparametros($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});


/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/parametros', function (Request $request, Response $response): Response {
   


    require 'apidatos/parametros/clsparametros_getTodosLosparametros.php';

    $apiDatos = new clsparametros_getTodosLosparametros;
    
    $resultado  = $apiDatos->getTodosLosparametros($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/parametros', function (Request $request, Response $response): Response {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->post('/api/v0/parametros', function (Request $request, Response $response): Response {
   
      // Retrieve the JSON data
    $parameters = (array)$request->getParsedBody();

    require 'apidatos/parametros/clsparametros_nuevo.php';

    $apiDatos = new clsparametros_nuevo;
    
    $resultado  = $apiDatos->nuevoparametros( $parameters);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});


/*----------------------------------------------------------------------------------*/
$app->put('/api/v0/parametros', function (Request $request, Response $response): Response {
   
    // Retrieve the JSON data
  $parameters = (array)$request->getParsedBody();

  require 'apidatos/parametros/clsparametros_update.php';

  $apiDatos = new clsparametros_update;
  
  $resultado  = $apiDatos->updateparametros($parameters);

  $response->getBody()->write($resultado);

  return $response->withHeader('Content-Type', 'application/json');

  
});

$app->options('/api/v0/parametros', function (Request $request, Response $response): Response {
  // Retrieve the JSON data
  return $response;
});
