<?php

$ruta     = $_ENV['RUTA'];
$ruta_uno  = $ruta . '/apidatos/incidentes/trait_validacionInicial.php';
$ruta_dos  = $ruta . '/apidatos/valoracionintegral/trait_validarValoracion_update.php';
$ruta_tres = $ruta . '/apidatos/denuncialegal/traitValidarDenuncia.php';

$ruta_validacionABordaje = $ruta . '/apidatos/abordaje/traitValidarAbordaje.php';

error_log("ruta uno = " . $ruta_uno);
require ( $ruta_uno);
require ( $ruta_dos);
require ( $ruta_tres);
require ('trait_updateTablaIncidente.php');
require ('trait_updateTablaValoracion.php');
require ('trait_updateTablaDenuncia.php');
require ('trait_updateTablaSeguimiento.php');
require ('trait_updateTablas_despues_de_validarDenuncia.php');
require ('trait_validarSeguimiento.php');

require ('trait_updateTablaAbordaje.php');
require ($ruta_validacionABordaje);

class clsSeguimiento_update {
  
    use trait_validacionInicial ,
        trait_updateTablaIncidente,
        trait_updateTablaValoracion,
        trait_updateTablaDenuncia,
        trait_updateTablaSeguimiento,
        trait_validarValoracion_update,
        trait_updateTablas_despues_de_validarDenuncia,
        trait_validarSeguimiento,
        traitValidarDenuncia,
        trait_updateTablaAbordaje,
        traitValidarAbordaje ;

 public function updateSeguimiento2( $datos ) {
  
  /******************************************
   * ESTRUCTURA DE LOS DATOS QUE SE RECIBEN
  ******************************************

        incidenteid, 
         folio ,
         tipoderespuesta
        'estatus_consenso'                 => $estatusConsenso ,
        'estatus_medidas'                  => $estatusMedidas,
        'estatus_denuncia'                 => $estatusDenunciaPresentada,
        'estatus_notificacionpfn'          => $estatus_notificacionpfn,
        'estatus_notificaciondenunciante'  => $estatus_notificaciondenunciante,
        'estatus_planrecuperacion'         => $estatus_planrecuperacion,
        'id_consensodocto'                 => $idDocumentoConsenso,
        'id_denunciadocto'                 => $idDenuciaPresentada,
        'id_medidasdocto'                  => $idmedidasdisciplinarias,
        'id_Notificacionpfn'               => $idNotificacionpfn,
        'id_NotificacionDenunciante'       => $idNotificacionDenunciante,
        'id_NotificacionPlan'              => $idNotificacionPlan,
        'id_Actavaloracion'                => $idActavaloracion,
        'id_ActaHechos'                    => $idActaHechos,

  
  */

  /*****************************************************************
     ACTUALIZAN DATOS DE LA TABLA INCIDENTE
     - actualiza el campo de acta de hechos
   *****************************************************************/
   $this->actualizarTablaIncidente($datos);
   //---------------------------------------------------------------
   // SE REALIZA LA VALIDACION DE VALORACION INICIAL
   //----------------------------------------------------------------
   $this->validar_valoracionInicial($datos["incidenteid"]);
   /*****************************************************************
     ACTUALIZAN DATOS DE LA TABLA INCIDENTE
     - se actualiza campo con el valor del docto de acta de valoracion
       pero se almacena en 'medidasintegrales'
   *****************************************************************/
  $this->actualizarTablaValoracion($datos);
   //---------------------------------------------------------------
   // SE REALIZA LA VALIDACION DE VALORACION INtegral
   //----------------------------------------------------------------

  $this->validar_valoracionIntegral_desde_otra_etapa( $datos["incidenteid"] );


  $tipoDeRespuesta = $datos["tipoderespuesta"];

  if ($tipoDeRespuesta == "DENUNCIA LEGAL"){

   /*****************************************************************
     ACTUALIZAN DATOS DE LA TABLA DENUNCIALEGAL
     - se actualizan campos consenso y consensodocto
     - se actualizan campos denunciapresentada y docto_denunciapresentada
     - se actualizan campos medidasd y medidas_docto
   *****************************************************************/

  $this->actualizarTablaDenuncia($datos);
  //--------------------------------------------------------------
  // SE REALIZA LA VALIDACION DE LA DENUNCIA
  //--------------------------------------------------------------

  $estaValidadoDenuncia = $this->validar( $datos["incidenteid"] );
  $this->actualizarTablaIncidente_despues_de_validarDenuncia($estaValidadoDenuncia ,$datos["incidenteid"]);
  
}//////// DENUNCIA LEGAL



  if ($tipoDeRespuesta == "ABORDAJE INTERNO"){

  /*****************************************************************
       ACTUALIZAN DATOS DE LA TABLA ABORDAJINTERNO
     - se actualizan campos informaenterector y docto_informenterector
   *****************************************************************/
  //comentarmos por que en seguimiento no mostramos ente rector
 // $this->actualizarTablaAbordaje($datos);

  //--------------------------------------------------------------
  // SE REALIZA LA VALIDACION DEl ABORDAJE INTERNO
  //--------------------------------------------------------------

  $resValidaAbordaje = $this->validarAbordaje($datos["incidenteid"]);

  //--------------------------------------------------------------
  // SE REALIZA LA ACTUALIZACION DE LA ABORDAJE
  //--------------------------------------------------------------
    
  $estado ="abierto";
  $coloretaparespuesta ="yellow";

  if( $resValidaAbordaje == true ) {
    $estado ="cerrado";
    $coloretaparespuesta ="green";
  }

  DB::update('valoracionintegral',
             [ 'estadorespuesta'    => $estado,
               'colorestadorespuesta'=> $coloretaparespuesta],
               "incidenteid=%i",
               $datos['incidenteid'] );

 

   DB::update("abordajinterno",[
    
           "estado" =>  $estado 

       ],"incidenteid=%i",$datos['incidenteid']);

  }////








   /*****************************************************************
     ACTUALIZAN DATOS DE LA TABLA SEGUIMIENTO
     - se actualizan campos notificacionpfn y notificacionpfn_docto
     - se actualizan campos notificaciodenunciante y notificaciondenunciante_docto
     - se actualizan campos planrecuperacion y planrecuperacion_docto
   *****************************************************************/

  $this->actualizarTablaSeguimiento($datos);

  //--------------------------------------------------------------
  // SE REALIZA LA VALIDACION DE LA TABLA SEGUIMIENTO
  //--------------------------------------------------------------
  $tipoderespuesta    = $datos["tipoderespuesta"];
  $estado_seguimiento = "abierto";
  $estado_seguimiento = $this->validarSeguimiento($datos["incidenteid"],  $tipoderespuesta);

  $data =  array(
          
    'msg' => 'ok',
    'estado'=>$estado_seguimiento

  );

  return json_encode($data);
   
 }//termina funcion updateSeguimiento2


}//termina clase