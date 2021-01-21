<?php

class clsSeguimiento_update {


    public function updateSeguimiento($datos){

         $id = $datos['incidenteid'];

         $actualizacion = DB::update('seguimiento',[
        
          'incidenteid'                   =>  filter_var($datos['incidenteid'],FILTER_SANITIZE_STRING),
            'status'                      =>  filter_var($datos['status'],FILTER_SANITIZE_STRING),
            'plan'                        =>  filter_var($datos['plan'],FILTER_SANITIZE_STRING),
            'documentos'                  =>  filter_var($datos['documentos'],FILTER_SANITIZE_STRING),
            'notificaciondif'             =>  filter_var($datos['notificaciondif'],FILTER_SANITIZE_STRING),
            'notificacionautoridad'       =>  filter_var($datos['notificacionautoridad'],FILTER_SANITIZE_STRING),
            'notificacionpfn'             =>  filter_var($datos['notificacionpfn'],FILTER_SANITIZE_STRING),
            'notificaciodenunciante'      =>  filter_var($datos['notificaciodenunciante'],FILTER_SANITIZE_STRING),
            'actavaloracion'              =>  filter_var($datos['actavaloracion'],FILTER_SANITIZE_STRING),
            'planrecuperacion'            =>  filter_var($datos['planrecuperacion'],FILTER_SANITIZE_STRING),
            'documentos_docto'            =>  filter_var($datos['documentos_docto'],FILTER_SANITIZE_STRING),
            'notificaciondif_docto'       =>  filter_var($datos['notificaciondif_docto'],FILTER_SANITIZE_STRING),
            'notificacionautoridad_docto' =>  filter_var($datos['notificacionautoridad_docto'],FILTER_SANITIZE_STRING),
            'notificacionpfn_docto'       =>  filter_var($datos['notificacionpfn_docto'],FILTER_SANITIZE_STRING),
            'notificaciondenunciante_docto'=> filter_var($datos['notificaciodenunciante_docto'],FILTER_SANITIZE_STRING),
            'actavaloracion_docto'        =>  filter_var($datos['actavaloracion_docto'],FILTER_SANITIZE_STRING),
            'planrecuperacion_docto'      =>  filter_var($datos['planrecuperacion_docto'],FILTER_SANITIZE_STRING),
            'plan_docto'                  =>  filter_var($datos['plan_docto'],FILTER_SANITIZE_STRING),
            'protocolosos'                =>  filter_var($datos['protocolosos'],FILTER_SANITIZE_STRING),
            
         ],"incidenteid=%i",$datos['incidenteid'] );
      
           $data = array('msg' => 'ok');
   
          return json_encode($data);
    }

    public function updateSeguimiento2($datos){

      $id = $datos['incidenteid'];

      $actualizacion = DB::update('seguimiento',[
     
        'incidenteid'                    => clsSeguimiento_update::eliminar_doblecomillas($datos['incidenteid']),
         'status'                       =>  clsSeguimiento_update::eliminar_doblecomillas($datos['status']),
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
         'plan_docto'                    =>  clsSeguimiento_update::eliminar_doblecomillas($datos['plan_docto'])

      ],"incidenteid=%i",$datos['incidenteid'] );
   
        $data = array('msg' => 'ok');

       return json_encode($data);
 }

  public function eliminar_doblecomillas($cadena){

    $res = str_replace('"', '', $cadena);


    return $res;


  }

    /*
    `id`
`incidenteid`
`status`
`plan`
`documentos`
`notificaciondif`
`notificacionautoridad`
`notificacionpfn`
`notificaciodenunciante`
`actavaloracion`
`planrecuperacion`
*/
}