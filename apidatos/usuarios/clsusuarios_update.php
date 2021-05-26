<?php 

class clsusuarios_update {

    public function updateusuarios($datos){


        $programID = 0;
        
        $aqueProgramaPertenece =  $datos['programa'];

        $listaDeCorreos_para_enviar =array();

        if ($aqueProgramaPertenece=="TODOS"){
            $programID = 0;

            $rolId    = DB::queryFirstField("SELECT id FROM roles where NOMBREDELROL =%s " , $datos['rol'] );
      
          
        }else 
        {
            $programID = DB::queryFirstField("SELECT id FROM programas where programa =%s " , $datos['programa'] );
            $rolId    = DB::queryFirstField("SELECT id FROM roles where NOMBREDELROL =%s " , $datos['rol'] );
      
        }
      
       
         DB::update('usuarios', [
           
                'id'          =>  $datos['id'],
                'nombre'      =>  $datos['nombre'],
                'email'       =>  $datos['email'],
                'password'    =>  $datos['password'],
                'rol'         =>  $rolId,
                'programa'    =>  $programID,
                'activo'      =>  $datos['activo'],

        
         ],"id=%i",$datos['id'] );


         /* **************************************************************
         Obtenemos lista de usuarios que reciben notificacion por correo 
         *****************************************************************/

        // require $ROOT_DIR .'/apidatos/enviodecorreos/clsEnviarCorreo.php';
        
       //  $usuariosCorreos =  new clsEnviarCorreo();
        
        // $listaDeCorreos_para_enviar= $usuariosCorreos->listaDeCorreos_depurada(); 
        
         /************************************************************** */
            
          error_log(" valor de usuarios actualizados  : " . $datos['id']);

          $data = array(
              'id' => $datos['id'] );
   
          return json_encode($data);
    }



}