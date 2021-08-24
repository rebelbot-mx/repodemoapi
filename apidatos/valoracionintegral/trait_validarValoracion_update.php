<?php


trait trait_validarValoracion_update {


    function validar_valoracionIntegral_desde_otra_etapa($id) {

       $datos = DB::queryFirstRow("select * from valoracionintegral where incidenteid = %i ", $id);


        $r1 = 0;
        $datos["textovi"] == "En Proceso de Valoracion" ? $r1 = 1 : $r1 =0;



        $r2 = 0;
        $datos["tipologiadelincidente"] == "En Proceso de Valoracion" ? $r2 = 1 : $r2 =0;

        $r3 = 0;
        $datos["niveldelincidente"] == "En Proceso de Valoracion" ? $r3 = 1 : $r3 =0;

        $r4 = 0;
        $datos["tipodecaso"] == "En Proceso de Valoracion" ? $r4 = 1 : $r4 =0;

        $tempmedidas = str_replace('"','',  $datos["medidasintegrales"]);
        $r5 = 0;
        $tempmedidas == 0 ? $r5 = 1 : $r5 =0;

        $l =  $datos["textovi"];
        $longitud = strlen( $l );

        $r6 = 0;

        $longitud > 10 ? $r6 =0 : $r6 =1 ;
        
        $suma = 0;

        error_log(" validando ");
        error_log($r1);
        error_log($r2);
        error_log($r3);
        error_log($r4);
        error_log($r5);
        error_log($r6);

        $suma = $r1 + $r2 + $r3 + $r4 + $r5 + $r6;
        error_log("suma = " . $suma);
        
        $respuesta  = 'abierto';
        $color = 'yellow';

       if ( $suma == 0  ) {
             
          $respuesta = 'cerrado';
          $color = 'green';
       

       }

       if ( $suma > 0){

           $respuesta ='abierto';
           $color = 'yellow';

       }

       error_log("valor de la validaacion " .  $respuesta);

       db::update('incidente', ['coloretapados' => $color ] , "id =%i",$id);

       db::update('valoracionintegral', ['estado' => $respuesta ] , "incidenteid =%i",$id);
       
      // return $respuesta;


    }
}