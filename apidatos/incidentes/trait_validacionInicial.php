<?php 



trait trait_validacionInicial {

    function validar_valoracionInicial($id){

        error_log("En validacion de valoracion inicial");
        
        $incidente = DB::queryFirstRow("select * from incidente where id = %i", $id);

        $color_etapa_uno ='yellow';

        $incidente["actavaloracion_docto"]== 0 ? $color_etapa_uno ='yellow' : $color_etapa_uno ='green' ; 

        error_log("En validacion de valoracion inicial color_etapa_uno " . $color_etapa_uno);

       DB::update ('incidente',['coloretapauno' => $color_etapa_uno ], "id=%i", $id);
   
    }


}