<?php 

class clsevidencias_update {

    public function updateevidencias($datos){

       
         DB::update('evidencias', [
           
             'id'            =>  $datos['id'],
            'nombre'         =>  $datos['nombre'],
            'descripcion'    =>  $datos['descripcion'],
            'ubicacion'      =>  $datos['ubicacion'],
            'tipo'           =>  $datos['tipo'],
            'investigacionid'    =>  $datos['investigacionid'],
            'activo'         =>  $datos['activo'],

        
         ],"id=%i",$datos['id'] );

           
  
          error_log(" valor de evidencias actualizados  : " . $datos['id']);

          $data = array('id' => $datos['id']);
   
          return json_encode($data);
    }



}