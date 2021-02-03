<?php
class clsconciencia_nuevo {

    public function nuevoconciencia($datos){
   

        /*

         'incidenteid'    =>  $datos['incidenteid'],
            'nombre'         => $datos['nombre'],
            'cargo'          => $datos['cargo']
        */

         DB::insert('conciencia', [
          
          
            'estatus'    =>  $datos['estatus'],
            'clasificacion'    =>  $datos['clasificacion'],
            'activo'    =>  $datos['activo'],
            'tipo'    =>  $datos['tipo'],
            'docto'    =>  $datos['docto'],
            'estatusplan'    =>  $datos['estatusplan'],
            
           
         ]);

           $id = DB::insertId();
  
          error_log(" valor de id en nuevoconciencia  : " . $id);

          $data = array('id' => $id);
   
          return json_encode($data);
    }



}