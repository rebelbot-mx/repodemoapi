<?php 

require 'traitValidarDenuncia.php';
require 'trait_cambiarACero.php';

class clsdenuncialegal_update {
use traitValidarDenuncia,trait_cambiarACero;

    public function updatedenuncialegal($datos){

       
         DB::update('denuncialegal', [
           
            'id'                          =>  $datos['id'],
            'incidenteid'                 =>  $datos['incidenteid'],
            'foliodenuncia'               =>  $datos['foliodenuncia'],
            'consenso'                    =>  $datos['consenso'],
            
            'soportecontacto'               =>  $datos['soportecontacto'],
            'soporteantes'                  =>  $datos['soporteantes'],
            'soportedurante'                =>  $datos['soportedurante'],
            'soporteemocionalcontacto'      =>  $datos['soporteemocionalcontacto'],
            'soporteemocionalantes'         =>  $datos['soporteemocionalantes'],
            'soporteemocionaldurante'       =>  $datos['soporteemocionaldurante'],
            'medidasd'                      =>  $datos['medidasd'],
            'medidastexto'                  =>  $datos['medidastexto'],
            'fechaCreacion'                 =>  $datos['fechaCreacion'],
            'fechaUpdate'                   =>  $datos['fechaUpdate'],
            'estado'                        =>  'Guardado',
            'informapatronato'              =>  $datos['informapatronato'],
            'denunciapresentada'            =>  $datos['denunciapresentada'],
            'informaoficinaregional'        =>  $datos['informaoficinaregional'],
            'informaenterector'             =>  $datos['informaenterector'],
            
            'consensodocto'                 => $this->cambiarACero ( $datos['consensodocto']),
            'docto_soportelegal'            => $this->cambiarACero ( $datos['docto_soportelegal']),
            'docto_soporteemocional'        => $this->cambiarACero ( $datos['docto_soporteemocional']),
            'docto_denunciapresentada'      => $this->cambiarACero ( $datos['docto_denunciapresentada']),
            'docto_informapatronato'        => $this->cambiarACero ( $datos['docto_informapatronato']),
            'docto_informaoficinaregional'  => $this->cambiarACero ( $datos['docto_informaoficinaregional']),
            'docto_informaenterector'       => $this->cambiarACero ( $datos['docto_informaenterector']),
            'medidasd_docto'                => $this->cambiarACero ( $datos['medidasd_docto']),
        
         ],"id=%i",$datos['id'] );


          $denuncia_actualizado = array(
            'id'                          =>  $datos['id'],
            'incidenteid'                 =>  $datos['incidenteid'],
            'foliodenuncia'               =>  $datos['foliodenuncia'],
            'consenso'                    =>  $datos['consenso'],
            
            'soportecontacto'               =>  $datos['soportecontacto'],
            'soporteantes'                  =>  $datos['soporteantes'],
            'soportedurante'                =>  $datos['soportedurante'],
            'soporteemocionalcontacto'      =>  $datos['soporteemocionalcontacto'],
            'soporteemocionalantes'         =>  $datos['soporteemocionalantes'],
            'soporteemocionaldurante'       =>  $datos['soporteemocionaldurante'],
            'medidasd'                      =>  $datos['medidasd'],
            'medidastexto'                  =>  $datos['medidastexto'],
            'fechaCreacion'                 =>  $datos['fechaCreacion'],
            'fechaUpdate'                   =>  $datos['fechaUpdate'],
            'estado'                        =>  'Guardado',
            'informapatronato'              =>  $datos['informapatronato'],
            'denunciapresentada'            =>  $datos['denunciapresentada'],
            'informaoficinaregional'        =>  $datos['informaoficinaregional'],
            'informaenterector'             =>  $datos['informaenterector'],
            
            'consensodocto'                 => $this->cambiarACero ( $datos['consensodocto']),
            'docto_soportelegal'            => $this->cambiarACero ( $datos['docto_soportelegal']),
            'docto_soporteemocional'        => $this->cambiarACero ( $datos['docto_soporteemocional']),
            'docto_denunciapresentada'      => $this->cambiarACero ( $datos['docto_denunciapresentada']),
            'docto_informapatronato'        => $this->cambiarACero ( $datos['docto_informapatronato']),
            'docto_informaoficinaregional'  => $this->cambiarACero ( $datos['docto_informaoficinaregional']),
            'docto_informaenterector'       => $this->cambiarACero ( $datos['docto_informaenterector']),
            'medidasd_docto'                => $this->cambiarACero ( $datos['medidasd_docto'])
          );
           
  
          error_log(" valor de denuncialegal actualizados  : " . $datos['id']);


          /******************************************************
           * se realiza la validacion de todos los camppos para 
           * ver si es factible o no 
           * 
           ******************************************************/
         
          $validar =  $this->validar($datos['id']);

          /******************************************************/

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
                       'id'       => $datos['id'],
                       'denuncia' => $denuncia_actualizado,
                       'estado'   => $estado,
                       'correos'  => $listaDeCorreos_para_enviar );
   
          return json_encode($data);
    }



}