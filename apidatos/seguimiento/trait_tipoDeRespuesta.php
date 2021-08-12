<?php 




trait trait_tipoDeRespuesta{

    
    function queTipoDeIncidente ($id){

        $res = DB::queryFirstField("select tipoderespuesta from valoracionintegral where incidenteid = %i",$id);

        return $res;

    }


    
}