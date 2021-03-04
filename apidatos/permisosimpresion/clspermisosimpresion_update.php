<?php 

class clspermisosimpresion_update {

    public function updatepermisosimpresion($datos){

       
         DB::update('permisosimpresion', [
           
             'id'    =>  $datos['id']
  'usuarioid'    =>  $datos['usuarioid'],
  'incidenteid'    =>  $datos['incidenteid'],
  'etapa'    =>  $datos['etapa'],
  'password'    =>  $datos['password'],
  'respuesta'    =>  $datos['respuesta'],
  'usuarioidautorizo'    =>  $datos['usuarioidautorizo'],
  'vigente'    =>  $datos['vigente'],
  'fechapeticion'    =>  $datos['fechapeticion'],
  'fechaautorizacion'    =>  $datos['fechaautorizacion'],

        
         ],"id=%i",$datos['id'] );

           
  
          error_log(" valor de permisosimpresion actualizados  : " . $datos['id']);

          $data = array('id' => $datos['id']);
   
          return json_encode($data);
    }



}