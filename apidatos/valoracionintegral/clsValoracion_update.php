<?php
$raiz = $_ENV['RUTA'];
require $raiz. '/apidatos/enviodecorreos/clsEnviarCorreo.php';
require $raiz. '/apidatos/enviodecorreos/traitTemplate_updateValoracionIntegral.php';

class clsValoracion_update { 
  use traitTemplate_updateValoracionIntegral;
 
    public function updateValoracion($datos){

       $folio = DB::queryFirstColumn("select folio from incidente where id = %i", $datos['incidenteid']);

        $id = $datos['id'];

        $incidenteId  = $datos['incidenteid'];
        
        $textovi =  $datos['textovi'];

        $confirmanumerico= 0;

        if( $datos['confirmaincidente'] =="SI ES UN INCIDENTE"){
          $confirmanumerico= 2;
        }

        if( $datos['confirmaincidente'] =="NO ES UN INCIDENTE"){
          $confirmanumerico= 1;
        }

        $estado ="abierto";
        if (isset($datos["estado"])){
        $estado="cerrado";
        }

        //////////////////////////////////////////////////
        // se verifica el valor de las medidas integrales 
        // si el valo viene en cero el estado no debe de 
        // cerrarse y debe de dejarse en amarillo 
        /////////////////////////////////////////////////

        $colorParaElEstado  = "yellow";
       
        
        if ($datos["medidasintegrales"]== '0'){
          $estado = "abierto";
        }else {

          $colorParaElEstado  = "green";
          $estado = "cerrado";
        }

        $actualizacion = DB::update('valoracionintegral',[
            //              'incidenteid'           =>  $datos['incidenteid'],
            //'fechacreacion'         => $datos['fechacreacion'],
            //'fechaupdate'           => $datos['fechaupdate'],
            'textovi'               => $datos['textovi'],
            'tipologiadelincidente' => $datos['tipologiadelincidente'],
            'niveldelincidente'     => $datos['niveldelincidente'],
            'tipodecaso'            => $datos['tipodecaso'],
            'confirmaincidente'     => $datos['confirmaincidente'],
            'confirmaincidentenumerico'     => $confirmanumerico,
            'tipoderespuesta'       => $datos['tipoderespuesta'],
            'medidasintegrales'     => $datos['medidasintegrales'],
            'estado'                => $estado
        ],"id=%i",$datos['id']);
       

        //$results = DB::query("update  valoracionintegral set TipologiaDelIncidente = %s where id =%i " ,$id,$textovi );
        error_log('actualizado registro de valoracion integral : ' .$datos['id'] );

        /*
          comprobamos que el texto minimo tenga mas 500 caracteres de longitud
        */ 
         $longitud_valoracion = strlen($datos['textovi']);
         $longitud_planycronograma = "ok";//$datos['medidasintegrales'];// strlen($datos['medidasintegrales']);
         
         $datos['medidasintegrales']=='0' ?  $longitud_planycronograma ="not ok" :
         $longitud_planycronograma = "ok";
         

         if ($confirmanumerico != 2){

          $data2 = array('msg' => 'ok','incidente'=>'No','estado'=>'cerrado');
                          /* cambio los colores */

          $update_incidente = DB::update('incidente',[
                            'etapatres' => 'invisible',
                            'etapacuatro' => 'invisible',
                            'coloretapados' => 'green',
                            'estado'=>'cerrado_x_ni'
                    ],"id=%i",$datos['incidenteid']);

          /*************************** */
          $count = DB::queryFirstField("SELECT COUNT(*) FROM seguimiento WHERE incidenteid = %i", $datos['incidenteid']);
            
          error_log("valor de count :" . $count );

          if ($count==0){
           $actualizacion = DB::insert('seguimiento',[

          'incidenteid'           => $datos['incidenteid'],
          'status'                => '',
          'plan'                  =>  'NO',
          'documentos'            =>  'NO',
          'notificaciondif'       =>  'NO',
          'notificacionautoridad' =>  'NO',
          'notificacionpfn'       =>  'NO',
          'notificaciodenunciante'=>  'NO',
          'actavaloracion'        =>  'NO',
          'planrecuperacion'      =>  'NO',
          'plan'                  =>  'NO',
          'documentos_docto'            =>  '0',
          'notificaciondif_docto'       =>  '0',
          'notificacionautoridad_docto' =>  '0',
          'notificacionpfn_docto'       =>  '0',
          'notificaciondenunciante_docto'=>  '0',
          'actavaloracion_docto'        =>  '0',
          'planrecuperacion_docto'      =>  '0',
          'plan_docto'      =>  '0',


       ] ); }
        
          return json_encode($data2);
      
         };

       ///////////////////////////////////////////////////////////////////////////////
       ///  if ( $longitud_valoracion>5 and $longitud_planycronograma=='ok'){
       /// esta linea se modifico para permitir que aunque  no se halla subido el documento 
       // de las medidas integrales ,se permita generar una respuesta
       ////////////////////////////////////////////////////////////////////////////////
      
        if ( $longitud_valoracion>5 ){
            error_log("se cumplen las condiciones y creamos el seguimiento") ;
            /* nota: insertar aqui el codigo de cambio de colores en los botones del incidente
            para el dashboard y creacion de registro para seguimiento */

            $count = DB::queryFirstField("SELECT COUNT(*) FROM seguimiento WHERE incidenteid = %i", $datos['incidenteid']);
            
            error_log("valor de count :" . $count );

            if ($count==0){

            ////////////////////////////////////////////////////////
            // antes verificamos que el acta de valoracion este dada
            // de alta para agregarla y si no la agregamos
            ///////////////////////////////////////////////////////

            $existeActaDevaloracion = DB::queryFirstField("select actavaloracion from incidente where id =%i ", $datos['incidenteid']);
            
            $idActavaloracion = 0;
            $textoActaValoracion = 'POR CONFIRMAR';
            //$existeActaDevaloracion = DB::queryFirstField("select actavaloracion from incidente where id =%i ", $datos['incidenteid']);
            
            error_log("valor del acta de valoracion : " . $existeActaDevaloracion );


            if ($existeActaDevaloracion==0){
              $idActavaloracion = 0;
            }else {
              $idActavaloracion = $existeActaDevaloracion;
              $textoActaValoracion ="SI";

            }
            /////////////////////////////////////////////////////////


            
            
            $actualizacion = DB::insert('seguimiento',[

            'incidenteid'           => $datos['incidenteid'],
            'status'                => '',
            'plan'                  =>  'POR CONFIRMAR',
            'documentos'            =>  'POR CONFIRMAR',
            'notificaciondif'       =>  'POR CONFIRMAR',
            'notificacionautoridad' =>  'POR CONFIRMAR',
            'notificacionpfn'       =>  'POR CONFIRMAR',
            'notificaciodenunciante'=>  'POR CONFIRMAR',
            'actavaloracion'        =>   $textoActaValoracion,
            'planrecuperacion'      =>  'POR CONFIRMAR',
            'plan'                  =>  'POR CONFIRMAR',
            'documentos_docto'            =>  '0',
            'notificaciondif_docto'       =>  '0',
            'notificacionautoridad_docto' =>  '0',
            'notificacionpfn_docto'       =>  '0',
            'notificaciondenunciante_docto'=>  '0',
            'actavaloracion_docto'        =>   $idActavaloracion,
            'planrecuperacion_docto'      =>  '0',
            'plan_docto'      =>  '0',
            'protocolosos'  =>'PENDIENTE',
            'estado'=> 'abierto'


         ] );

                /* cambio los colores */

                $update_incidente = DB::update('incidente',[
                        'etapatres' => 'visible',
                        'etapacuatro' => 'visible',
                        'coloretapados' => $colorParaElEstado,
                        'estado' => 'en llenado de respuesta'
                ],"id=%i",$datos['incidenteid']);

                require 'clsValoracion_crearTipoRespuesta.php';

                $crearRespuesta = new clsValoracion_crearTipoRespuesta;

                $args =[ 
                    'id'=>$datos['incidenteid'],
                    'respuesta'=>$datos['tipoderespuesta']
                   ];

                   $crearRespuesta->crearRespuesta($args);

             }
         }

          /* ------------------------------------------*/

         
          $usuariosCorreos =  new clsEnviarCorreo();
          $listaDeCorreos_para_enviar = array();
          $listaDeCorreos_para_enviar= $usuariosCorreos->listaDeCorreos_depurada(); 


        $data = array(
                      'msg'       => 'ok',
                      'incidente' => 'Si',
                      'correos'   => $listaDeCorreos_para_enviar);

        error_log("antes de enviar el correo de valoracion ");

        /* enviamos el correo  */
        
        $seEnvianLosCorreos  = $_ENV['ENVIO_DE_CORREOS'];
        
        if ($seEnvianLosCorreos =="SI"){
        $enviarCorreo = new clsEnviarCorreo();
        $argumentos = array();
        $argumentos['folio']=$folio;
        $tipores = $datos['tipoderespuesta'];
        $argumentos['tipoderespuesta']= $tipores;

        if ($confirmanumerico == 2) {
          $argumentos['confirmacion']="Si";
        }else {
          $argumentos['confirmacion']="No";
        }

        $templatelisto= $this->populate_template($argumentos);
        
        $args = array();
        $args['textotema'] = 'Se ha realizado la valoracion integral del Folio #'. $folio[0] . ' en la Plataforma ALDEAS SOS';
        $args['template'] =  $templatelisto;
        $enviarCorreo->enviarCorreo_x($args);
        }
        /************************************** */
      
        return json_encode($data);


    }

}