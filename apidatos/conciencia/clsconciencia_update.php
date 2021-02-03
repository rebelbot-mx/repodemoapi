<?php 

class clsconciencia_update {

    public function updateconciencia($datos){

       
         DB::update('conciencia', [
           
            'id'    =>  $datos['id'],
            'estatus'    =>  $datos['estatus'],
            'clasificacion'    =>  $datos['clasificacion'],
            'activo'    =>  $datos['activo'],
            'tipo'    =>  $datos['tipo'],
            'docto'    =>  $datos['docto'],
            'estatusplan'    =>  $datos['estatusplan'],
        
         ],"id=%i",$datos['id'] );

           
  
          error_log(" valor de conciencia actualizados  : " . $datos['id']);

          $data = array('id' => $datos['id']);
   
          return json_encode($data);
    }



}