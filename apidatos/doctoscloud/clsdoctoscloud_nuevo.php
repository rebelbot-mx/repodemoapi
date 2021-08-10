<?php
class clsdoctoscloud_nuevo {

    public function nuevodoctoscloud($datos){
   

      

        date_default_timezone_set('America/Mexico_City');
        $date = date("Y-m-d H:i:s");  
          
         DB::insert('doctos', [
             'incidenteId'    => $datos['incidenteId'],
             'nombreOriginal' => $datos['nombreOriginal'],
             'ext'            => $datos['ext'],
             'fechaCreacion'  => $date,
             'fechaUpdate'    => $date,
             'nombreinterno'  =>  $datos['nombreinterno'],
             'directorio'     =>  $datos['directorio'],
      ]);
     
         $id = DB::insertId();

         $data = array('id' => $id,
                       'nombreOriginal'=> $datos['nombreOriginal'],
                       'nombreinterno'=> $datos['nombreinterno']
                    );
             
         return json_encode($data);
    }



}