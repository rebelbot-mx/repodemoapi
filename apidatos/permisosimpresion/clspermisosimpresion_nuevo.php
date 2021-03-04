<?php

require 'traitGenerarPassword.php';

class clspermisosimpresion_nuevo {
use traitGenerarPassword;

    public function nuevopermisosimpresion($datos){
     
    /*
    -se resiben el usuarioid  -- quien solicita el permios
    -se recibe el incidenteid -- incidente 
    -se recibe etapa          -- etapa que se desea imprimir
                                 puede reporte inicial, valoracion
                                 seguimiento, cierre, denuncia o 
                                 investigacion.


    */
    //obtenemos un nuevoPassword
    $password =  $this->generarPassword();

    //obtenemos la fecha actual , con la zona actual
    date_default_timezone_set('America/Mexico_City');
    $DateAndTime = date('Y-m-d' );

         DB::insert('permisosimpresion', [
          
            'usuarioid'    =>  $datos['usuarioid'],
            'incidenteid'    =>  $datos['incidenteid'],
            'etapa'    =>  $datos['etapa'],
            'password'    =>   $password,
            'respuesta'    =>  'PENDIENTE',
            'usuarioidautorizo'    => '0',
            'vigente'    =>  'SI',
            'fechapeticion'    =>  $DateAndTime,
            'fechaautorizacion'    =>  $DateAndTime,
     
         ]);

           $id = DB::insertId();
  
          error_log(" valor de id en nuevopermisosimpresion  : " . $id);

          $data = array('id' => $id);
   
          return json_encode($data);
    }



}