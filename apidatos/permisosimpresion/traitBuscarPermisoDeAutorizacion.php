<?php


trait traitBuscarPermisoDeAutorizacion {

    function buscarPermisoDeAutorizacion($idusuario,$permiso){
      
      $idrolQuery  = "select rol from usuarios where id = " . $idusuario;

      $idrol =  DB::queryFirstField($idrolQuery);

      $query = "select ".  $permiso. " from roles where id = " . $idrol;

      $res = DB::queryFirstField($query);
      
      error_log("respuesta de res " . $res); 
      return $res;

    }
}
