<?php




trait trait_totalIncidentes_Abiertos_Cerrados {


   function generar($fi, $ff, $tipo){


     $sql_abierto="";
     $sql_cerrado = "";

     $predicado_fecha = "";

     $mes =  explode('-',$fi);
     

     if($tipo == 2 ){

     $d =" and YEAR(fechaAlta)='".  $fi ."' and MONTH(fechaAlta)='".  $mes[1] ."'";
     $d2 = "  YEAR(fechaAlta)='".  $fi ."' and MONTH(fechaAlta)='".  $mes[1] ."'";


     $sql_todos =  "select count(*) from incidente where  " .$d2;

     $sql_abierto ="select count(*) from incidente where estado = 'abierto' " .$d;
     $sql_cerrado ="select count(*) from incidente where estado = 'cerrado' " .$d;
     $sql_cerrado_x_ni = "select count(*) from incidente where estado = 'cerrado_x_ni' " .$d;
     $sql_p ="select count(*) from incidente where estado = 'pendiente' " .$d;

     $todos =         DB::queryFirstField( $sql_todos); 

     $abiertos =      DB::queryFirstField( $sql_abierto);
     $cerrados =      DB::queryFirstField( $sql_cerrado);
     $cerrados_x_ni = DB::queryFirstField( $sql_cerrado_x_ni);

     $totalCerrads   =  $cerrados + $cerrados_x_ni;
     $totalAbiertos  =  $todos -$totalCerrads;

     $porcentajeAbiertos = ($totalAbiertos * 100) / $todos; 
     $porcentajeCerrados = ($totalCerrads * 100) / $todos; 

    
     $res["TotalIncidenteAbiertos"] = $totalAbiertos;
     $res["TotalIncidenteCerrados"] = $totalCerrads;
     $res["TotalIncidentePendientes"] = 0;
     $res["porcentajeAbiertos"] = $porcentajeAbiertos;
     $res["porcentajeCerrados"] = $porcentajeCerrados;




     }else {

       /*SELECT *
        FROM order_details
        WHERE order_date BETWEEN CAST('2014-02-01' AS DATE) AND CAST('2014-02-28' AS DATE);
        */

        $d =  " and fechaAlta BETWEEN CAST('". $fi  ."' AS DATE) AND CAST('". $ff  ."' AS DATE)" ;
        $d2 = " fechaAlta BETWEEN CAST('". $fi  ."' AS DATE) AND CAST('". $ff  ."' AS DATE)" ;
   
        
        $sql_todos =  "select count(*) from incidente where  " .$d2;
   
        $sql_abierto ="select count(*) from incidente where estado = 'abierto' " .$d;
        $sql_cerrado ="select count(*) from incidente where estado = 'cerrado' " .$d;
        $sql_cerrado_x_ni = "select count(*) from incidente where estado = 'cerrado_x_ni' " .$d;
        $sql_p ="select count(*) from incidente where estado = 'pendiente' " .$d;
   
        $todos =DB::queryFirstField( $sql_todos); 
   
        $abiertos = DB::queryFirstField( $sql_abierto);
        $cerrados = DB::queryFirstField( $sql_cerrado);
        $cerrados_x_ni = DB::queryFirstField( $sql_cerrado_x_ni);
   
        $totalCerrads = $cerrados + $cerrados_x_ni;
        $totalAbiertos  =  $todos -$totalCerrads;
       
        $res["TotalIncidenteAbiertos"] = $totalAbiertos;
        $res["TotalIncidenteCerrados"] = $totalCerrads;
        $res["TotalIncidentePendientes"] = 0;
      
   
        $porcentajeAbiertos = 0; 
        $porcentajeCerrados = 0; 

        if ($todos !=0 ){
        $porcentajeAbiertos = ($totalAbiertos * 100) / $todos; 
        $porcentajeCerrados = ($totalCerrads * 100) / $todos; 
   
        }
 
        $res["porcentajeAbiertos"] = $porcentajeAbiertos;
        $res["porcentajeCerrados"] = $porcentajeCerrados;



     }
     

     /*$res["q1"] = $sql_abierto;
     $res["q2"] = $sql_cerrado;
     $res["q3"] = $sql_cerrado_x_ni;
     $res["q4"] = $sql_todos;*/

     return $res;


   }


}