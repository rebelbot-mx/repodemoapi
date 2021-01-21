/******************************************************************************* */
// roles
/******************************************************************************** */
/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/roles/{id}', function (Request $request, Response $response,  array $args): Response {
   
    $id = (int)$args['id'];

    require 'apidatos/roles/clsroles_getroles.php';

    $apiDatos = new clsroles_getroles;
    
    $resultado  = $apiDatos->getroles($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/roles/{id}', function (Request $request, Response $response): Response {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->delete('/api/v0/roles/{id}', function (Request $request, Response $response,  array $args): Response {
   
    $id = (int)$args['id'];

    require 'apidatos/roles/clsroles_delete.php';

    $apiDatos = new clsroles_delete;
    
    $resultado  = $apiDatos->deleteroles($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});


/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/cierre/{id}/roles', function (Request $request, Response $response, array $args): Response {
   
    $id = (int)$args['id'];

    require 'apidatos/roles/clsroles_getTodosLosroles.php';

    $apiDatos = new clsroles_getTodosLosroles;
    
    $resultado  = $apiDatos->getroles($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/cierre/{id}/roles', function (Request $request, Response $response): Response {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->post('/api/v0/roles', function (Request $request, Response $response): Response {
   
      // Retrieve the JSON data
    $parameters = (array)$request->getParsedBody();

    require 'apidatos/roles/clsroles_nuevo.php';

    $apiDatos = new clsroles_nuevo;
    
    $resultado  = $apiDatos->nuevoroles( $parameters);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});
 /*
$app->options('/api/v0/roles', function (Request $request, Response $response): Response {
    // Retrieve the JSON data
    return $response;
}); */

/*----------------------------------------------------------------------------------*/
$app->put('/api/v0/roles', function (Request $request, Response $response): Response {
   
    // Retrieve the JSON data
  $parameters = (array)$request->getParsedBody();

  require 'apidatos/roles/clsroles_update.php';

  $apiDatos = new clsroles_update;
  
  $resultado  = $apiDatos->updateroles($parameters);

  $response->getBody()->write($resultado);

  return $response->withHeader('Content-Type', 'application/json');

  
});

$app->options('/api/v0/roles', function (Request $request, Response $response): Response {
  // Retrieve the JSON data
  return $response;
});
