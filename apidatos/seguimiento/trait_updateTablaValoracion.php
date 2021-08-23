<?php 


trait trait_updateTablaValoracion {

    
    function actualizarTablaValoracion($datos){

      DB::update('valoracionintegral',[ 'medidasintegrales' => str_replace('"','',$datos["id_Actavaloracion"])], " incidenteid=  %i", $datos["incidenteid"]);

    }//termina funcion


}//termina trait