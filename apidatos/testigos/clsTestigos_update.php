<?php 

class clsTestigos_update {

    public function updateTestigo($datos){

        //print_r($datos);
         DB::update('testigoscierre', [

            'incidenteid'    =>  $datos['incidenteid'],
            'nombre'         => $datos['nombre'],
            'cargo'          => $datos['cargo']
         ],"id=%i",$datos['id'] );

           
  
          error_log(" valor de testigos actualizados  : " . $datos['id']);

          $data = array('id' => $datos['id']);
   
          return json_encode($data);
    }



}