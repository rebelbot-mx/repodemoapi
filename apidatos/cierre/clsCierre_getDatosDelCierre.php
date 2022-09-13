<?php 
require 'traitEstadoDelSeguimiento.php';

class clsCierre_getDatosDelCierre { 
 
use traitEstadoDelSeguimiento;

    public function getcierre($id){


        try  {
        /*
                  console.log(response.data);
          this.folio = response.data[0]["folio"];
          this.programa= response.data[0]["nombrePrograma"];
          this.elaboro= response.data[0]["elaboro"];
          this.cargo= response.data[0]["cargousuario"];

          this.testigos= response.data[0]["testigos"];
        
         this.texto = response.data[0]['textocierre'];
         this.cerrado = response.data[0]['cerrado'];
        
        */
        $results = DB::query("SELECT * FROM 
                              incidente i 
         join valoracionintegral v on v.incidenteid = i.id 
         join seguimiento s on s.incidenteid = i.id where i.id = %i",$id);

         $buscarElaborador = $results[0]['usuarioCreador'];
          error_log(" valor de buscarELaborador : " .   $buscarElaborador);
        
          $nombreUsuarioCreador  = DB::queryFirstField("select nombre from usuarios where id=%i", $buscarElaborador );
          error_log(" valor de nombreUsuarioCreador : " .  $nombreUsuarioCreador );
        
          $results[0]['nombreUsuarioCreador'] =   $nombreUsuarioCreador ;
      // $results[0]['nombreUsuarioCreador'] =   $nombreUsuarioCreador ;

        $programa =  $results[0]['programa'];
        $nombrePrograma  =  DB::queryFirstField(" select abreviatura from programas where id =%i",  $programa);
        $valor = gettype($results);

        error_log(" valor : " . $valor);
        /*
        
         'plan'                         =>  clsSeguimiento_update::eliminar_doblecomillas($datos['plan']),
         'documentos'                   =>  clsSeguimiento_update::eliminar_doblecomillas($datos['documentos']),
         'notificaciondif'              =>  clsSeguimiento_update::eliminar_doblecomillas($datos['notificaciondif']),
         'notificacionautoridad'        =>  clsSeguimiento_update::eliminar_doblecomillas($datos['notificacionautoridad']),
         'notificacionpfn'              =>  clsSeguimiento_update::eliminar_doblecomillas($datos['notificacionpfn']),
         'notificaciodenunciante'       =>  clsSeguimiento_update::eliminar_doblecomillas($datos['notificaciodenunciante']),
         'actavaloracion'               =>  clsSeguimiento_update::eliminar_doblecomillas($datos['actavaloracion']),
         'planrecuperacion'             =>  clsSeguimiento_update::eliminar_doblecomillas($datos['planrecuperacion']),
         'documentos_docto'             =>  clsSeguimiento_update::eliminar_doblecomillas($datos['documentos_docto']),
         'notificaciondif_docto'        =>  clsSeguimiento_update::eliminar_doblecomillas($datos['notificaciondif_docto']),
         'notificacionautoridad_docto'  =>  clsSeguimiento_update::eliminar_doblecomillas($datos['notificacionautoridad_docto']),
         'notificacionpfn_docto'        =>  clsSeguimiento_update::eliminar_doblecomillas($datos['notificacionpfn_docto']),
         'notificaciondenunciante_docto'=>  clsSeguimiento_update::eliminar_doblecomillas($datos['notificaciodenunciante_docto']),
         'actavaloracion_docto'         =>  clsSeguimiento_update::eliminar_doblecomillas($datos['actavaloracion_docto']),
         'planrecuperacion_docto'       =>  clsSeguimiento_update::eliminar_doblecomillas($datos['planrecuperacion_docto']),
         'plan_docto'   
        
        */
        $results[0]['estadoIncidente']=  DB::queryFirstField("select estado from incidente where  id  = %i",$id); 
   
        $results[0]['nombrePrograma']=$nombrePrograma;
        $results2 = DB::queryFirstRow("select * from seguimiento where  incidenteid  = %i",$id); 
        $idDocto_valor =  $results2['plan_docto'];
        error_log("  xxxxxxx " . $idDocto_valor);
        $archivoPlan = clsCierre_getDatosDelCierre::datoDelArchivo($idDocto_valor);
        $results[0]['Archivo_Plan_nombreOriginal']=$archivoPlan['nombreOriginal'];
        $results[0]['Archivo_Plan_ext']=$archivoPlan['ext'];
        $results[0]['Archivo_Plan_nombreinterno']=$archivoPlan['nombreinterno'];
        $results[0]['Archivo_Plan_directorio']=$archivoPlan['directorio'];
        $results[0]['Archivo_Plan_id']=$archivoPlan['id'];
        $results[0]['Archivo_Plan_hayArchivo']=$archivoPlan['hayArchivo'];

        $idDocto_planrecuperacion_docto =  $results2['planrecuperacion_docto'];
        error_log("  xxxxxxx " . $idDocto_planrecuperacion_docto);
        $Archivoplanrecuperacion = clsCierre_getDatosDelCierre::datoDelArchivo($idDocto_planrecuperacion_docto);
        $results[0]['Archivo_planrecuperacion_nombreOriginal']=$Archivoplanrecuperacion['nombreOriginal'];
        $results[0]['Archivo_planrecuperacion_ext']=$Archivoplanrecuperacion['ext'];
        $results[0]['Archivo_planrecuperacion_nombreinterno']=$Archivoplanrecuperacion['nombreinterno'];
        $results[0]['Archivo_planrecuperacion_directorio']=$Archivoplanrecuperacion['directorio'];
        $results[0]['Archivo_planrecuperacion_id']=$Archivoplanrecuperacion['id'];
        $results[0]['Archivo_planrecuperacion_hayArchivo']=$Archivoplanrecuperacion['hayArchivo'];


        $idDocto_actavaloracion_docto =  $results2['actavaloracion_docto'];
        error_log("  xxxxxxx " . $idDocto_actavaloracion_docto);
        $ArchivoActaValoracion = clsCierre_getDatosDelCierre::datoDelArchivo($idDocto_actavaloracion_docto);
        $results[0]['Archivo_actavaloracion_nombreOriginal']=$ArchivoActaValoracion['nombreOriginal'];
        $results[0]['Archivo_actavaloracion_ext']=$ArchivoActaValoracion['ext'];
        $results[0]['Archivo_actavaloracion_nombreinterno']=$ArchivoActaValoracion['nombreinterno'];
        $results[0]['Archivo_actavaloracion_directorio']=$ArchivoActaValoracion['directorio'];
        $results[0]['Archivo_actavaloracion_id']=$ArchivoActaValoracion['id'];
        $results[0]['Archivo_actavaloracion_hayArchivo']=$ArchivoActaValoracion['hayArchivo'];



        $idDocto_notificaciondenunciante_docto =  $results2['notificaciondenunciante_docto'];
        error_log("  xxxxxxx " . $idDocto_notificaciondenunciante_docto);
        $Archivonotificaciondenunciante = clsCierre_getDatosDelCierre::datoDelArchivo($idDocto_notificaciondenunciante_docto);
        $results[0]['Archivo_notificaciondenunciante_nombreOriginal']=$Archivonotificaciondenunciante['nombreOriginal'];
        $results[0]['Archivo_notificaciondenunciante_ext']=$Archivonotificaciondenunciante['ext'];
        $results[0]['Archivo_notificaciondenunciante_nombreinterno']=$Archivonotificaciondenunciante['nombreinterno'];
        $results[0]['Archivo_notificaciondenunciante_directorio']=$Archivonotificaciondenunciante['directorio'];
        $results[0]['Archivo_notificaciondenunciante_id']=$Archivonotificaciondenunciante['id'];
        $results[0]['Archivo_notificaciondenunciante_hayArchivo']=$Archivonotificaciondenunciante['hayArchivo'];



        $idDocto_notificaciondif_docto =  $results2['notificaciondif_docto'];
        error_log("  xxxxxxx " . $idDocto_notificaciondif_docto);
        $Archivonotificaciondif = clsCierre_getDatosDelCierre::datoDelArchivo($idDocto_notificaciondif_docto);
        $results[0]['Archivo_notificaciondif_nombreOriginal']=$Archivonotificaciondif['nombreOriginal'];
        $results[0]['Archivo_notificaciondif_ext']=$Archivonotificaciondif['ext'];
        $results[0]['Archivo_notificaciondif_nombreinterno']=$Archivonotificaciondif['nombreinterno'];
        $results[0]['Archivo_notificaciondif_directorio']=$Archivonotificaciondif['directorio'];
        $results[0]['Archivo_notificaciondif_id']=$Archivonotificaciondif['id'];
        $results[0]['Archivo_notificaciondif_hayArchivo']=$Archivonotificaciondif['hayArchivo'];

        $idDocto_notificacionautoridad_docto_docto =  $results2['notificacionautoridad_docto'];
        error_log("  idDocto_notificacionautoridad_docto_docto " . $idDocto_notificacionautoridad_docto_docto);
        $Archivonotificacionautoridad_docto = clsCierre_getDatosDelCierre::datoDelArchivo($idDocto_notificacionautoridad_docto_docto);
        $results[0]['Archivo_notificacionautoridad_nombreOriginal']=$Archivonotificacionautoridad_docto['nombreOriginal'];
        $results[0]['Archivo_notificacionautoridad_ext']=$Archivonotificacionautoridad_docto['ext'];
        $results[0]['Archivo_notificacionautoridad_nombreinterno']=$Archivonotificacionautoridad_docto['nombreinterno'];
        $results[0]['Archivo_notificacionautoridad_directorio']=$Archivonotificacionautoridad_docto['directorio'];
        $results[0]['Archivo_notificacionautoridad_id']=$Archivonotificacionautoridad_docto['id'];
        $results[0]['Archivo_notificacionautoridad_hayArchivo']=$Archivonotificacionautoridad_docto['hayArchivo'];

       
        $idDocto_notificacionpfn_docto =  $results2['notificacionpfn_docto'];
        error_log("  idDocto_notificacionautoridad_docto_docto " . $idDocto_notificacionpfn_docto);
        $Archivo_notificacionPFN_docto = clsCierre_getDatosDelCierre::datoDelArchivo($idDocto_notificacionpfn_docto);
        $results[0]['Archivo_notificacionPFN_nombreOriginal']=$Archivo_notificacionPFN_docto['nombreOriginal'];
        $results[0]['Archivo_notificacionPFN_ext']=$Archivo_notificacionPFN_docto['ext'];
        $results[0]['Archivo_notificacionPFN_nombreinterno']=$Archivo_notificacionPFN_docto['nombreinterno'];
        $results[0]['Archivo_notificacionPFN_directorio']=$Archivo_notificacionPFN_docto['directorio'];
        $results[0]['Archivo_notificacionPFN_id']=$Archivo_notificacionPFN_docto['id'];
        $results[0]['Archivo_notificacionPFN_hayArchivo']=$Archivo_notificacionPFN_docto['hayArchivo'];

       $testigos = DB::query("select * from testigoscierre where incidenteid = %i",$id);

       $results[0]['testigos']=$testigos;

       $results[0]['estadoseguimiento'] = $this->estadoDelSeguimiento($id);



        return json_encode($results);
        }catch(Exception $ex) {
            error_log("error " . $ex);
        }

    }

    public function datoDelArchivo($id){
          
        if($id == '0') {

           
         error_log(" id es igual a 0 : " );
         $respuesta = [
             'nombreOriginal'=>'No existe archivo',
             'ext'=>'',
             'nombreinterno'=>'No existe archivo',
             'directorio'=>'',
             'hayArchivo' => false,
             'id' => '0',
 
         ];

         return $respuesta;
 
        }

        $results = DB::queryFirstRow("SELECT * FROM doctos where id = %i",$id);

         error_log(" nombreOriginal : " . $results['nombreOriginal'] );
        $respuesta = [
            'nombreOriginal'=>$results['nombreOriginal'],
            'ext'=>$results['ext'],
            'nombreinterno'=>$results['nombreinterno'],
            'directorio'=>$results['directorio'],
            'hayArchivo' => true,
            'id' => $id,

        ];

        return $respuesta;

    }

        public function getValoracion_x_incidenteid($id){

        $results = DB::query("SELECT * FROM valoracionintegral where incidenteid =%i " ,$id );

        return json_encode($results);


    }


}