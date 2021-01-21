<?php
class clsevidencias_nuevo {

    public function nuevoevidencias($datos){
   

        /*

         'incidenteid'    =>  $datos['incidenteid'],
            'nombre'         => $datos['nombre'],
            'cargo'          => $datos['cargo']
        */

         DB::insert('evidencias', [
          

            'nombre'    =>  $datos['nombre'],
            'descripcion'    =>  $datos['descripcion'],
            'ubicacion'    =>  $datos['ubicacion'],
            'tipo'    =>  $datos['tipo'],
            'investigacionid'    =>  $datos['investigacionid'],
            'activo'    =>  $datos['activo'],

           
         ]);

           $id = DB::insertId();
  
          error_log(" valor de id en nuevoevidencias  : " . $id);

          $data = array('id' => $id);
   
          return json_encode($data);
    }



}