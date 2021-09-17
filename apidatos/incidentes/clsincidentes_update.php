<?php
//Use swiftmailer;
require 'traitBuscarId_por_Programa.php';
require 'trait_formarDatosNavegacion.php';


class clsincidentes_update {
use traiBuscarId_por_Programa,trait_formarDatosNavegacion;

    public function updateIncidente($datos,$ROOT_DIR ){

      
     
      date_default_timezone_set('America/Mexico_City');
      $DateAndTime = date('Y-m-d');
        
     /////////////////////////////////////////
      // esta if es para ver si tenemos ya el acta de valoracion , en caso 
      // no tenerla el estado del reporte sera amarillo 
      ///////////////////////////////////////////////////////////////////////////////////////////////////////////
      $color_etapauno = 'yellow';
      $temp_actahechosid = 0;
      error_log(" valor de temp_actahechosid en nuevoIncidente = " . $temp_actahechosid);
   
      if ( isset($datos['actavaloracion_docto']) ) {
           
           //quetipo    
          $quetipo = gettype($datos['actavaloracion_docto']);
          error_log("que tipo de datos = ?? " . $datos['actavaloracion_docto']);
          
          if(strlen($datos['actavaloracion_docto']) == 0){


            error_log("que tipo de datos = ?? " . $datos['actavaloracion_docto']);
            $datos['actavaloracion_docto']= 0;
        
          }

          if ( $datos['actavaloracion_docto'] =="En espera"){

            error_log("que tipo de datos = ?? " . $datos['actavaloracion_docto']);
            $datos['actavaloracion_docto'] = 0;
          
          }
         
           if( $datos['actavaloracion_docto'] == 0) {

                $color_etapauno = 'yellow';
  
            }else {
  
               $color_etapauno     = 'green';
               $temp_actahechosid  = $datos['actavaloracion_docto'];
            }


      }else {
         
        $temp_actahechosid =0;
        $color_etapauno = 'yellow';

      }// termina isset

      /**************************************************** */
    
      DB::update('incidente', [
        
        
        'fechaUpdate'                  =>  $DateAndTime,
       
        'involucrados'                  => $datos['involucrados'],
        'elaboro'                       => $datos['elaboro'], 
        'cargousuario'                  => $datos['cargousuario'],
        'registrohechos'                => $datos['registrohechos'],
        'prefildelagresor'              => $datos['perfildelagresor'] ,
        'paadultocolaborador'           => $datos['paadultocolaborador'],
        'paadultocolaboradortipo'       => $datos['paadultocolaboradortipo'],
        'pafamilia'                     => $datos['pafamilia'],
        'pafamiliatipo'                 => $datos['pafamiliatipo'], 
        'adultoexterno'                 => $datos['adultoexterno'],
        'nnj'                           => $datos['nnj'],
        'perfilvictima'                 => $datos['perfilvictima'],
        'recibeayuda'                   => $datos['recibeayuda'],
        'medidasproinmediatas'          => $datos['medidasproinmediatasdiatas'] ,
        'incidenteconfirmado'           =>  $datos['incidenteconfirmado'],
        'testigos'                      => $datos['testigos'],
        'etapa'                         => $datos['etapa'] ,
        'activo'=> 1,
        'etapauno'                      => $datos['etapauno'] ,
        'etapados'                      => $datos['etapados'] ,
        'etapatres'                     => $datos['etapatres'] ,
        'etapacuatro'                   => $datos['etapacuatro'] ,
        'coloretapauno'                 => $color_etapauno ,
        'coloretapados'                 => $datos['coloretapados'] ,
        'coloretapatres'                => $datos['coloretapatres'] ,
        'coloretapacuatro'              => $datos['coloretapacuatro'],
        'actavaloracion_docto'         =>  $temp_actahechosid
  ],"id=%i",$datos['id']);

 
  
  

  /* ----------------------------------------- */

  /* ------------------------------------------*/
   require $ROOT_DIR .'/apidatos/enviodecorreos/clsEnviarCorreo.php';
     
   $seEnvianLosCorreos  = $_ENV['ENVIO_DE_CORREOS'];
        
   if ($seEnvianLosCorreos =="SI"){
   $enviarCorreo = new clsEnviarCorreo();
   $enviarCorreo->enviarCorreo_version_extendida_nuevoIncidente($resultadoFolio["folio"],$ROOT_DIR);
   }
   $datosNavegacion =$this->getDatosNavegacion($datos['id']);
   $data = array('id'              => $datos['id'],
                 'datosNavegacion' => $datosNavegacion);
  return json_encode($data);



    }
    //apiañldeas sendgrdi 
    //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
  

}//terminaclase