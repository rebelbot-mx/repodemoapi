<?php 

class clsTestigos_nuevo {

    public function nuevoTestigo($datos){


         DB::insert('testigoscierre', [

            'incidenteid'    =>  $datos['incidenteid'],
            'nombre'         => $datos['nombre'],
            'cargo'          => $datos['cargo']
         ]);

           $id = DB::insertId();
  
          error_log(" valor de id en nuevoTestigo  : " . $id);

          $data = array('id' => $id);
   
          return json_encode($data);
    }



}