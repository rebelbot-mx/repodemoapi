<?php



trait trait_updateTablaAbordaje {


    function actualizarTablaAbordaje($datos) {
        
         //

         DB::update('abordajinterno' , [
             'informaenterector' => $datos[""],
             'docto_informaenterector' => $datos[""]
         ],
         " incidenteid = %i",
         $datos["incidenteid"]);

    }

}