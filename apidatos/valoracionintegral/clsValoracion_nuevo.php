<?php

class clsValoracion_nuevo{

    public class nuevaValoracion($datos){
        /*
        'id' =>
'incidenteid' =>  $datos['incidenteid']
'fechacreacion'=> $datos['fechacreacion']
'fechaupdate'=> $datos['fechaupdate']
'textovi'=> $datos['textovi']
'tipologiadelincidente'=> $datos['tipologiadelincidente']
'niveldelincidente'=> $datos['niveldelincidente']
'tipodecaso'=> $datos['tipodecaso']
'confirmaincidente'=> $datos['confirmaincidente']
'tipoderespuesta'=> $datos['tipoderespuesta']
'medidasintegrales'=> $datos['medidasintegrales']
'activo'=> $datos['activo']
        */

         DB::insert('valoracionintegral', [

            'incidenteid'           =>  $datos['incidenteid'],
            'fechacreacion'         => $datos['fechacreacion'],
            'fechaupdate'           => $datos['fechaupdate'],
            'textovi'               => $datos['textovi'],
            'tipologiadelincidente' => $datos['tipologiadelincidente'],
            'niveldelincidente'     => $datos['niveldelincidente'],
            'tipodecaso'            => $datos['tipodecaso'],
            'confirmaincidente'     => $datos['confirmaincidente'],
            'tipoderespuesta'       => $datos['tipoderespuesta'],
            'medidasintegrales'     => $datos['medidasintegrales'],
            'activo'                => $datos['activo']
         ]);

           $id = DB::insertId();
  
          error_log(" valor de id en valoracionintegral  : " . $id);

          $data = array('id' => $id);
   
          return json_encode($data);
    }
}