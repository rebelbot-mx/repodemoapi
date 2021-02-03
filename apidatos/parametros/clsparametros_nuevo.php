<?php
class clsparametros_nuevo {

    public function nuevoparametros($datos){
   

        /*

         'incidenteid'    =>  $datos['incidenteid'],
            'nombre'         => $datos['nombre'],
            'cargo'          => $datos['cargo']
        */

         DB::insert('parametros', [
      
  'nombreParametro'    =>  $datos['nombreParametro'],
  'descripcion'    =>  $datos['descripcion'],
  'valor'    =>  $datos['valor'],

           
         ]);

           $id = DB::insertId();
  
          error_log(" valor de id en nuevoparametros  : " . $id);

          $data = array('id' => $id);
   
          return json_encode($data);
    }



}