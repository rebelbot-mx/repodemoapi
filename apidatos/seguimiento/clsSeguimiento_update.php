<?php

require ('trait_updateTablaIncidente.php');
require ('trait_updateTablaValoracion.php');
require ('trait_updateTablaDenuncia.php');
require ('trait_updateTablaSeguimiento.php');

class clsSeguimiento_update {

    use trait_updateTablaIncidente,
        trait_updateTablaValoracion,
        trait_updateTablaDenuncia,
        trait_updateTablaSeguimiento ;

 public function updateSeguimiento2( $datos ) {
  
  /******************************************
   * ESTRUCTURA DE LOS DATOS QUE SE RECIBEN
  ******************************************

        incidenteid, folio ,tipoderespuesta
        'estatus_consenso'                => $estatusConsenso ,
        'estatus_medidas'                  => $estatusMedidas,
        'estatus_denuncia'                => $estatusDenunciaPresentada,
        'estatus_notificacionpfn'         => $estatus_notificacionpfn,
        'estatus_notificaciondenunciante' => $estatus_notificaciondenunciante,
        'estatus_planrecuperacion'        => $estatus_planrecuperacion,
        'id_consensodocto'                => $idDocumentoConsenso,
        'id_denunciadocto'                => $idDenuciaPresentada,
        'id_medidasdocto'                 => $idmedidasdisciplinarias,
        'id_Notificacionpfn'              => $idNotificacionpfn,
        'id_NotificacionDenunciante'      => $idNotificacionDenunciante,
        'id_NotificacionPlan'             => $idNotificacionPlan,
        'id_Actavaloracion'               => $idActavaloracion,
        'id_ActaHechos'                   => $idActaHechos
  
  */

  /*****************************************************************
     ACTUALIZAN DATOS DE LA TABLA INCIDENTE
     - actualiza el campo de acta de hechos
   *****************************************************************/
   $this->actualizarTablaIncidente($datos);
   
   /*****************************************************************
     ACTUALIZAN DATOS DE LA TABLA INCIDENTE
     - se actualiza campo con el valor del docto de acta de valoracion
       pero se almacena en 'medidasintegrales'
   *****************************************************************/
  $this->actualizarTablaValoracion($datos);

   /*****************************************************************
     ACTUALIZAN DATOS DE LA TABLA DENUNCIALEGAL
     - se actualizan campos consenso y consensodocto
     - se actualizan campos denunciapresentada y docto_denunciapresentada
     - se actualizan campos medidasd y medidas_docto
   *****************************************************************/

  $this->actualizarTablaDenuncia($datos);

   /*****************************************************************
     ACTUALIZAN DATOS DE LA TABLA SEGUIMIENTO
     - se actualizan campos notificacionpfn y notificacionpfn_docto
     - se actualizan campos notificaciodenunciante y notificaciondenunciante_docto
     - se actualizan campos planrecuperacion y planrecuperacion_docto
   *****************************************************************/

  $this->actualizarTablaSeguimiento($datos);

  $data =  array(
          
    'msg' => 'ok',
    'estado'=>'abierto'

  );

  return json_encode($data);
   
 }//termina funcion updateSeguimiento2


}//termina clase