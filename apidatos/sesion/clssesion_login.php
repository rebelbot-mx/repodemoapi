<?php 


class clssesion_login {


    public function getSesion($correo, $pass) {

        $sql = "SELECT * FROM usuarios where email = '".  $correo  ."'  and password ='". $pass  ."' ";

        $results = DB::queryFirstRow($sql);

        $cuantos = isset($results);

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

 
            $respuesta["msg"]= "Datos del registro";
            $respuesta["usuario"]=  $results;
            $respuesta["rol"]= $rol;

             return json_encode($respuesta);


        }


  

      


    }
}