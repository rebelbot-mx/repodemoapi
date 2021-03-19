/******************************************************************************* */
// permisosimpresion
/******************************************************************************** */
/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/permisosimpresion/{id}', function (Request $request, Response $response,  array $args): Response {
   
    $id = (int)$args['id'];

    require 'apidatos/permisosimpresion/clspermisosimpresion_getpermisosimpresion.php';

    $apiDatos = new clspermisosimpresion_getpermisosimpresion;
    
    $resultado  = $apiDatos->getpermisosimpresion($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/permisosimpresion/{id}', function (Request $request, Response $response): Response {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->delete('/api/v0/permisosimpresion/{id}', function (Request $request, Response $response,  array $args): Response {
   
    $id = (int)$args['id'];

    require 'apidatos/permisosimpresion/clspermisosimpresion_delete.php';

    $apiDatos = new clspermisosimpresion_delete;
    
    $resultado  = $apiDatos->deletepermisosimpresion($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});


/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/permisosimpresion', function (Request $request, Response $response): Response {
   


    require 'apidatos/permisosimpresion/clspermisosimpresion_getTodosLospermisosimpresion.php';

    $apiDatos = new clspermisosimpresion_getTodosLospermisosimpresion;
    
    $resultado  = $apiDatos->getTodosLospermisosimpresion($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/permisosimpresion', function (Request $request, Response $response): Response {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->post('/api/v0/permisosimpresion', function (Request $request, Response $response): Response {
   
      // Retrieve the JSON data
    $parameters = (array)$request->getParsedBody();

    require 'apidatos/permisosimpresion/clspermisosimpresion_nuevo.php';

    $apiDatos = new clspermisosimpresion_nuevo;
    
    $resultado  = $apiDatos->nuevopermisosimpresion( $parameters);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});


/*----------------------------------------------------------------------------------*/
$app->put('/api/v0/permisosimpresion', function (Request $request, Response $response): Response {
   
    // Retrieve the JSON data
  $parameters = (array)$request->getParsedBody();
                            
  require 'apidatos/permisosimpresion/clspermisosimpresion_update.php';

  $apiDatos = new clspermisosimpresion_update;
  
  $resultado  = $apiDatos->updatepermisosimpresion($parameters);

  $response->getBody()->write($resultado);

  return $response->withHeader('Content-Type', 'application/json');

  
});

$app->options('/api/v0/permisosimpresion', function (Request $request, Response $response): Response {
  // Retrieve the JSON data
  return $response;
});
