<?php 

require 'traitValidarInvestigacion.php';

class clsinvestigacion_update {
use traitValidarInvestigacion;
    public function updateInvestigacion($datos){

        date_default_timezone_set('America/Mexico_City');

        $date = date("Y-m-d H:i:s");  

         DB::update('investigacion', [
           
            'folioinvestigacion'    =>  $datos['folioinvestigacion'],
            'registroincidentes_docto'    =>  $datos['registroincidentes_docto'],
            'cartautorizacion_docto'    =>  $datos['cartautorizacion_docto'],
            'terminosreferencia_doctp'    =>  $datos['terminosreferencia_doctp'],
            'plan_docto'    =>  $datos['plan_docto'],
            'informe_docto'    =>  $datos['informe_docto'],
           // 'fechaCreacion'    =>  $datos['fechaCreacion'],
            'fechaUpdate'    =>  $date,

            'estado'    =>  'Guardado'


        
         ],"id=%i",$datos['id'] );

           
  
          error_log(" valor de investigacion actualizados  : " . $datos['id']);

          $validar =  $this->validar($datos['id']);

          $estado ="guardado";
          
          if ($validar == true){

            DB::update('investigacion',
             [ 'estado'    =>  'cerrado'],"id=%i",$datos['id'] );
             $estado ="cerrado";
          }
          $data = array('id' => $datos['id'],'estado'=>$estado);
   
          return json_encode($data);
    }



}