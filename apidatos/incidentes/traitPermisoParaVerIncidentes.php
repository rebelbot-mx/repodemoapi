<?php
trait traitPermisoParaVerIncidentes{
 
  function  permisoParaVerLosincidente($id) {

    $rolid = DB::queryFirstField("select rol from usuarios where id = %i",$id);

    $queIncidentesPuedeVer =  DB::queryFirstField("select VISIBILIDADDEINCIDENTES from roles where id = %i",$rolid);

    return $queIncidentesPuedeVer;
    
    }

}