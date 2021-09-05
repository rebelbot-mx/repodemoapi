<?php
$ruta     = $_ENV['RUTA'];
$ruta_uno  = $ruta . '/apidatos/incidentes/trait_validacionInicial.php';
$ruta_dos  = $ruta . '/apidatos/valoracionintegral/trait_validarValoracion_update.php';
$ruta_tres = $ruta . '/apidatos/denuncialegal/traitValidarDenuncia.php';
require ('traitValidarAbordaje.php');
require ( $ruta_uno);
require ( $ruta_dos);
require ( $ruta_tres);


class clsAbordaje_update{
    use traitValidarAbordaje,
        trait_validacionInicial,
        trait_validarValoracion_update;


    public function updateAbordaje($parametros){

  

    /*
         incidenteid         
            status        
            plan               
            documentos             
            plan_docto
            documentos_docto 

            incidenteid              : this.incidenteIdPE,        
            status                   : this.$store.state.abordaje.abordaje_status,
            estado_informeenterector : this.$store.state.abordaje.abordaje_informaenterector,
            id_informeenterector     : this.$store.state.abordaje.abordaje_docto_informaenterector,           
           
            estado_pfn               : this.$store.state.abordaje.abordaje_seg_estado_pfn,
            id_pfn                   : this.$store.state.abordaje.abordaje_seg_docto_pfn,
            estado_pd                : this.$store.state.abordaje.abordaje_seg_estado_pd,
            id_pd                    : this.$store.state.abordaje.abordaje_seg_docto_pd,
            estado_pr
            id_pr
            
            id_actahechos            : this.$store.state.abordaje.abordaje_docto_actahecho,
            id_actavaloracion        : this.$store.state.abordaje.abordaje_docto_actavaloracion,

    */
     
      $update  = DB::update('abordajinterno',[

        "status"                   =>    $parametros['status'],
        "plan"                     =>    "",           
        "documentos"               =>    "",           
        "plan_docto"               =>    "",
        "documentos_docto"         =>    "",
        "informaenterector"        =>    str_replace('"','',$parametros["estado_informeenterector"]),
        "docto_informaenterector"  =>    str_replace('"','',$parametros["id_informeenterector"]),
 
      ],"incidenteid=%i",$parametros['incidenteid']);


      $updatex  = DB::update('seguimiento',[

         "notificacionpfn"                =>    $parametros['estado_pfn'],
         "notificaciodenunciante"         =>    $parametros['estado_pd'],           
         "planrecuperacion"               =>    $parametros['estado_pr'],  
         "notificacionpfn_docto"          =>    str_replace('"','', $parametros['id_pfn']),
         "notificaciondenunciante_docto"  =>    str_replace('"','',  $parametros['id_pd']),           
         "planrecuperacion_docto"         =>    str_replace('"','', $parametros['id_pr']),           
 
       ],"incidenteid=%i",$parametros['incidenteid']);


       $updatexx  = DB::update('incidente',[

         "actavaloracion_docto"           =>  str_replace('"','',$parametros['id_actahechos']),

       ],"id=%i",$parametros['incidenteid']);


       $updatexxx  = DB::update('valoracionintegral',[

         "medidasintegrales"           =>  str_replace('"','',$parametros['id_actavaloracion']),

       ],"id=%i",$parametros['incidenteid']);





     //verficamos validacion si ya esta el 
     
     $estado              = "abierto";
     $coloretaparespuesta ="amarillo";


     
     $listaDeCorreos_para_enviar =array();
     $respuestaValidacion = $this->validar( $parametros['incidenteid']) ;

     error_log(" respuesta de validacion abordaje " . $respuestaValidacion);

     if( $respuestaValidacion == true ){
        
        $estado = "cerrado";
        $coloretaparespuesta ="green";
        
     }else {

      $estado = "abierto";
      $coloretaparespuesta ="yellow";

     }

 DB::update('incidente',
        [ 'estado'    =>  'en llenado de seguimiento',],"id=%i",$parametros['incidenteid'] );

     DB::update('valoracionintegral',
        [ 'estadorespuesta'    => $estado,'colorestadorespuesta'=> $coloretaparespuesta],"incidenteid=%i",$parametros['incidenteid'] );

       

         DB::update("abordajinterno",[
          
            "estado" =>  $estado 

         ],"incidenteid=%i",$parametros['incidenteid']);

            /* **************************************************************
            Obtenemos lista de usuarios que reciben notificacion por correo 
            *****************************************************************/

            $raiz = $_ENV['RUTA'];
            require $raiz. '/apidatos/enviodecorreos/clsEnviarCorreo.php';
                         
            $usuariosCorreos =  new clsEnviarCorreo();
        
            $listaDeCorreos_para_enviar= $usuariosCorreos->listaDeCorreos_depurada(); 
        
            /************************************************************** */

          //---------------------------------------------------------------
          // SE REALIZA LA VALIDACION DE VALORACION INICIAL
          //----------------------------------------------------------------
          $this->validar_valoracionInicial($parametros['incidenteid']);  
          //---------------------------------------------------------------
          // SE REALIZA LA VALIDACION DE VALORACION INtegral
          //----------------------------------------------------------------

          $this->validar_valoracionIntegral_desde_otra_etapa( $parametros["incidenteid"] );




          $data = array(
                   'id' => $parametros['incidenteid'], 
                   'estado' => $estado,
                   'correos' =>  $listaDeCorreos_para_enviar );
   
      return json_encode($data);

    }


}