<?php


trait trait_getAbordajeParaCierre {


    function getSeguimientoAbordaje_para_cierre($id){
                   
                   /************************************************************
                    *  valores de la tabla abordaje que se mostraran en seguimientos
                    * 
                    *************************************************************/
         
                   //consenso
                   $datosDenuncia =DB::queryFirstRow("select * from abordajinterno where incidenteid  = %i", $id);
         
                   $temp                       = $datosDenuncia["docto_informaenterector"];
                  // $temp_denunciapresentada    = $datosDenuncia["docto_denunciapresentada"];
                   //$temp_medidasdisciplinarias = $datosDenuncia["medidasd_docto"];
         
             
                   $estatusInformaEnteRector             = $datosDenuncia["informaenterector"];
                   $estatusDenunciaPresentada            = $datosDenuncia["status"];
                   $estadoAbordaje                       = $datosDenuncia["estado"];
                   $idDoctoinformaEnteRector             = str_replace('"','',$temp);
                  // $idDenuciaPresentada             = str_replace('"','',$temp_denunciapresentada);
                  // $idmedidasdisciplinarias         = str_replace('"','',$temp_medidasdisciplinarias);
                  
         
                
                   /*error_log(" valores  getSeguimientoDenuncia : " );
                   error_log(" valores  idDocumentoConsenso    : " . $idDocumentoConsenso );
                   error_log(" valores  estatusConsenso        : " . $estatusConsenso );
                   error_log(" valores  estatusMedidas         : " . $estatusMedidas );
                   */
         
                   //error_log(" valores  estatusDenunciaPresentada      : " . $estatusDenunciaPresentada );
                   //error_log(" valores  idDenuciaPresentada            : " . $idDenuciaPresentada );
                   //error_log(" valores  idmedidasdisciplinarias        : " . $idmedidasdisciplinarias );
                   
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
         
         
         
                  error_log(" creadno el array de respesta en seguimiento ABordaje " );

                 $nombre_actahecho               = DB::queryFirstField("select nombreOriginal from doctos where id = %i", $idActaHechos);
                 $nombre_actavaloracion          = DB::queryFirstField("select nombreOriginal from doctos where id = %i", $idActavaloracion);
                 $nombre_Notificacionpfn         = DB::queryFirstField("select nombreOriginal from doctos where id = %i", $idNotificacionpfn);
                 $nombre_NotificacionDenunciante = DB::queryFirstField("select nombreOriginal from doctos where id = %i", $idNotificacionDenunciante);
                 $nombre_NotificacionPlan        = DB::queryFirstField("select nombreOriginal from doctos where id = %i",  $idNotificacionPlan);
                 $nombre_informerector          = DB::queryFirstField("select nombreOriginal from doctos where id = %i",  $idDoctoinformaEnteRector);
                 
                 error_log($nombre_actahecho );
                 
                 error_log($nombre_actavaloracion);
                 
                 error_log($nombre_Notificacionpfn );
                 
                 error_log($nombre_NotificacionDenunciante );
                 
                 error_log($nombre_NotificacionPlan );
                   $data = array(
                               'incidenteid'                     => $id,
                               'tipoderespuesta'                 => 'ABORDAJE INTERNO',
                               'folio'                           => $folio,
                              // 'estatus_consenso'                => $estatusConsenso ,
                              // 'estatus_medidas'                 => $estatusMedidas,
                              // 'estatus_denuncia'                => $estatusDenunciaPresentada,
                               'estatus_notificacionpfn'         => $estatus_notificacionpfn,
                               'estatus_notificaciondenunciante' => $estatus_notificaciondenunciante,
                               'estatus_planrecuperacion'        => $estatus_planrecuperacion,
                              // 'id_consensodocto'                => $idDocumentoConsenso,
                              // 'id_denunciadocto'                => $idDenuciaPresentada,
                              // 'id_medidasdocto'                 => $idmedidasdisciplinarias,
                               'id_Notificacionpfn'              => $idNotificacionpfn,
                               'id_NotificacionDenunciante'      => $idNotificacionDenunciante,
                               'id_NotificacionPlan'             => $idNotificacionPlan,
                               'id_Actavaloracion'               => $idActavaloracion,
                               'id_ActaHechos'                   => $idActaHechos,
                               'id_doctoinformerector'          =>$idDoctoinformaEnteRector,
                               'nombre_actahecho'                    => $nombre_actahecho,
                               'nombre_actavaloracion'               => $nombre_actavaloracion,
                               'nombre_Notificacionpfn'              => $nombre_Notificacionpfn,
                               'nombre_NotificacionDenunciante'      => $nombre_NotificacionDenunciante,
                               'nombre_NotificacionPlan'             => $nombre_NotificacionPlan,
                               'nombre_informerector'                => $nombre_informerector
                   );

                  // print_r($data);


                   return $data;
              }



}//termina trait