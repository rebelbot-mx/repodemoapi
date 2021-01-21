<?php

class clscargos_nuevo {

    public function nuevocargos($datos){
   

        /*

         'incidenteid'    =>  $datos['incidenteid'],
            'nombre'         => $datos['nombre'],
            'cargo'          => $datos['cargo']
        */

         DB::insert('cargos', [
          
          
            'nombrecargo'    =>  $datos['nombrecargo'],
            'descripcion'    =>  $datos['descripcion'],
            'activo'    =>  $datos['activo']

           
         ]);

           $id = DB::insertId();
  
          error_log(" valor de id en nuevocargos  : " . $id);

          $data = array('id' => $id);
   
          return json_encode($data);
    }



}