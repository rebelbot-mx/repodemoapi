<?php




trait trait_totales_niveles {




    function buscarTotales_niveles( $fi, $ff, $tipo ) {

        $colores =[ "rgb(255, 99, 132)",
        "rgb(255, 159, 64)",
        "rgb(255, 205, 86)",
        "rgb(75, 192, 192)",
        "rgb(54, 162, 235)",
        "rgb(153, 102, 255)",
        "rgb(201, 203, 207)",
        "rgb(195, 103, 207)",
        "rgb(103, 162, 155)",
    ];


        $matriz_incidentes = [
                              "Comportamiento Inapropiado",
                              "Comportamiento Abusivo",
                              "Comportamiento Problemático A-N(Adulto-Niño) ",
                              "Comportamiento abusivo N-N(Niño-Niño)","Crítico",
                              "De alto Perfil"];


        $mes =  explode('-',$fi);

        $QUERY = "";

        //VARIABLE EN DONDE SE GUARDAN LOS TOTALS
        $resultadoS_estadisticos = array();

        //Array que guardara los colores
        $ARRAY_DE_COLORES =array();

        $i= 0;


        foreach ($matriz_incidentes as  $value) {
            # code...

            $SQL_CONSULTA_NIVELS = "SELECT count(*) FROM incidente i join valoracionintegral vi on vi.incidenteid = i.id where vi.niveldelincidente like '". $value ."'";
            
            // construccion de query
            if($tipo == 2 ){
                /*-----------------------------------------------------*/
                $d  = "  and YEAR(i.fechaAlta)='".  $fi ."' and MONTH(i.fechaAlta)='".  $mes[1] ."' ";
                $d2 = "  YEAR(i.fechaAlta)='".  $fi ."' and MONTH(i.fechaAlta)='".  $mes[1] ."' ";
                $QUERY =  $SQL_CONSULTA_NIVELS .  $d;
                error_log(" tipo  2");

                
                }
                else {
                
                    $d =  " and fechaAlta BETWEEN CAST('". $fi  ."' AS DATE) AND CAST('". $ff  ."' AS DATE) ";
                    $d2 = " fechaAlta BETWEEN CAST('". $fi  ."' AS DATE) AND CAST('". $ff  ."' AS DATE) ";
                    $QUERY =  $SQL_CONSULTA_NIVELS .  $d; 
                    error_log(" tipo  else ");

            
                }//termina  construeccion de    QUERY     


                $cuantosInternos = DB::queryFirstField($QUERY);

                array_push($resultadoS_estadisticos,  $cuantosInternos );
                
                array_push( $ARRAY_DE_COLORES, $colores[$i]);
                
                $i++;
        }//TERMINA FOREACH

     
             $resultado["labels"] = $matriz_incidentes;
             $resultado["datos"]  = $resultadoS_estadisticos;
             $resultado["colores"] = $ARRAY_DE_COLORES;
             //var_dump( $ARRAY_DE_COLORES);

             return $resultado;

    }
}