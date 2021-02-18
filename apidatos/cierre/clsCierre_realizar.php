<?php 
$ruta = $_ENV['RUTA'];
require $ruta . '/apidatos/enviodecorreos/clsEnviarCorreo.php';
require $ruta . '/apidatos/enviodecorreos/traitTemplate_cierreSeguimiento.php';

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

         $seEnvianLosCorreos  = $_ENV['ENVIO_DE_CORREOS'];
        
         if ($seEnvianLosCorreos =="SI"){
                /* enviamos el correo  */ 
                $folio = DB::queryFirstColumn("select folio from incidente where id = %i", $datos['id']);
                
                //require $ROOT_DIR . '/apidatos/enviodecorreos/clsEnviarCorreo.php';
               
               $sepudeEnviarCorreo = $_ENV['ENVIO_DE_CORREOS'];
               if ( $sepudeEnviarCorreo == 'SI'){
                $enviarCorreo = new clsEnviarCorreo();
                $argumentos = array();
                $argumentos['folio']=$folio;

                $templatelisto= $this->populate_template($argumentos);
                //traitTemplate_updateValoracionIntegral
                $args = array();
                if ($validacion==true){
                $args['textotema'] = 'Se ha actualizado el seguimiento del Folio #'. $folio[0] . ' en la Plataforma ALDEAS SOS';
                 }else{
                  $args['textotema'] = 'Se ha validado todo el  seguimiento del Folio #'. $folio[0] . ' en la Plataforma ALDEAS SOS';
                
                 }
                  $args['template'] =  $templatelisto;
                $enviarCorreo->enviarCorreo_x($args);
              }
                /************************************** */
         }

   
         return json_encode($data);

    }

}
