<?php
$raiz = $_ENV['RUTA'];
require $raiz. '/apidatos/enviodecorreos/clsEnviarCorreo.php';
require $raiz. '/apidatos/enviodecorreos/traitTemplate_updateValoracionIntegral.php';

require 'trait_cierreDeIncidente_noconfirmacion.php';
require 'trait_actualizaTablaValoracion.php';
require 'trait_crearSeguimiento.php';
require 'traitValidarValoracion.php';
require 'trait_cerrarProceso_desde_investigacion.php';


class clsValoracion_update { 
  use traitTemplate_updateValoracionIntegral,
      trait_cierreDeIncidente_noconfirmacion,
      trait_actualizaTablaValoracion,
      trait_crearSeguimiento,
      traitValidarValoracion,
      trait_cerrarProceso_desde_investigacion;
 
    public function updateValoracion($datos){

        error_log("en updatevaloracion");
           //-------------------------------------------------
          // SE GENERAN LOS DATOS PARA LA LISTA DE CORREOS
          //------------------------------------------------
          $usuariosCorreos =  new clsEnviarCorreo();
          $listaDeCorreos_para_enviar = array();
          $listaDeCorreos_para_enviar= $usuariosCorreos->listaDeCorreos_depurada(); 
       


        /*********************************************************************
        * * VERIFICAMOS CUAL ES EL VALOR DE LA ACCION  
        *********************************************************************/
             
            if ($datos["accion" ] == "cierre_desde_investigacion"){
                 
                 error_log("entradno al cierre desde investigacion");

                 $this->cerrarProceso_desde_investigacion($datos);

                 $data = array(
                  'msg'       => 'incidente_cerrado_desde_investigacion',
                  'incidente' => 'investigacion',
                  'correos'   => $listaDeCorreos_para_enviar);
      
                return json_encode( $data );
             }// termina acccion de cierre desde investigacion

             
             if ($datos["accion" ] == "respuestanormal_desde_investigacion"){

              error_log(" estamos en respuestanormal_desde_investigacion ");
                 
               $datosFaltante = DB::queryFirstRow("select * from valoracionintegral where incidenteid = %i",$datos["incidenteid"]);
               //$datos["textovi" ] =  $datosFaltante["textovi"];
               $datos["id" ]      =  $datosFaltante["id"];

               error_log(" respuestanormal_desde_investigacion - textovi =  " . $datos["textovi" ]);
               error_log(" respuestanormal_desde_investigacion - id =       " . $datos["id" ]);
              /* ocultar la valoracion integral y cambiar el color de la respuesa */
              DB::update('incidente' ,
              [ 'etapados'         => 'visible',
                'colorInvestigacion'=> 'green'],
              " id = %i",
              $datos['incidenteid'] );
                /* cambiamos el estado de la investigacion a cerrado */
                DB::update('investigacion' ,
                [ 'estado'           => 'cerrado'],
                 " incidenteid = %i",
                $datos['incidenteid'] );      
                 
             }// termina acccion de cierre desde investigacion  


        //////////////////////////////////////////////////////////
        //  OBTENEMOS ALGUNOS VALORES NECESARIOS PARA EL PROCESO
        /////////////////////////////////////////////////////////

          $folio            = DB::queryFirstColumn("select folio from incidente where id = %i", $datos['incidenteid']);

          $id               = $datos['id'];
  
          $incidenteId      = $datos['incidenteid'];
          
         $confirmanumerico = 0;     

        //////////////////////////////////////////////////////////
        //   PROCESO DE ACTUALIZACION DE TABLA VALORACION
        /////////////////////////////////////////////////////////
        if( $datos['confirmaincidente'] =="SI ES UN INCIDENTE"){
          
          error_log("es un incidente");
          $confirmanumerico= 2;

          //-----------  -----------------------------------------
          // verificar que exista un registro en la  y si no se crea.
          //-----------------------------------------------------

          $count =0;

          if ( $datos["tipoderespuesta"]== "DENUNCIA LEGAL"){
            $count = DB::queryFirstField("select count(*) from denuncialegal where incidenteid = %i",$incidenteId );
            error_log("es una denuncia");
          }

          if ( $datos["tipoderespuesta"]== "ABORDAJE INTERNO"){
            $count = DB::queryFirstField("select count(*) from abordajinterno where incidenteid = %i",$incidenteId );
            error_log("es una ABORDAJE");
          }


          if ($count == 0){
            error_log("creamos  una respuesta de tipo : " . $datos['tipoderespuesta'] );
            // si no existe un registro creamos una respuesta 
            require 'clsValoracion_crearTipoRespuesta.php';

            $crearRespuesta = new clsValoracion_crearTipoRespuesta;

            $args =[ 
                'id'         => $datos['incidenteid'],
                'respuesta'  => $datos['tipoderespuesta']
              ];

             $crearRespuesta->crearRespuesta($args);

          }//termina




          
                //----------------------------------------------------
                // verificar que exista un registro En la tabla 
                // seguimiento y si no pues se crea.
                //-----------------------------------------------------
                error_log("antes del seguimiento");
                $this->crearSeguimiento($datos);

                //----------------------------------------------------
                // Validar el estado del registro 
                // 
                //-----------------------------------------------------
                
                $estado_valoracion = '';
                $estado_valoracion =  $this->validarValoracion( $datos );
                error_log("resultado de la validacion de valoracion " . $estado_valoracion );
               
                $temp_actaValoracion =  str_replace('"','', $datos["medidasintegrales"]);
                /*********************************************************************
                * ACTUALIZAMOS LA TABLA DE VALORACIONINTEGRAL
                **********************************************************************/
                  $this->actualizaTablaValoracion($datos,  $confirmanumerico ,  $estado_valoracion, $temp_actaValoracion);
                /**********************************************************************/

                //----------------------------------------------------
                // INCIDENTE
                //----------------------------------------------------
              
                $colorParaElEstado ='yellow';

                $estado_valoracion == 'abierto' ? $colorParaElEstado ='yellow' : $colorParaElEstado ='green';
                  
                $update_incidente = DB::update('incidente',[
  
                      'coloretapados'  => $colorParaElEstado

                  ],"id=%i",$datos['incidenteid']);




                  $data = array(
                    'msg'             => 'ok',
                    'incidente'       => 'Si',
                    'tipoderespuesta' => $datos['tipoderespuesta'],
                    'correos'         => $listaDeCorreos_para_enviar);

                     return json_encode($data);
      
                //termina count que contabiliza cuantos registros de seguimiento hay con 
                // el incidenteid

                //----------------------------------------------------
        }
         /////////////////////////////////////////////////////////




        //////////////////////////////////////////////////////////
        //   PROCESO DE CIERRE DEL REGISTRO POR NO SER INCIDENTE
        /////////////////////////////////////////////////////////
        if( $datos['confirmaincidente'] =="NO ES UN INCIDENTE"){

            $confirmanumerico= 1;
            $estado ="cerrado";
            $temp_actaValoracion = '0';
           /*********************************************************************
            * ACTUALIZAMOS LA TABLA  VALORACION INTEGRAL
            **********************************************************************/
              $this->actualizaTablaValoracion($datos,  $confirmanumerico ,  $estado, $temp_actaValoracion);
            /**********************************************************************/
        
            /*********************************************************************
            * CERRAMOS EL PROCESO DE NO ES UN INCIDENTE Y REGRESAMOS LOS DATOS
            **********************************************************************/
            $data_noesincidente = $this->cerrarUnIncidente_noconfirmacion( $datos['incidenteid'] );
           

            return json_encode( $data_noesincidente);
      

        }
        //////////////////////////////////////////////////////////////

        
        if ($datos["accion"] == "crearinvestigacion") {
          
          $perteneceAlprograma = DB::queryFirstField("select programa from incidente where id = %i", $datos['incidenteid']);

          /* ocultar la valoracion integral */
          DB::update('incidente' ,
            [ 'etapados' => 'invisible',
              'estado'   => 'EN INVESTIGACION INTERNA'],
            " id = %i",
            $datos['incidenteid'] );
          require 'clsValoracion_crearTipoRespuesta.php';


          $crearRespuesta = new clsValoracion_crearTipoRespuesta;

          $crearRespuesta->crearInvestigacion($datos['incidenteid'],$perteneceAlprograma);
          


          $data = array(
            'msg'       => 'ok',
            'incidente' => 'investigacion',
            'correos'   => $listaDeCorreos_para_enviar);

          return json_encode( $data );
      
        }



      }
  
  }


      ///////////////////////////////////////////////////////////////////////////////////////
      //NO BORRAR HASTA 

        //$estado ="abierto";

        
        
        /*if (isset($datos["estado"]))
        {
        $estado="cerrado"; 
        }*/

        //////////////////////////////////////////////////
        // se verifica el valor de las medidas integrales 
        // si el valo viene en cero el estado no debe de 
        // cerrarse y debe de dejarse en amarillo 
        /////////////////////////////////////////////////

       // $colorParaElEstado  = "yellow";
        
        //$temp_actaValoracion = str_replace('"','',  $datos["medidasintegrales"]) ;
        
        /*error_log("valor de  temp_actaValoracion en clsValoracion_update = " .  $temp_actaValoracion);

        if ( $temp_actaValoracion  == 0){
          $estado = "abierto";
          $colorParaElEstado  = "yellow";
        }else {

          $colorParaElEstado  = "green";
          $estado = "cerrado";
        }*/

       /*********************************************************************
        * ACTUALIZAMOS LA TABLA
        **********************************************************************/
       //$this->actualizaTablaValoracion($datos,  $confirmanumerico ,  $estado);
       /**********************************************************************/


        //$results = DB::query("update  valoracionintegral set TipologiaDelIncidente = %s where id =%i " ,$id,$textovi );
       // error_log('actualizado registro de valoracion integral : ' .$datos['id'] );

        /*
          comprobamos que el texto minimo tenga mas 500 caracteres de longitud
        */ 
        // $longitud_valoracion = strlen($datos['textovi']);
        // $longitud_planycronograma = "ok";//$datos['medidasintegrales'];// strlen($datos['medidasintegrales']);
         
        // $datos['medidasintegrales']=='0' ?  $longitud_planycronograma ="not ok" :
         //$longitud_planycronograma = "ok";


 

       ///////////////////////////////////////////////////////////////////////////////
       ///  if ( $longitud_valoracion>5 and $longitud_planycronograma=='ok'){
       /// esta linea se modifico para permitir que aunque  no se halla subido el documento 
       // de las medidas integrales ,se permita generar una respuesta
       ////////////////////////////////////////////////////////////////////////////////
      
       /* if ( $longitud_valoracion>5 ){
            error_log("se cumplen las condiciones y creamos el seguimiento") ;
            /* nota: insertar aqui el codigo de cambio de colores en los botones del incidente
            para el dashboard y creacion de registro para seguimiento */

/*
                require 'clsValoracion_crearTipoRespuesta.php';

                $crearRespuesta = new clsValoracion_crearTipoRespuesta;

                $args =[ 
                    'id'         => $datos['incidenteid'],
                    'respuesta'  => $datos['tipoderespuesta']
                   ];

                   $crearRespuesta->crearRespuesta($args);

             } else {*/
               /*******************************************************************
                * SI YA HAY UN REGISTRO DE SEGIMIENTO SOLO ACTUALIZO incidente
                - solo se actualiza el color en la etapa DOS  de la tabla incidente
                ******************************************************************
                */
                
              /*  error_log(" ya existe un seguimiento");
                $update_incidente = DB::update('incidente',[
  
                         'coloretapados'  => $colorParaElEstado
 
                   ],"id=%i",$datos['incidenteid']);

                }*/
                //termina count que contabiliza cuantos registros de seguimiento hay con 
                // el incidenteid
        // }

          /* ------------------------------------------*/

         
         // $usuariosCorreos =  new clsEnviarCorreo();
        //  $listaDeCorreos_para_enviar = array();
        //  $listaDeCorreos_para_enviar= $usuariosCorreos->listaDeCorreos_depurada(); 




       /* error_log("antes de enviar el correo de valoracion ");

        /* enviamos el correo  */
        
        //$seEnvianLosCorreos  = $_ENV['ENVIO_DE_CORREOS'];
        
        //if ($seEnvianLosCorreos =="SI"){
       // $enviarCorreo = new clsEnviarCorreo();
       // $argumentos = array();
      //  $argumentos['folio']=$folio;
      //  $tipores = $datos['tipoderespuesta'];
      //  $argumentos['tipoderespuesta']= $tipores;

     //   if ($confirmanumerico == 2) {
      //    $argumentos['confirmacion']="Si";
     //   }else {
//$argumentos['confirmacion']="No";
      //  }

//$templatelisto= $this->populate_template($argumentos);
        
//$args = array();
        //$args['textotema'] = 'Se ha realizado la valoracion integral del Folio #'. $folio[0] . ' en la Plataforma ALDEAS SOS';
       // $args['template'] =  $templatelisto;
       // $enviarCorreo->enviarCorreo_x($args);
       // }
        /************************************** */
      
        //return json_encode($data);


   // }

//}