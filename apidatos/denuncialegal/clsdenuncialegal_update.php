<?php 

require 'traitValidarDenuncia.php';
class clsdenuncialegal_update {
use traitValidarDenuncia;

    public function updatedenuncialegal($datos){

       
         DB::update('denuncialegal', [
           
             'id'                =>  $datos['id'],
            'incidenteid'        =>  $datos['incidenteid'],
            'foliodenuncia'      =>  $datos['foliodenuncia'],
            'consenso'           =>  $datos['consenso'],
            'consensodocto'      =>  $datos['consensodocto'],
            'soportecontacto'    =>  $datos['soportecontacto'],
            'soporteantes'       =>  $datos['soporteantes'],
            'soportedurante'     =>  $datos['soportedurante'],
            'soporteemocionalcontacto'    =>  $datos['soporteemocionalcontacto'],
            'soporteemocionalantes'       =>  $datos['soporteemocionalantes'],
            'soporteemocionaldurante'     =>  $datos['soporteemocionaldurante'],
            'medidasd'                    =>  $datos['medidasd'],
            'medidasd_docto'              =>  $datos['medidasd_docto'],
            'medidastexto'                =>  $datos['medidastexto'],
            'fechaCreacion'               =>  $datos['fechaCreacion'],
            'fechaUpdate'                 =>  $datos['fechaUpdate'],
            'estado'                      =>  'Guardado',

        
         ],"id=%i",$datos['id'] );

           
  
          error_log(" valor de denuncialegal actualizados  : " . $datos['id']);
         
          $validar =  $this->validar($datos['id']);

          $estado ="guardado";
          
          $listaDeCorreos_para_enviar =array();

          if ($validar == true){
            
            /*
             actualizacmos el registro de valoracion indtegral al que pertenece esta denuncia legal 
            */
           
            DB::update('valoracionintegral',
            [ 'estadorespuesta'    =>  'cerrado','colorestadorespuesta'=> 'green'],"incidenteid=%i",$datos['incidenteid'] );
 
            DB::update('incidente',
            [ 'estado'    =>  'en llenado de seguimiento',],"id=%i",$datos['incidenteid'] );


            DB::update('denuncialegal',
             [ 'estado'    =>  'cerrado'],"id=%i",$datos['id'] );
             $estado ="cerrado";

            /* **************************************************************
            Obtenemos lista de usuarios que reciben notificacion por correo 
            *****************************************************************/

            $raiz = $_ENV['RUTA'];
            require $raiz. '/apidatos/enviodecorreos/clsEnviarCorreo.php';
                         
            $usuariosCorreos =  new clsEnviarCorreo();
        
            $listaDeCorreos_para_enviar= $usuariosCorreos->listaDeCorreos_depurada(); 
        
            /************************************************************** */




          }

          $data = array(
                       'id'      => $datos['id'],
                       'estado'  => $estado,
                       'correos' => $listaDeCorreos_para_enviar );
   
          return json_encode($data);
    }



}