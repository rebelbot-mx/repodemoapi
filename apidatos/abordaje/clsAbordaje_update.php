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
     
     $listaDeCorreos_para_enviar =array();

     if($this->validar( $parametros['incidenteid'] )== true ){
        
        $estado = "cerrado";

        DB::update('valoracionintegral',
        [ 'estadorespuesta'    =>  'cerrado','colorestadorespuesta'=> 'green'],"incidenteid=%i",$parametros['incidenteid'] );

        DB::update('incidente',
        [ 'estado'    =>  'en llenado de seguimiento',],"id=%i",$parametros['incidenteid'] );


         DB::update("abordajinterno",[
          
            "estado" =>  $estado 

         ],"incidenteid=%i",$parametros['incidenteid']);


        /* **************************************************************
         Obtenemos lista de usuarios que reciben notificacion por correo 
         *****************************************************************/

        require $ROOT_DIR .'/apidatos/enviodecorreos/clsEnviarCorreo.php';
        
        $usuariosCorreos =  new clsEnviarCorreo();
       
        $listaDeCorreos_para_enviar= $usuariosCorreos->listaDeCorreos_depurada(); 
       
        /************************************************************** */


        

     }

      $data = array(
                   'id' => $parametros['incidenteid'], 
                   'estado' => $estado,
                   'correos' =>  $listaDeCorreos_para_enviar );
   
      return json_encode($data);

    }


}