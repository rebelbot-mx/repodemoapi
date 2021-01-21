<?php

class clsprogramas_nuevo {

    public function nuevoprogramas($datos){
   

        /*

         'incidenteid'    =>  $datos['incidenteid'],
            'nombre'         => $datos['nombre'],
            'cargo'          => $datos['cargo']
        */

         DB::insert('programas', [
          
           
            'programa'    =>  $datos['programa'],
            'abreviatura'    =>  $datos['abreviatura'],
            'prefijofolio'    =>  $datos['prefijofolio']

           
         ]);

           $id = DB::insertId();
  
          error_log(" valor de id en nuevoprogramas  : " . $id);

          $data = array('id' => $id);
   
          return json_encode($data);
    }



}