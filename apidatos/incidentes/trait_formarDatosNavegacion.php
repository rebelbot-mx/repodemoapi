<?php


trait trait_formarDatosNavegacion{

   function getDatosNavegacion($id){
     
    /*
           verVInicial        : false,
           verVIntegral       : false,
           verInvestigacion   : false,
           verDenuncia        : false,
           verAbordaje        : false,
           verSeguimiento     : false,
           verCierre          : false,
           colorVinicial      : 'yellow',
           colorVintegral     : 'yellow',
           colorInvestigacion : 'yellow',
           colorDenuncia      : 'yellow',
           colorAbordaje      : 'yellow',
           colorSeguimiento   : 'yellow',
           colorCierre        : 'yellow',

    */
    /************************************************************************* */
    // validando la etapa de valoracion inicial.
    /************************************************************************* */
    error_log(" getDatosNavegacion  id " .  $id);
    $existeIncidente =  DB::queryFirstField("select count(*) from incidente where id = %i",$id);
    $existeincidente_res = false;

    $existeIncidente == 0  ? $existeincidente_res = false : $existeincidente_res = true ;
    
    error_log(" getDatosNavegacion  existeIncidente " .  $existeIncidente);
   
    $color_etapa_uno ='yellow';
    $color_etapa_cierre = 'yellow';   

    if($existeincidente_res == true ){


    $incidente = DB::queryFirstRow("select * from incidente where id = %i", $id);
    $incidente["actavaloracion_docto"]== 0 ? $color_etapa_uno ='yellow' : $color_etapa_uno ='green' ; 
    $incidente["estado"]== 'cerrado' ? $color_etapa_cierre ='green' : $color_etapa_cierre ='yellow' ; 
   
    }

    


    error_log(" getDatosNavegacion  color_etapa_cierre " .  $color_etapa_cierre);
    error_log(" getDatosNavegacion  color_etapa_uno " .     $color_etapa_uno);

    /************************************************************************* */
    // validando la etapa de valoracion integral.
    /************************************************************************* */
   
    $existeVintegral     = DB::queryFirstField("select count(*) from valoracionintegral where incidenteid = %i",$id);
    $existeVintegral_res = false;
    $existeVintegral == 0 ? $existeVintegral_res = false : $existeVintegral_res = true ;
   
    $colorVintegral = 'yellow';
    
    if ($existeVintegral_res == true ){
      $valoracionIntegral  = DB::queryFirstRow("select * from valoracionintegral where incidenteid = %i",$id);
      $valoracionIntegral["estado"] == 'cerrado' ?  $colorVintegral = 'green' :  $colorVintegral = 'yellow';
    
    }
   
    error_log(" getDatosNavegacion  existeVintegral " .  $existeVintegral);
    error_log(" getDatosNavegacion  colorVintegral " .  $colorVintegral);
    /************************************************************************* */
    /************************************************************************* */
    // validando la etapa de investigacion.
    /************************************************************************* */
   
    $existen_INVESTIGACION     = DB::queryFirstField("select count(*) from investigacion where incidenteid = %i",$id);
    $existen_INVESTIGACION_res = false;
    $existen_INVESTIGACION == 0 ? $existen_INVESTIGACION_res = false : $existen_INVESTIGACION_res = true ;
   
    error_log(" getDatosNavegacion  existeInvestigacion " .  $existen_INVESTIGACION);
    $colorn_INVESTIGACION = 'yellow';

    if($existen_INVESTIGACION_res==true) {
   
    $INVESTIGACION  = DB::queryFirstRow("select * from investigacion where incidenteid = %i",$id);
    
    error_log(" estado de la investigacion " .  $INVESTIGACION["estado"]); 

    $INVESTIGACION["estado"] == 'cerrado' ?  $colorn_INVESTIGACION = 'green' :  $colorn_INVESTIGACION = 'yellow';
    }
    /************************************************************************* */

     /************************************************************************* */
    // validando la etapa denuncia
    /************************************************************************* */
    $existen_denuncialegal     = DB::queryFirstField("select count(*) from denuncialegal where incidenteid = %i",$id);
    $existen_denuncialegal_res = false;
    $existen_denuncialegal == 0 ? $existen_denuncialegal_res = false : $existen_denuncialegal_res = true ;
    error_log(" getDatosNavegacion  existen_denuncialegal " .  $existen_denuncialegal);
    $colorn_denuncialegal = 'yellow';

    if ($existen_denuncialegal_res==true){
     $denuncialegal  = DB::queryFirstRow("select * from denuncialegal where incidenteid = %i",$id);
   
    $denuncialegal["estado"] == 'cerrado' ?  $colorn_denuncialegal = 'green' :  $colorn_denuncialegal = 'yellow';
      
    }
  
     /************************************************************************* */
    // validando la etapa abordaje
    /************************************************************************* */
    $existen_abordaje     = DB::queryFirstField("select count(*) from abordajinterno where incidenteid = %i",$id);
    $existen_abordaje_res = false;
    $existen_abordaje == 0 ? $existen_abordaje_res = false : $existen_abordaje_res = true ;
    error_log(" getDatosNavegacion  existen_abordaje " .  $existen_abordaje);
    $colorn_abordaje = 'yellow';

    if($existen_abordaje_res == true ) {

    $abordaje  = DB::queryFirstRow("select * from abordajinterno where incidenteid = %i",$id);
  
    $abordaje["estado"] == 'cerrado' ?  $colorn_abordaje = 'green' :  $colorn_abordaje = 'yellow';
    }
    /************************************************************************* */
    // validando la etapa seguimiento
    /************************************************************************* */
    $existen_seguimiento     = DB::queryFirstField("select count(*) from seguimiento where incidenteid = %i",$id);
    $existen_seguimiento_res = false;
    $existen_seguimiento == 0 ? $existen_seguimiento_res = false : $existen_seguimiento_res = true ;
   
    $colorn_seguimiento = 'yellow';
    error_log(" getDatosNavegacion  existen_seguimiento " .  $existen_seguimiento);
    if ($existen_seguimiento_res == true ) {
    $seguimiento  = DB::queryFirstRow("select * from seguimiento where incidenteid = %i",$id);
    
    $seguimiento["estado"] == 'cerrado' ?  $colorn_seguimiento = 'green' :  $colorn_seguimiento = 'yellow';
    }
    /************************************************************************* */
    // validando la etapa cierre
    /************************************************************************* */
    $existen_seguimiento     = DB::queryFirstField("select count(*) from seguimiento where incidenteid = %i",$id);
    $existen_seguimiento_res = false;
    $existen_seguimiento == 0 ? $existen_seguimiento_res = false : $existen_seguimiento_res = true ;
   
    $colorn_seguimiento = 'yellow';
    error_log(" getDatosNavegacion  existen_seguimiento " .  $existen_seguimiento);
    if ( $existen_seguimiento_res == true ){
    $seguimiento  = DB::queryFirstRow("select * from seguimiento where incidenteid = %i",$id);

    $seguimiento["estado"] == 'cerrado' ?  $colorn_seguimiento = 'green' :  $colorn_seguimiento = 'yellow';
    }

      error_log(" existe investigacion " . $existen_INVESTIGACION_res);
      error_log(" colorn_INVESTIGACION  " . $colorn_INVESTIGACION);
    if (  $existen_INVESTIGACION_res == true  && $colorn_INVESTIGACION =='yellow' ){
      error_log(" existe investigacion condicion se cumple" . $existen_INVESTIGACION_res);
      error_log(" colorn_INVESTIGACION  condicion de cumple " . $colorn_INVESTIGACION);
      $existeVintegral_res = false;
      $colorVintegral = 'yellow';
      error_log("   " . $colorVintegral. " -- " . $existeVintegral_res );
    }
   
    $respuesta = array(
        'verVInicial'        => true,
        'verVIntegral'       => $existeVintegral_res,
        'verInvestigacion'   => $existen_INVESTIGACION_res,
        'verDenuncia'        => $existen_denuncialegal_res,
        'verAbordaje'        => $existen_abordaje_res,
        'verSeguimiento'     => $existen_seguimiento_res,
        'verCierre'          => $existen_seguimiento_res,
        'colorVinicial'      => $color_etapa_uno,
        'colorVintegral'     => $colorVintegral,
        'colorInvestigacion' => $colorn_INVESTIGACION,
        'colorDenuncia'      => $colorn_denuncialegal,
        'colorAbordaje'      => $colorn_abordaje,
        'colorSeguimiento'   => $colorn_seguimiento,
        'colorCierre'        => $color_etapa_cierre,
        'id'                 => $id
    );


    error_log("impresion el array de datos de navegacion");
    error_log($respuesta['verVInicial']);
    error_log($respuesta['verVIntegral']);
    error_log($respuesta['verInvestigacion']);
    error_log($respuesta['verDenuncia']);
    error_log($respuesta['verAbordaje']);

    error_log($respuesta['verSeguimiento']);
    error_log($respuesta['verCierre']);
    error_log($respuesta['colorVinicial']);
    error_log($respuesta['colorVintegral']);
    error_log($respuesta['colorInvestigacion']);

    error_log($respuesta['colorDenuncia']);
    error_log($respuesta['colorAbordaje']);
    error_log($respuesta['colorSeguimiento']);
    error_log($respuesta['colorCierre']);
    error_log($respuesta['id']);


    return $respuesta;

   }

}