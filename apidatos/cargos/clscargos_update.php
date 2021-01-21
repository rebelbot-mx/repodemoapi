<?php 

class clscargos_update {

    public function updatecargos($datos){

       
         DB::update('cargos', [
           
             'id'    =>  $datos['id'],
  'nombrecargo'    =>  $datos['nombrecargo'],
  'descripcion'    =>  $datos['descripcion'],
  'activo'    =>  $datos['activo']

        
         ],"id=%i",$datos['id'] );

           
  
          error_log(" valor de cargos actualizados  : " . $datos['id']);

          $data = array('id' => $datos['id']);
   
          return json_encode($data);
    }



}