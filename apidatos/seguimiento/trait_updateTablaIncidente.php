<?php 


trait trait_updateTablaIncidente {

    
    function actualizarTablaIncidente($datos){
      /*
      En realidad este campo debiera de llamarse actahechos_docto.

      */

      DB::update('incidente',[ 'actavaloracion_docto' => str_replace('"','',$datos["id_ActaHechos"])], " id=  %i", $datos["incidenteid"]);

     /*
     Se realiza validacion de valoracion inicial
     */

    }//termina funcion


}//termina trait