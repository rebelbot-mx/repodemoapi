<?php 
require 'trait_validarInvestigacion.php';

class clsinvestigacion_update {
    use trait_validarInvestigacion;

    public function updateInvestigacion($datos){

        date_default_timezone_set('America/Mexico_City');

        $date = date("Y-m-d H:i:s");  

         DB::update('investigacion', [

            'folioinvestigacion'           =>  $datos['folioinvestigacion'],
            'registroincidentes_docto'     =>  $datos['registroincidentes_docto'],
            'cartautorizacion_docto'       =>  $datos['cartautorizacion_docto'],
            'terminosreferencia_doctp'     =>  $datos['terminosreferencia_doctp'],
            'plan_docto'                   =>  $datos['plan_docto'],
            'informe_docto'                =>  $datos['informe_docto'],
           // 'fechaCreacion'    =>  $datos['fechaCreacion'],
            'fechaUpdate'                  =>  $date


         ],"id=%i",$datos['id'] );



          error_log(" valor de investigacion actualizados  : " . $datos['id']);

          $validar = false ;

          $validar = $this->validarInvestigacion($datos);

          $validar == true ;
          $estado  = 'guardado';

          $data = array(
                       'id' => $datos['id'],
                       'estado'=> $estado,
                       'sePuedeCerrarLaInvestigacion' => $validar);

          return json_encode($data);
    }



} 