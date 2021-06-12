<?php
class clsdoctosapoyo_nuevo {

    public function nuevodoctosapoyo($datos){
   

        /*

         'incidenteid'    =>  $datos['incidenteid'],
            'nombre'         => $datos['nombre'],
            'cargo'          => $datos['cargo']
        */

         DB::insert('doctosapoyo', [
          
           
            'nombredocto'    =>  $datos['nombredocto'],
            'descripcion'    =>  $datos['descripcion'],
            'link'           =>  $datos['link'],
            'categoria'      =>  $datos['categoria'],
            'activo'         =>  $datos['activo'],

           
         ]);

           $id = DB::insertId();
  
          error_log(" valor de id en nuevodoctosapoyo  : " . $id);

          $data = array('id' => $id);
   
          return json_encode($data);
    }



}