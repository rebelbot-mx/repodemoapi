<?php



trait trait_cerrarProceso_desde_investigacion {

    function cerrarProceso_desde_investigacion($datos) {
       
       $id = $datos["incidenteid"];

        date_default_timezone_set('America/Mexico_City');
        $DateAndTime = date('Y-m-d');  
        DB::update('incidente', [

           
            'coloretapauno'                 =>  'green',
            'coloretapados'                 =>  'green',
            'etapados'                      =>  'visible',
            'coloretapatres'                =>  'green',
            'coloretapacuatro'              =>  'green',
            'colorInvestigacion'            =>  'green',
            'estado'                        =>  'cerrado_x_ni',
            'fechaCierre'                   =>  $DateAndTime

          ],"id=%i",$id);

        DB::update('investigacion', [
       
         'estado'            => 'cerrado'
        ],"incidenteid=%i",$id);

        DB::update( 'valoracionintegral',
        [ 'textovi' => $datos["textovi"] ,
          'confirmaincidentenumerico' => 1,
          'estado'  => 'cerrado'   ]   ,
        " incidenteid = %i",
          $id
      );
    
    

    }
}