<?php




trait trait_incidentes_x_programa {


   function generar_incidentes_x_programa($fi, $ff, $tipo){

    error_reporting(E_ERROR | E_PARSE);
    
     $sql_abierto="";
     $sql_cerrado = "";

     $predicado_fecha = "";

     $mes =  explode('-',$fi);
     
     $todosLosProgramas  = " select * from programas";
     $programas =  DB::query($todosLosProgramas);

     $cuantoProgramas = DB::queryFirstField("select count(*) from programas");

     $respuesta =Array();



     if($tipo == 2 ){

     
    for ($i=0; $i <$cuantoProgramas ; $i++) { 
        # code...
        $programaid = 0;
        $programaNombre = "";
        
        $programaid = $programas[$i]["id"];
        $programaNombre = $programas[$i]["programa"];


        /*-----------------------------------------------------*/
     $d  = "  and YEAR(fechaAlta)='".  $fi ."' and MONTH(fechaAlta)='".  $mes[1] ."' and programa = " . $programaid;
     $d2 = "  YEAR(fechaAlta)='".  $fi ."' and MONTH(fechaAlta)='".  $mes[1] ."'  and programa = " . $programaid;

-
     $sql_todos =  "select count(*) from incidente where  " . $d2 ;

     $sql_abierto ="select count(*) from incidente where estado = 'abierto' " .$d;
     $sql_cerrado ="select count(*) from incidente where estado = 'cerrado' " .$d;
     $sql_cerrado_x_ni = "select count(*) from incidente where estado = 'cerrado_x_ni' " .$d;
     $sql_p ="select count(*) from incidente where estado = 'pendiente' " .$d;

     /*-----------------------------------------------------*/
     $todos =         DB::queryFirstField( $sql_todos); 

     $abiertos =      DB::queryFirstField( $sql_abierto);
     $cerrados =      DB::queryFirstField( $sql_cerrado);
     $cerrados_x_ni = DB::queryFirstField( $sql_cerrado_x_ni);

     $totalCerrads   =  $cerrados + $cerrados_x_ni;
     $totalAbiertos  =  $todos -$totalCerrads;

     if ($todos !=0){
     $porcentajeAbiertos = ($totalAbiertos * 100) / $todos; 
     $porcentajeCerrados = ($totalCerrads * 100) / $todos; }
     else {

        $porcentajeAbiertos = 0; 
        $porcentajeCerrados =0; 

     }

     $res["id"] = $i;
     $res["programa"] = $programaNombre;
     $res["TotalIncidenteAbiertos"] = $totalAbiertos;
     $res["TotalIncidenteCerrados"] = $totalCerrads;
     $res["TotalIncidentePendientes"] = 0;
     $res["porcentajeAbiertos"] = $porcentajeAbiertos;
     $res["porcentajeCerrados"] = $porcentajeCerrados;

     $respuesta[$i] = $res;


    }// termina for








     }else {


        for ($i=0; $i <$cuantoProgramas ; $i++) { 
            # code...
            
            $programaid = $programas[$i]["id"];
            $programaNombre = $programas[$i]["programa"];

            /*---------------------------------------------*/


                        /*-----------------------------------------------------*/

       /*SELECT *
        FROM order_details
        WHERE order_date BETWEEN CAST('2014-02-01' AS DATE) AND CAST('2014-02-28' AS DATE);
        */

        $d =  " and fechaAlta BETWEEN CAST('". $fi  ."' AS DATE) AND CAST('". $ff  ."' AS DATE) and programa = " .$programaid;
        $d2 = " fechaAlta BETWEEN CAST('". $fi  ."' AS DATE) AND CAST('". $ff  ."' AS DATE) and programa = " .$programaid;
   
        
        $sql_todos =  "select count(*) from incidente where  " .$d2;
   
        $sql_abierto ="select count(*) from incidente where estado = 'abierto' " .$d;
        $sql_cerrado ="select count(*) from incidente where estado = 'cerrado' " .$d;
        $sql_cerrado_x_ni = "select count(*) from incidente where estado = 'cerrado_x_ni' " .$d;
        $sql_p ="select count(*) from incidente where estado = 'pendiente' " .$d;
  
        /*-----------------------------------------------*/


        $todos =DB::queryFirstField( $sql_todos); 
   
        $abiertos = DB::queryFirstField( $sql_abierto);
        $cerrados = DB::queryFirstField( $sql_cerrado);
        $cerrados_x_ni = DB::queryFirstField( $sql_cerrado_x_ni);
   
        $totalCerrads = $cerrados + $cerrados_x_ni;
        $totalAbiertos  =  $todos -$totalCerrads;
       
        $res["TotalIncidenteAbiertos"] = $totalAbiertos;
        $res["TotalIncidenteCerrados"] = $totalCerrads;
        $res["TotalIncidentePendientes"] = 0;
      
        if($todos !=0){
        $porcentajeAbiertos = ($totalAbiertos * 100) / $todos; 
        $porcentajeCerrados = ($totalCerrads * 100) / $todos; 
        }else {
            $porcentajeAbiertos = 0; 
            $porcentajeCerrados =0;

        }
      
 

        $res["id"] = $i;
        $res["programa"] = $programaNombre;
        $res["TotalIncidenteAbiertos"] = $totalAbiertos;
        $res["TotalIncidenteCerrados"] = $totalCerrads;
        $res["TotalIncidentePendientes"] = 0;
        $res["porcentajeAbiertos"] = $porcentajeAbiertos;
        $res["porcentajeCerrados"] = $porcentajeCerrados;
   
        $respuesta[$i] = $res;

    
        }//termina for




     }
     

     /*$res["q1"] = $sql_abierto;
     $res["q2"] = $sql_cerrado;
     $res["q3"] = $sql_cerrado_x_ni;
     $res["q4"] = $sql_todos;*/

     return $respuesta;


   }


}