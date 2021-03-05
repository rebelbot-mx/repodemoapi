<?php
//Use swiftmailer;
require 'traitBuscarId_por_Programa.php';



class clsincidentes_update {
use traiBuscarId_por_Programa;

    public function updateIncidente($datos,$ROOT_DIR ){

      
     
      date_default_timezone_set('America/Mexico_City');
      $DateAndTime = date('Y-m-d');
        

    
      DB::update('incidente', [
        
        
        'fechaUpdate'=>  $DateAndTime,
       
        'involucrados'=>  $datos['involucrados'],
        'elaboro'=>  $datos['elaboro'], 
        'cargousuario'=>   $datos['cargousuario'],
        'registrohechos'=>  $datos['registrohechos'],
        'prefildelagresor'=> $datos['perfildelagresor'] ,
        'paadultocolaborador' => $datos['paadultocolaborador'],
        'paadultocolaboradortipo' => $datos['paadultocolaboradortipo'],
        'pafamilia' =>$datos['pafamilia'],
        'pafamiliatipo' =>$datos['pafamiliatipo'], 
        'adultoexterno' => $datos['adultoexterno'],
        'nnj'=> $datos['nnj'],
        'perfilvictima'=>  $datos['perfilvictima'],
        'recibeayuda' => $datos['recibeayuda'],
        'medidasproinmediatas'=> $datos['medidasproinmediatasdiatas'] ,
        'incidenteconfirmado'=>  $datos['incidenteconfirmado'],
        'testigos' => $datos['testigos'],
        'etapa'=> $datos['etapa'] ,
        'activo'=> 1,
        'etapauno'=> $datos['etapauno'] ,
        'etapados'=> $datos['etapados'] ,
        'etapatres'=> $datos['etapatres'] ,
        'etapacuatro'=> $datos['etapacuatro'] ,
        'coloretapauno'=> $datos['coloretapauno'] ,
        'coloretapados'=> $datos['coloretapados'] ,
        'coloretapatres'=> $datos['coloretapatres'] ,
        'coloretapacuatro'=> $datos['coloretapacuatro'],

  ],"id=%i",$datos['id']);

 
  
  

  /* ----------------------------------------- */

  /* ------------------------------------------*/
   require $ROOT_DIR .'/apidatos/enviodecorreos/clsEnviarCorreo.php';
     
   $seEnvianLosCorreos  = $_ENV['ENVIO_DE_CORREOS'];
        
   if ($seEnvianLosCorreos =="SI"){
   $enviarCorreo = new clsEnviarCorreo();
   $enviarCorreo->enviarCorreo_version_extendida_nuevoIncidente($resultadoFolio["folio"],$ROOT_DIR);
   }
   
   $data = array('id' => $datos['id']);
  return json_encode($data);



    }
    //apiañldeas sendgrdi 
    //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
  

}//terminaclase