<?php 


class clsusuarios_getTodosLosusuarios {


    public function getusuarios($id) {

        $results = DB::query("SELECT * FROM usuarios where id =%i " ,$id );

        return json_encode($results);


    }

    public function getTodosLosusuarios() {

        $results = DB::query("SELECT * FROM usuarios " );

        $respuesta= array();
        foreach ($results as $key => $value) {
          /*
    'nombre'    =>  $datos['nombre'],
  'email'    =>  $datos['email'],
  'password'    =>  $datos['password'],
  'rol'    =>  $rolId,
  'programa'    =>  $programID,
  'fechaCreacion'    =>  $date,
  'activo'    =>  $datos['activo'],

          */
          error_log( $value['rol'] );
          error_log( $value['programa'] );
          $rolN = DB::queryFirstField("SELECT NOMBREDELROL FROM roles where id =%i " , $value['rol'] );
          $proN =  DB::queryFirstField("SELECT programa FROM programas where id =%i " , $value['programa'] );
          $value['rol'] =   $rolN;
          $value['programa'] =  $proN ;
          error_log( $value['rol'] );
          error_log( $value['programa'] );
          $respuesta[]= $value;
        }
        return json_encode($respuesta);


       


    }
}