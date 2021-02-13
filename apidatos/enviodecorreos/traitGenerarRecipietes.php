<?php 

trait traitGenerarRecipietes {

    function listaDeCorreos(){

        //1.- buscar los roles que tienen el permiso de  RECIBIRCORREOS
        //2.-buscar los usuarios con esos roles 
        //3. obtner sus datos 

        $roles = DB::queryRaw("SELECT * FROM `usuarios` WHERE rol in (select id from roles where RECIBECORREOS ='SI')");



        return $roles;    
    


    }


}