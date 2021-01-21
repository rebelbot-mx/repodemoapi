<?php
class clsusuarios_nuevo {

    public function nuevousuarios($datos){
   

        /*

         'incidenteid'    =>  $datos['incidenteid'],
            'nombre'         => $datos['nombre'],
            'cargo'          => $datos['cargo']
        */

        /*   */
        
        $programID = 0;
        $rolId = 0;
        $aqueProgramaPertenece =  $datos['programa'];

        if ($aqueProgramaPertenece=="TODOS"){
            $programID = 0;
           
        }else 
        {
            $programID = DB::queryFirstField("SELECT id FROM programas where programa =%s " , $datos['programa'] );
          
        }
      
        $rolId    = DB::queryFirstField("SELECT id FROM roles where NOMBREDELROL =%s " , $datos['rol'] );
     
        date_default_timezone_set('America/Mexico_City');
        $date = date("Y-m-d H:i:s");  


         DB::insert('usuarios', [
          
         
  'nombre'    =>  $datos['nombre'],
  'email'    =>  $datos['email'],
  'password'    =>  $datos['password'],
  'rol'    =>  $rolId,
  'programa'    =>  $programID,
  'fechaCreacion'    =>  $date,
  'activo'    =>  $datos['activo'],

           
         ]);

           $id = DB::insertId();
  
          error_log(" valor de id en nuevousuarios  : " . $id);

          $data = array('id' => $id);
   
          return json_encode($data);
    }



}