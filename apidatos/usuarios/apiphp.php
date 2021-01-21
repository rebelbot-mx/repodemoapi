/******************************************************************************* */
// usuarios
/******************************************************************************** */
/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/usuarios/{id}', function (Request $request, Response $response,  array $args): Response {
   
    $id = (int)$args['id'];

    require 'apidatos/usuarios/clsusuarios_getusuarios.php';

    $apiDatos = new clsusuarios_getusuarios;
    
    $resultado  = $apiDatos->getusuarios($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/usuarios/{id}', function (Request $request, Response $response): Response {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->delete('/api/v0/usuarios/{id}', function (Request $request, Response $response,  array $args): Response {
   
    $id = (int)$args['id'];

    require 'apidatos/usuarios/clsusuarios_delete.php';

    $apiDatos = new clsusuarios_delete;
    
    $resultado  = $apiDatos->deleteusuarios($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});


/*----------------------------------------------------------------------------------*/
$app->get('/api/v0/cierre/{id}/usuarios', function (Request $request, Response $response, array $args): Response {
   
    $id = (int)$args['id'];

    require 'apidatos/usuarios/clsusuarios_getTodosLosusuarios.php';

    $apiDatos = new clsusuarios_getTodosLosusuarios;
    
    $resultado  = $apiDatos->getusuarios($id);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});

$app->options('/api/v0/cierre/{id}/usuarios', function (Request $request, Response $response): Response {
    // Retrieve the JSON data
    return $response;
});
/*----------------------------------------------------------------------------------*/
$app->post('/api/v0/usuarios', function (Request $request, Response $response): Response {
   
      // Retrieve the JSON data
    $parameters = (array)$request->getParsedBody();

    require 'apidatos/usuarios/clsusuarios_nuevo.php';

    $apiDatos = new clsusuarios_nuevo;
    
    $resultado  = $apiDatos->nuevousuarios( $parameters);

    $response->getBody()->write($resultado);

    return $response->withHeader('Content-Type', 'application/json');

    
});
 /*
$app->options('/api/v0/usuarios', function (Request $request, Response $response): Response {
    // Retrieve the JSON data
    return $response;
}); */

/*----------------------------------------------------------------------------------*/
$app->put('/api/v0/usuarios', function (Request $request, Response $response): Response {
   
    // Retrieve the JSON data
  $parameters = (array)$request->getParsedBody();

  require 'apidatos/usuarios/clsusuarios_update.php';

  $apiDatos = new clsusuarios_update;
  
  $resultado  = $apiDatos->updateusuarios($parameters);

  $response->getBody()->write($resultado);

  return $response->withHeader('Content-Type', 'application/json');

  
});

$app->options('/api/v0/usuarios', function (Request $request, Response $response): Response {
  // Retrieve the JSON data
  return $response;
});
