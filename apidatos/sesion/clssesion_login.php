<?php 

require ('traitToken.php');

class clssesion_login {
use traitToken;

    public function getSesion($correo, $pass) {

       error_log("en sesioni");
       error_log($correo);
       error_log($pass);

        $sql = "SELECT * FROM usuarios where email = '".  $correo  ."'  and password ='". $pass  ."' ";
        
        error_log($sql); 

        $results = DB::queryFirstRow($sql);

        $cuantos = isset($results);

        error_log($cuantos); 

        $respuesta = array();

        if ($cuantos== 0){

            $respuesta["msg"]= "No hay registro";

            return json_encode($respuesta);

        }else {

            $sqlrol = "SELECT * FROM roles where id = " .$results['rol'] ;

            $rol = DB::queryFirstRow($sqlrol);


            $proN ="TODOS";
          
            if ( $results['programa']=="0"){
              $proN ="TODOS";
            }else {
              $proN =  DB::queryFirstField("SELECT programa FROM programas where id =%i " , $results['programa'] );
           
            }
            $rolN = DB::queryFirstField("SELECT NOMBREDELROL FROM roles where id =%i " , $results['rol'] );
            $results['rol'] =   $rolN;
            $results['programa'] =  $proN ;

            $token = $this->getToken();

 
            $respuesta["msg"]= "Datos del registro";
            $respuesta["usuario"]=  $results;
            $respuesta["rol"]= $rol;
            $respuesta["token"]= $token;

             return json_encode($respuesta);


        }


  

      


    }
}