<?php

class clspermisosimpresion_autorizar{

    public function updatepermisosimpresion($datos){
        
        $r = $datos['respuesta'];
        $d = $datos['usuarioidautorizo'];
        $id = $datos['id'];
        error_log($r . ' -- ' . $d . ' ----' .$id);
        date_default_timezone_set('America/Mexico_City');
        $DateAndTime = date('Y-m-d');
        DB::update('permisosimpresion', [

        'respuesta'    =>  $datos['respuesta'],
        'usuarioidautorizo'    =>  $datos['usuarioidautorizo'],
        'fechaautorizacion'    =>  $DateAndTime,
       
        ],"id=%i",$datos['id'] );

          
 
        

         $data = array('id' => $datos['id']);
  
         return json_encode($data);
   }





}