<?php


trait traitBuscarProgramaDeUsuario {

    function buscar_programaId_x_idusuario($idusuario){
      
          
      $query = "select programa from usuarios where id = " .$idusuario;

      $res = DB::queryFirstField($query);
      
      error_log("respuesta de res " . $res); 
      return $res;

    }
}
