/******************************************************************************* */
// doctosapoyo
/******************************************************************************** */
/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/doctosapoyo/{id}', function (Request $request, Response $response,  array $args): Response {
   
    $id = (int)$args['id'];

    require 'apidatos/doctosapoyo/clsdoctosapoyo_getdoctosapoyo.php';

    $apiDatos = new clsdoctosapoyo_getdoctosapoyo;
    
    $resultado  = $apiDatos->getdoctosapoyo($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/doctosapoyo/{id}', function (Request $request, Response $response): Response {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->delete('/api/v0/doctosapoyo/{id}', function (Request $request, Response $response,  array $args): Response {
   
    $id = (int)$args['id'];

    require 'apidatos/doctosapoyo/clsdoctosapoyo_delete.php';

    $apiDatos = new clsdoctosapoyo_delete;
    
    $resultado  = $apiDatos->deletedoctosapoyo($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});


/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/doctosapoyo', function (Request $request, Response $response): Response {
   


    require 'apidatos/doctosapoyo/clsdoctosapoyo_getTodosLosdoctosapoyo.php';

    $apiDatos = new clsdoctosapoyo_getTodosLosdoctosapoyo;
    
    $resultado  = $apiDatos->getTodosLosdoctosapoyo($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/doctosapoyo', function (Request $request, Response $response): Response {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->post('/api/v0/doctosapoyo', function (Request $request, Response $response): Response {
   
      // Retrieve the JSON data
    $parameters = (array)$request->getParsedBody();

    require 'apidatos/doctosapoyo/clsdoctosapoyo_nuevo.php';

    $apiDatos = new clsdoctosapoyo_nuevo;
    
    $resultado  = $apiDatos->nuevodoctosapoyo( $parameters);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});


/*----------------------------------------------------------------------------------*/
$app->put('/api/v0/doctosapoyo', function (Request $request, Response $response): Response {
   
    // Retrieve the JSON data
  $parameters = (array)$request->getParsedBody();

  require 'apidatos/doctosapoyo/clsdoctosapoyo_update.php';

  $apiDatos = new clsdoctosapoyo_update;
  
  $resultado  = $apiDatos->updatedoctosapoyo($parameters);

  $response->getBody()->write($resultado);

  return $response->withHeader('Content-Type', 'application/json');

  
});

$app->options('/api/v0/doctosapoyo', function (Request $request, Response $response): Response {
  // Retrieve the JSON data
  return $response;
});