<?php 



class clsIncidente_respuesta {


   public function getRespuestaDelIncidente($id) {

    //1.- buscamos en valoracion integral el tipo de respuesta
    $sql =" select tipoderespuesta from valoracionintegral where incidenteid = " . $id;

    $respuesta  = DB::queryFirstField( $sql );

    $msg = $respuesta;

    switch($respuesta){
        case 'ABORDAJE INTERNO':
            break;
        case 'INVESTIGACION INTERNA';
            break;
        case 'DENUNCIA LEGAL';
            break;
        default :
            $msg =  "no  hay respuesta";
    }

      return json_encode($msg);
   }

}