<?php
class clsdenuncialegal_nuevo {

    public function nuevodenuncialegal($datos){
   

        /*

         'incidenteid'    =>  $datos['incidenteid'],
            'nombre'         => $datos['nombre'],
            'cargo'          => $datos['cargo']
        */

  DB::insert('denuncialegal', [
          
           
  'incidenteid'              =>  $datos['incidenteid'],
  'foliodenuncia'            =>  $datos['foliodenuncia'],
  'consenso'                 =>  $datos['consenso'],
  'consensodocto'            =>  $datos['consensodocto'],
  'soportecontacto'          =>  $datos['soportecontacto'],
  'soporteantes'             =>  $datos['soporteantes'],
  'soportedurante'           =>  $datos['soportedurante'],
  'soporteemocionalcontacto' =>  $datos['soporteemocionalcontacto'],
  'soporteemocionalantes'    =>  $datos['soporteemocionalantes'],
  'soporteemocionaldurante'  =>  $datos['soporteemocionaldurante'],
  'medidasd'                 =>  $datos['medidasd'],
  'medidasd_docto'           =>  $datos['medidasd_docto'],
  'medidastexto'             =>  $datos['medidastexto'],
  'fechaCreacion'            =>  $datos['fechaCreacion'],
  'fechaUpdate'              =>  $datos['fechaUpdate'],
  'estado'                   =>  $datos['estado'],

  
  'informapatronato'         =>  $datos['informapatronato'],
  'docto_informapatronato'   =>  $datos['docto_informapatronato'],
  'informaoficinaregional'   =>  $datos['informaoficinaregional'],
  'docto_informaoficinaregional'  =>  $datos['docto_informaoficinaregional'],
  'informaenterector'        =>  $datos['informaenterector'],
  'docto_informaenterector'  =>  $datos['docto_informaenterector'],
  'docto_soportelegal'       =>  $datos['docto_soportelegal'],
  'docto_soporteemocional'   =>  $datos['docto_soporteemocional'],
  'denunciapresentada'       =>  $datos['denunciapresentada'],
  'docto_denunciapresentada' =>  $datos['docto_denunciapresentada'],
   
           
   ]);
/*
  informapatronato
  docto_informapatronato
  informaoficinaregional
  docto_informaoficinaregional
  informaenterector
  docto_informaenterector
  docto_soportelegal
  docto_soporteemocional
  denunciapresentada
  docto_denunciapresentada


*/
  
   $id = DB::insertId();
  
   error_log(" valor de id en nuevodenuncialegal  : " . $id);

   $data = array('id' => $id);
   
   return json_encode($data);

    }



}