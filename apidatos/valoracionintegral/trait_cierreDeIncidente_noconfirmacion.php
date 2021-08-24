<?php




trait trait_cierreDeIncidente_noconfirmacion {

    function cerrarUnIncidente_noconfirmacion($incidenteid){

        
       

            $data2 = array('msg' => 'ok','incidente'=>'No','estado'=>'cerrado');
                            /* cambio los colores */
  
            $update_incidente = DB::update('incidente',[
  
                              'etapatres'        => 'invisible',
                              'etapacuatro'      => 'invisible',
                              'coloretapados'    => 'green',
                              'estado'           => 'cerrado_x_ni'
                      ],"id=%i", $incidenteid);
  
            /*************************** */
            $count = DB::queryFirstField("SELECT COUNT(*) FROM seguimiento WHERE incidenteid = %i", $incidenteid);
              
            error_log("valor de count :" . $count );
  
            if ($count==0){
             $actualizacion = DB::insert('seguimiento',[
  
            'incidenteid'                  =>  $incidenteid,
            'status'                       =>  '',
            'plan'                         =>  'NO',
            'documentos'                   =>  'NO',
            'notificaciondif'              =>  'NO',
            'notificacionautoridad'        =>  'NO',
            'notificacionpfn'              =>  'NO',
            'notificaciodenunciante'       =>  'NO',
            'actavaloracion'               =>  'NO',
            'planrecuperacion'             =>  'NO',
            'plan'                         =>  'NO',
            'documentos_docto'             =>  '0',
            'notificaciondif_docto'        =>  '0',
            'notificacionautoridad_docto'  =>  '0',
            'notificacionpfn_docto'        =>  '0',
            'notificaciondenunciante_docto'=>  '0',
            'actavaloracion_docto'         =>  '0',
            'planrecuperacion_docto'       =>  '0',
            'plan_docto'                   =>  '0',
  
  
         ] ); }
          
            return $data2;
        
        

    }


}