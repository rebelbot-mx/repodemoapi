<?php 

class clsCierre_realizar { 
 
    public function getcierre($datos){ 

        $tz = 'America/Mexico_City';
        $timestamp = time();
        $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
        $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
        $fechaDeCierre =  $dt->format('Y-m-d');

        $cierre = DB::update('incidente',
         [    
            
             'textocierre'      => $datos['textocierre'],
             'estado'           => 'cerrado',
             'coloretapatres'   => 'green',
             'coloretapacuatro' => 'green',
             'fechaCierre'      => $fechaDeCierre 
         ],"id=%i",$datos['id'] );

         $data = array('msg' => 'ok');
   
         return json_encode($data);

    }

}
