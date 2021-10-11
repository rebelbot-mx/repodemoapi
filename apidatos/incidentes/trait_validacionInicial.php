<?php 



trait trait_validacionInicial {

    function validar_valoracionInicial($id){

        error_log("En validacion de valoracion inicial");
        
        $incidente = DB::queryFirstRow("select * from incidente where id = %i", $id);

        $color_etapa_uno ='yellow';

        $temp_actavalorcion_docto =  $incidente["actavaloracion_docto"];

        $tipoVariable = gettype(  $temp_actavalorcion_docto );

        error_log( " valor de temp_actavalorcion_docto  :  " . $temp_actavalorcion_docto);

        error_log( " valor de tipoVariable  :  " . $tipoVariable);

        $evaluar = 0;
        if ( $tipoVariable == 'string') {
         
            $evaluar = intval (  $temp_actavalorcion_docto );
        }else {

            $evaluar =  $temp_actavalorcion_docto;
        }
 

        $evaluar == 0 ? 
        $color_etapa_uno ='yellow'             : 
        $color_etapa_uno ='green' ; 

        error_log("En validacion de valoracion inicial color_etapa_uno " . $color_etapa_uno);

        DB::update ('incidente',['coloretapauno' => $color_etapa_uno ], "id=%i", $id);
   
    }


}