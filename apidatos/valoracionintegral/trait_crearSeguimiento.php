<?php


trait trait_crearSeguimiento{


      function crearSeguimiento($datos) {
         
    
        try { 

        $count = DB::queryFirstField("SELECT COUNT(*) FROM seguimiento WHERE incidenteid = %i", $datos['incidenteid']);
            
        error_log("valor de count en crear seguimiento :" . $count );

        if ($count==0){
          
          error_log(">>>>>>> si counto es igual a cero ");
        
        $id =  DB::insert('seguimiento',[

        'incidenteid'                  => $datos['incidenteid'],
        'status'                       => '',
        'plan'                         =>  'POR CONFIRMAR',
        'documentos'                   =>  'POR CONFIRMAR',
        'notificaciondif'              =>  'POR CONFIRMAR',
        'notificacionautoridad'        =>  'POR CONFIRMAR',
        'notificacionpfn'              =>  'POR CONFIRMAR',
        'notificaciodenunciante'       =>  'POR CONFIRMAR',
        'actavaloracion'               =>   '0',
        'planrecuperacion'             =>  'POR CONFIRMAR',
        'plan'                         =>  'POR CONFIRMAR',
        'documentos_docto'             =>  '0',
        'notificaciondif_docto'        =>  '0',
        'notificacionautoridad_docto'  =>  '0',
        'notificacionpfn_docto'        =>  '0',
        'notificaciondenunciante_docto'=>  '0',
        'actavaloracion_docto'         =>   '0',
        'planrecuperacion_docto'       =>  '0',
        'plan_docto'      =>  '0',
        'protocolosos'  =>'PENDIENTE',
        'estado'=> 'abierto'
         ] );
         error_log( $id );
        /* cambio los colores */


        error_log(" Actualizarn incidente en el update de valoracion");
       // error_log(" Actualizarn incidente en el update de valoracion colorParaElEstado ="  . $colorParaElEstado);
        error_log(" Actualizarn incidente en el update de valoracion incidenteid "  . $datos['incidenteid']);

        $update_incidente = DB::update('incidente',[

                    'etapatres'      => 'visible',
                    'etapacuatro'    => 'visible',
                    'estado'         => 'en llenado de respuesta'

         ],"id=%i",$datos['incidenteid']);
         

      }
   
    }
    catch( Exception $ex){
          error_log( $ex);
    }
    }
}