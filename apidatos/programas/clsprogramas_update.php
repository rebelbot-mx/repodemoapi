<?php 

class clsprogramas_update {

    public function updateProgramas($datos){

       
         DB::update('programas', [
           
            'id'             =>  $datos['id'],
            'programa'       =>  $datos['programa'],
            'abreviatura'    =>  $datos['abreviatura'],
            'prefijofolio'   =>  $datos['prefijofolio']

        
         ],"id=%i",$datos['id'] );

           
  
          error_log(" valor de programas actualizados  : " . $datos['id']);

          $data = array('id' => $datos['id']);
   
          return json_encode($data);
    }



}