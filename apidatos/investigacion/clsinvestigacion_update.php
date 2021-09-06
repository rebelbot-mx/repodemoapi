<?php 

class clsinvestigacion_update {

    public function updateInvestigacion($datos){

        date_default_timezone_set('America/Mexico_City');

        $date = date("Y-m-d H:i:s");  

         DB::update('investigacion', [

            'folioinvestigacion'    =>  $datos['folioinvestigacion'],
            'registroincidentes_docto'    =>  $datos['registroincidentes_docto'],
            'cartautorizacion_docto'    =>  $datos['cartautorizacion_docto'],
            'terminosreferencia_doctp'    =>  $datos['terminosreferencia_doctp'],
            'plan_docto'    =>  $datos['plan_docto'],
            'informe_docto'    =>  $datos['informe_docto'],
           // 'fechaCreacion'    =>  $datos['fechaCreacion'],
            'fechaUpdate'    =>  $date


         ],"id=%i",$datos['id'] );



          error_log(" valor de investigacion actualizados  : " . $datos['id']);

          $data = array('id' => $datos['id']);

          return json_encode($data);
    }



} 