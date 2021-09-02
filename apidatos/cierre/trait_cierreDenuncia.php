<?php

        /*
      
     
      verInformePatronato                : false,
      verInformeRegional                 : false,
      verInformeEnteRector               : false,
    
      verSoporteLegal                    : false,
      verSoporteEmocional                : false,
    
    
        */


trait trait_cierreDenuncia{

     function getSeguimientoDenuncia($id){
                   
          /************************************************************
           *  valores de la tabla denuncia legal que se mostraran en seguimientos
           * 
           *************************************************************/

          //consenso
          $datosDenuncia =DB::queryFirstRow("select * from denuncialegal where incidenteid  = %i", $id);

          $temp                           = $datosDenuncia["consensodocto"];
          $temp_denunciapresentada        = $datosDenuncia["docto_denunciapresentada"];
          $temp_medidasdisciplinarias     = $datosDenuncia["medidasd_docto"];
          $temp_InformePatronato          = $datosDenuncia["docto_informapatronato"];
          $temp_InformeRegional           = $datosDenuncia["docto_informaoficinaregional"];
          $temp_doctoInformeEnteRector    = $datosDenuncia["docto_informaenterector"];
          $temp_docotoSoporteLegal        = $datosDenuncia["docto_soporteemocional"];
          $temp_doctoSoporteEmocional     = $datosDenuncia["docto_soportelegal"];
    
          $estatusConsenso                = $datosDenuncia["consenso"];
          $estatusDenunciaPresentada      = $datosDenuncia["denunciapresentada"];
          $estatusMedidas                 = $datosDenuncia["medidasd"];

          $idDocumentoConsenso        = str_replace('"','',$temp);
          $idDenuciaPresentada        = str_replace('"','',$temp_denunciapresentada);
          $idmedidasdisciplinarias    = str_replace('"','',$temp_medidasdisciplinarias);
         
          $idInformePatronato          = str_replace('"','',$temp_InformePatronato);
          $idInformeRegional           = str_replace('"','',$temp_InformeRegional);
          $iddoctoInformeEnteRector    = str_replace('"','',$temp_doctoInformeEnteRector);
          $iddocotoSoporteLegal        = str_replace('"','',$temp_docotoSoporteLegal);
          $iddoctoSoporteEmocional     = str_replace('"','',$temp_doctoSoporteEmocional);
    
       
          error_log(" valores  getSeguimientoDenuncia : " );
          error_log(" valores  idDocumentoConsenso    : " . $idDocumentoConsenso );
          error_log(" valores  estatusConsenso        : " . $estatusConsenso );
          error_log(" valores  estatusMedidas         : " . $estatusMedidas );


          error_log(" valores  estatusDenunciaPresentada      : " . $estatusDenunciaPresentada );
          error_log(" valores  idDenuciaPresentada            : " . $idDenuciaPresentada );
          error_log(" valores  idmedidasdisciplinarias        : " . $idmedidasdisciplinarias );
          
          /************************************************************
           *  valores de la tabla seguimiento
           * 
           *************************************************************/
           
          $datosDenuncia_seguimiento =DB::queryFirstRow("select * from seguimiento where incidenteid  = %i", $id);

        /*  notificacionpfn
          notificacionpfn_docto
          notificaciodenunciante
          notificaciondenunciante_docto
          planrecuperacion
          planrecuperacion_docto
          */

          $estatus_notificacionpfn         = $datosDenuncia_seguimiento["notificacionpfn"];
          $estatus_notificaciondenunciante = $datosDenuncia_seguimiento["notificaciodenunciante"];
          $estatus_planrecuperacion        = $datosDenuncia_seguimiento["planrecuperacion"];

          $idNotificacionpfn = str_replace('"','',$datosDenuncia_seguimiento["notificacionpfn_docto"]);

          $idNotificacionDenunciante  =str_replace('"','',$datosDenuncia_seguimiento["notificaciondenunciante_docto"]);

          $idNotificacionPlan  = str_replace('"','',$datosDenuncia_seguimiento["planrecuperacion_docto"]);

          /************************************************************
           *  valores de la tabla incidente  (valoraicion inicial)
           *  - se recupera el acta de valoracion
           ******************************************/

          $idActaHechos =DB::queryFirstField("select actavaloracion_docto from incidente where id  = %i", $id);
        
          //error_log("acta de valroacion id " . $idActavaloracion);
          //$idActavaloracion = str_replace('"','',$datosDenuncia_acta);}
           
          $folio = DB::queryFirstField("select folio from incidente where id  = %i", $id);
        
         

          /************************************************************
           *  valores de la tabla valoracionintegral  (valoraicion inicial)
           *  - se recupera el acta de hechos
           ******************************************/

          $idActavaloracion =DB::queryFirstField("select medidasintegrales from valoracionintegral where incidenteid  = %i", $id);
        
         // error_log("acta de idActaHechos id " . $idActaHechos);
         // $idActaHechos = str_replace('"','',$datosDenuncia_actaValoracion);


          $nombre_documentoConsenso        = $this->cargarNombre($idDocumentoConsenso);
          $nombre_documentoDenuncia        = $this->cargarNombre($idDenuciaPresentada);
          $nombre_documentomedidasdocto    = $this->cargarNombre($idmedidasdisciplinarias);
          $nombre_documentoNotificacionpfn = $this->cargarNombre($idNotificacionpfn);
          $nombre_documentoNotificacionDenunciante = $this->cargarNombre($idNotificacionDenunciante);
          $nombre_documentoNotificacionPlan =  $this->cargarNombre($idNotificacionPlan);
          $nombre_documentoActaValoracion   =  $this->cargarNombre($idActavaloracion);
          $nombre_documentoActaHechos       =  $this->cargarNombre($idActaHechos);
          $nombre_documentoPatronato        =  $this->cargarNombre($idInformePatronato);
          $nombre_documentoRegional         =  $this->cargarNombre($idInformeRegional);
          $nombre_doctoInformeEnteRector    =  $this->cargarNombre($iddoctoInformeEnteRector);
          $nombre_doctoSoporteLegal         =  $this->cargarNombre($iddocotoSoporteLegal);
          $nombre_doctoSoporteEmocional     =  $this->cargarNombre($iddoctoSoporteEmocional);

       
          $sePuedeCerrarPorEstados = $this->sePuedeCerrar($id);
        
          $data = array(
                      'incidenteid'                     => $id,
                      'tipoderespuesta'                 => 'DENUNCIA LEGAL',
                      'folio'                           => $folio,
                      'estatus_consenso'                => $estatusConsenso ,
                      'estatus_medidas'                 => $estatusMedidas,
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

                      'id_ActaHechos'                   => $idActaHechos,

                      'id_nformePatronato'              => $idInformePatronato,


                      'id_InformeRegional'              => $idInformeRegional,

                      'id_doctoInformeEnteRector'       => $iddoctoInformeEnteRector,

                      'id_docotoSoporteLegal'           => $iddocotoSoporteLegal,

                      'id_doctoSoporteEmocional'        => $iddoctoSoporteEmocional,

                      'nombre_documentoConsenso'        => $nombre_documentoConsenso,
                      'nombre_documentoDenuncia'        => $nombre_documentoDenuncia,
                      'nombre_documentomedidasdocto'    => $nombre_documentomedidasdocto,
                      'nombre_documentoNotificacionpfn' => $nombre_documentoNotificacionpfn,
                      'nombre_documentoNotificacionDenunciante' => $nombre_documentoNotificacionDenunciante,
                      'nombre_documentoNotificacionPlan'=> $nombre_documentoNotificacionPlan,
                      'nombre_documentoActaValoracion'  => $nombre_documentoActaValoracion,
                      'nombre_documentoActaHechos'      => $nombre_documentoActaHechos,
                      'nombre_documentoPatronato'       => $nombre_documentoPatronato,
                      'nombre_documentoRegional'        => $nombre_documentoRegional,
                      'nombre_doctoInformeEnteRector'   => $nombre_doctoInformeEnteRector,
                      'nombre_doctoSoporteLegal'        => $nombre_doctoSoporteLegal,
                      'nombre_doctoSoporteEmocional'    => $nombre_doctoSoporteEmocional,
                      'sePuedeCerrarPorEstados'         => $sePuedeCerrarPorEstados

          );
          return $data;
     }

     function cargarNombre($id){

         $res = DB::queryFirstField("select nombreOriginal from doctos where id =%i",$id);

         return $res;

     }

     function sePuedeCerrar($id){

      // estado de valoracion inicial
      $estadoInicial = DB::queryFirstField("select coloretapauno from incidente where id = %i", $id); 
      // estado de valoracion integral 
      $estadoIntegral =  DB::queryFirstField("select estado from valoracionintegral where incidenteid = %i", $id); 
   
      // estado de respuesta 
      $tipoderespuesta =  DB::queryFirstField("select tipoderespuesta from valoracionintegral where incidenteid = %i", $id); 
      $estadorespuesta = '';
      
      if ($tipoderespuesta=='DENUNCIA LEGAL') {

        $estadorespuesta = DB::queryFirstField("select estado from denuncialegal where incidenteid = %i",$id);

      }else {


      }
  
      // estado de seguimiento

      $estadoseguimiento  = DB::queryFirstField("select estado from seguimiento where incidenteid = %i",$id);

      $res = false;
      if( $estadoInicial=='green' && $estadoIntegral =="cerrado" &&   $estadorespuesta == "cerrado" && $estadoseguimiento=="cerrado") {
      $res = true;
      }
       
      return $res;
     }


}