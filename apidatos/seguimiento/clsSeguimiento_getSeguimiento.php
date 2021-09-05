<?php

require 'trait_tipoDeRespuesta.php';
require 'trait_seguimientoDenuncia.php';
require 'trait_seguimientoAbordaje.php';

class clsSeguimiento_getSeguimiento
 {
    use trait_tipoDeRespuesta,
        trait_seguimientoDenuncia,
        trait_seguimientoAbordaje;


    public function getSeguimiento_x_incidenteid($id){


      //1.- identificamos que tipo de respuesta es .
      $tipoDeRespuesta = $this->queTipoDeIncidente($id);
      $datos_denuncia =array();

      if ($tipoDeRespuesta == "DENUNCIA LEGAL"){

        $datos_denuncia = $this->getSeguimientoDenuncia($id);

      }

      if ($tipoDeRespuesta == "ABORDAJE INTERNO"){
       $datos_denuncia = $this->getSeguimientoAbordaje($id);
    }

    $data = array( 'msg' =>'ok','respuesta' =>  $datos_denuncia );


      return json_encode($data);
    }// TERMINA FUNCION


}