<?php


$ruta     = $_ENV['RUTA'];
$ruta_uno  = $ruta . '/apidatos/incidentes/trait_formarDatosNavegacion.php';

require $ruta_uno;

class clstest_dn {
use trait_formarDatosNavegacion;

 public function testDatos($id){

      $res = $this->getDatosNavegacion($id);

      return json_encode($res);

 }


}