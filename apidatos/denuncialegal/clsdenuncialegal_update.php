<?php 

class clsdenuncialegal_update {

    public function updatedenuncialegal($datos){

       
         DB::update('denuncialegal', [
           
             'id'    =>  $datos['id'],
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

        
         ],"id=%i",$datos['id'] );

           
  
          error_log(" valor de denuncialegal actualizados  : " . $datos['id']);

          $data = array('id' => $datos['id']);
   
          return json_encode($data);
    }



}