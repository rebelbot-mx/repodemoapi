<?php




trait trait_totales_topologia {




    function buscarTotales_topologia( $fi, $ff, $tipo ) {


        $mes =  explode('-',$fi);
        $SQL_CONSULTA_TOPOLOGIAINCIDENTE_INTERNO = "SELECT count(*) FROM incidente i join valoracionintegral vi on vi.incidenteid = i.id where vi.tipologiadelincidente like 'interno'";

        $SQL_CONSULTA_TOPOLOGIAINCIDENTE_EXTERNO = "SELECT count(*) FROM incidente i join valoracionintegral vi on vi.incidenteid = i.id where vi.tipologiadelincidente like 'externo'";
        
        $QUERY_INTERNO = "";

        $QUERY_EXTERNO = "";

        if($tipo == 2 ){

       
                /*-----------------------------------------------------*/
             $d  = "  and YEAR(i.fechaAlta)='".  $fi ."' and MONTH(i.fechaAlta)='".  $mes[1] ."' ";
             $d2 = "  YEAR(i.fechaAlta)='".  $fi ."' and MONTH(i.fechaAlta)='".  $mes[1] ."' ";
        
             $QUERY_INTERNO =  $SQL_CONSULTA_TOPOLOGIAINCIDENTE_INTERNO . $d;

             $QUERY_EXTERNO =  $SQL_CONSULTA_TOPOLOGIAINCIDENTE_EXTERNO . $d;

             error_log(" tipo  2");

             error_log($QUERY_INTERNO);
             error_log( $QUERY_EXTERNO);

             }
             else {
             
                $d =  " and fechaAlta BETWEEN CAST('". $fi  ."' AS DATE) AND CAST('". $ff  ."' AS DATE) ";
                $d2 = " fechaAlta BETWEEN CAST('". $fi  ."' AS DATE) AND CAST('". $ff  ."' AS DATE) ";
           
                $QUERY_INTERNO =  $SQL_CONSULTA_TOPOLOGIAINCIDENTE_INTERNO . $d;

                $QUERY_EXTERNO =  $SQL_CONSULTA_TOPOLOGIAINCIDENTE_EXTERNO . $d;
                
                error_log(" tipo  else ");
                error_log( $QUERY_INTERNO);
                error_log( $QUERY_EXTERNO);

        
             }//termina 

             $resultado = array();

             $cuantosInternos = DB::queryFirstField($QUERY_INTERNO);

             $cuantosExternos = DB::queryFirstField($QUERY_EXTERNO);

             array_push($resultado, $cuantosInternos);

             array_push($resultado, $cuantosExternos);

             return $resultado;

    }
}