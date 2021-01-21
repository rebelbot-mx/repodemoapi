<?php
class clsValoracion_update { 
 
    public function updateValoracion($datos){

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
            'medidasintegrales'     => $datos['medidasintegrales']
           //'activo'                => $datos['activo']
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



         if ( $longitud_valoracion>5 and $longitud_planycronograma=='ok'){
            error_log("se cumplen las condiciones y creamos el seguimiento") ;
            /* nota: insertar aqui el codigo de cambio de colores en los botones del incidente
            para el dashboard y creacion de registro para seguimiento */

            $count = DB::queryFirstField("SELECT COUNT(*) FROM seguimiento WHERE incidenteid = %i", $datos['incidenteid']);
            
            error_log("valor de count :" . $count );

            if ($count==0){
             $actualizacion = DB::insert('seguimiento',[

            'incidenteid'           => $datos['incidenteid'],
            'status'                => '',
            'plan'                  =>  'POR CONFIRMAR',
            'documentos'            =>  'POR CONFIRMAR',
            'notificaciondif'       =>  'POR CONFIRMAR',
            'notificacionautoridad' =>  'POR CONFIRMAR',
            'notificacionpfn'       =>  'POR CONFIRMAR',
            'notificaciodenunciante'=>  'POR CONFIRMAR',
            'actavaloracion'        =>  'POR CONFIRMAR',
            'planrecuperacion'      =>  'POR CONFIRMAR',
            'plan'                  =>  'POR CONFIRMAR',
            'documentos_docto'            =>  '0',
            'notificaciondif_docto'       =>  '0',
            'notificacionautoridad_docto' =>  '0',
            'notificacionpfn_docto'       =>  '0',
            'notificaciondenunciante_docto'=>  '0',
            'actavaloracion_docto'        =>  '0',
            'planrecuperacion_docto'      =>  '0',
            'plan_docto'      =>  '0',
            'protocolosos'  =>'PENDIENTE'


         ] );

                /* cambio los colores */

                $update_incidente = DB::update('incidente',[
                        'etapatres' => 'visible',
                        'etapacuatro' => 'visible',
                        'coloretapados' => 'green',
                        'estado' => 'abierto'
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

        $data = array('msg' => 'ok','incidente'=>'Si');
   
          return json_encode($data);


    }

}