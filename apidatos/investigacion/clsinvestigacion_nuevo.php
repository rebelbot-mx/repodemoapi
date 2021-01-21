<?php
class clsinvestigacion_nuevo {

    public function nuevoinvestigacion($datos){
   

        /*

         'incidenteid'    =>  $datos['incidenteid'],
            'nombre'         => $datos['nombre'],
            'cargo'          => $datos['cargo']
        */

         DB::insert('investigacion', [
          
            'id'    =>  $datos['id'],
  'incidenteid'    =>  $datos['incidenteid'],
  'folioinvestigacion_docto'    =>  $datos['folioinvestigacion_docto'],
  'registroincidentes_docto'    =>  $datos['registroincidentes_docto'],
  'cartautorizacion_docto'    =>  $datos['cartautorizacion_docto'],
  'terminosreferencia_doctp'    =>  $datos['terminosreferencia_doctp'],
  'plan_docto'    =>  $datos['plan_docto'],
  'informe_docto'    =>  $datos['informe_docto'],
  'fechaCreacion'    =>  $datos['fechaCreacion'],
  'fechaUpdate'    =>  $datos['fechaUpdate'],

           
         ]);

           $id = DB::insertId();
  
          error_log(" valor de id en nuevoinvestigacion  : " . $id);

          $data = array('id' => $id);
   
          return json_encode($data);
    }



}