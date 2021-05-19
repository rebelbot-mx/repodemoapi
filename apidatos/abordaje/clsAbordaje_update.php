<?php

require ('traitValidarAbordaje.php');

class clsAbordaje_update{
    use traitValidarAbordaje;


    public function updateAbordaje($parametros){

    /*
         incidenteid         
            status        
            plan               
            documentos             
            plan_docto
            documentos_docto 
    */
     
      $update  = DB::update('abordajinterno',[

        "status"              =>    $parametros['status'],
        "plan"                =>    $parametros['plan'],           
        "documentos"          =>    $parametros['documentos'],           
        "plan_docto"          =>    $parametros['plan_docto'],
        "documentos_docto"    =>    $parametros['documentos_docto'],

      ],"incidenteid=%i",$parametros['incidenteid']);

     //verficamos validacion si ya esta el 
     
     $estado = "abierto";
     if($this->validar( $parametros['incidenteid'] )== true ){
        
       $estado = "cerrado";

        DB::update('valoracionintegral',
        [ 'estadorespuesta'    =>  'cerrado','colorestadorespuesta'=> 'green'],"incidenteid=%i",$parametros['incidenteid'] );

        DB::update('incidente',
        [ 'estado'    =>  'en llenado de seguimiento',],"id=%i",$parametros['incidenteid'] );


         DB::update("abordajinterno",[
          
            "estado" =>  $estado 

         ],"incidenteid=%i",$parametros['incidenteid']);


        

     }

      $data = array('id' => $parametros['incidenteid'], 'estado' => $estado );
   
      return json_encode($data);

    }


}