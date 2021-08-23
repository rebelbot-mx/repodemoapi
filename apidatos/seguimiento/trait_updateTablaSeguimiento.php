<?php 



trait trait_updateTablaSeguimiento {

    /*
     - se actualizan campos notificacionpfn y notificacionpfn_docto
     - se actualizan campos notificaciodenunciante y notificaciondenunciante_docto
     - se actualizan campos planrecuperacion y planrecuperacion_docto
    */
    function actualizarTablaSeguimiento($datos){

      DB::update('seguimiento',
      
      [ 'notificacionpfn'                => str_replace('"','',$datos["estatus_notificacionpfn"]),
        'notificacionpfn_docto'          => str_replace('"','',$datos["id_Notificacionpfn"]),

       'notificaciodenunciante'          => str_replace('"','',$datos["estatus_notificaciondenunciante"]),
       'notificaciondenunciante_docto'   => str_replace('"','',$datos["id_NotificacionDenunciante"]),

       'planrecuperacion'                => str_replace('"','',$datos["estatus_planrecuperacion"]),
       'planrecuperacion_docto'          => str_replace('"','',$datos["id_NotificacionPlan"]),
    
    ], " incidenteid=  %i", $datos["incidenteid"]);

    }//termina funcion


}//termina trait