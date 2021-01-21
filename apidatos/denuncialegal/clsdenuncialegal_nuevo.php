<?php
class clsdenuncialegal_nuevo {

    public function nuevodenuncialegal($datos){
   

        /*

         'incidenteid'    =>  $datos['incidenteid'],
            'nombre'         => $datos['nombre'],
            'cargo'          => $datos['cargo']
        */

  DB::insert('denuncialegal', [
          
           
  'incidenteid'    =>  $datos['incidenteid'],
  'foliodenuncia'    =>  $datos['foliodenuncia'],
  'consenso'    =>  $datos['consenso'],
  'consensodocto'    =>  $datos['consensodocto'],
  'soportecontacto'    =>  $datos['soportecontacto'],
  'soporteantes'    =>  $datos['soporteantes'],
  'soportedurante'    =>  $datos['soportedurante'],
  'soporteemocionalcontacto'    =>  $datos['soporteemocionalcontacto'],
  'soporteemocionalantes'    =>  $datos['soporteemocionalantes'],
  'soporteemocionaldurante'    =>  $datos['soporteemocionaldurante'],
  'medidasd'    =>  $datos['medidasd'],
  'medidasd_docto'    =>  $datos['medidasd_docto'],
  'medidastexto'    =>  $datos['medidastexto'],
  'fechaCreacion'    =>  $datos['fechaCreacion'],
  'fechaUpdate'    =>  $datos['fechaUpdate'],
  'estado'    =>  $datos['estado'],

           
         ]);

           $id = DB::insertId();
  
          error_log(" valor de id en nuevodenuncialegal  : " . $id);

          $data = array('id' => $id);
   
          return json_encode($data);
    }



}