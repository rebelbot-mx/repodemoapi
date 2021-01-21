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

 
            $respuesta["msg"]= "Datos del registro";
            $respuesta["usuario"]=  $results;
            $respuesta["rol"]= $rol;

             return json_encode($respuesta);


        }


  

      


    }
}