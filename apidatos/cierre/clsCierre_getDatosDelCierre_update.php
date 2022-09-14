<?php

$ruta     = $_ENV['RUTA'];

$ruta_getABordaje = $ruta . '/apidatos/seguimiento/trait_seguimientoAbordaje.php';
require ($ruta_getABordaje);
require 'traitEstadoDelSeguimiento.php';
require 'trait_cierreDenuncia.php';
require 'trait_getAbordajeParaCierre.php';

class clsCierre_getDatosDelCierre_update { 
 
use traitEstadoDelSeguimiento,
    trait_seguimientoAbordaje,
    trait_cierreDenuncia,
    trait_getAbordajeParaCierre;

    

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


         $results_usuarioCreador = DB::query(
            "select * from incidente where id = %i", $id 
         );


         $buscarElaborador                   = $results_usuarioCreador[0]['usuarioCreador'];
         error_log(" valor  buscarElaborador: " .   $buscarElaborador);

         $nombreUsuarioCreador               =  DB::queryFirstField("select nombre from usuarios where id=%i", $buscarElaborador );
         $results[0]['nombreUsuarioCreador'] =   $nombreUsuarioCreador ;


         error_log(" valor  nombreUsuarioCreador: " .   $nombreUsuarioCreador);

         error_log(" valor  nombreUsuarioCreador: " .   $nombreUsuarioCreador);


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

        $datosRespuesta = array();

       if ( $results[0]['tipoderespuesta']=='DENUNCIA LEGAL'){



          $datosRespuesta = $this->getSeguimientoDenuncia($id);
           
           $results[0]['denuncialegal']=$datosRespuesta;
         

       }// TERMINA NOTIFICACION


       if ( $results[0]['tipoderespuesta']=='ABORDAJE INTERNO'){



        $datosRespuesta = $this->getSeguimientoAbordaje_para_cierre($id);
         
         $results[0]['abordaje']=$datosRespuesta;
    
         //error_log(" valor de la respues abordaje interno");
         //print_r( $datosRespuesta );
       

     }// TERMINA NOTIFICACION



       $testigos = DB::query("select * from testigoscierre where incidenteid = %i",$id);
       error_log(" TESTIGOS ");


      // $colaboradores =  DB::query("select * from colaboradores where incidenteid = %i",$id);
       
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