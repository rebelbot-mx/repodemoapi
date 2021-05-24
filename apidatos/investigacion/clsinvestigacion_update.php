<?php 

require 'traitValidarInvestigacion.php';

class clsinvestigacion_update {
use traitValidarInvestigacion;
    public function updateInvestigacion($datos){

        date_default_timezone_set('America/Mexico_City');

        $date = date("Y-m-d H:i:s");  

         DB::update('investigacion', [
           
            'folioinvestigacion'    =>  $datos['folioinvestigacion'],
            'registroincidentes_docto'    =>  $datos['registroincidentes_docto'],
            'cartautorizacion_docto'    =>  $datos['cartautorizacion_docto'],
            'terminosreferencia_doctp'    =>  $datos['terminosreferencia_doctp'],
            'plan_docto'    =>  $datos['plan_docto'],
            'informe_docto'    =>  $datos['informe_docto'],
           // 'fechaCreacion'    =>  $datos['fechaCreacion'],
            'fechaUpdate'    =>  $date,

            'estado'    =>  'Guardado'


        
         ],"id=%i",$datos['id'] );

           
  
          error_log(" valor de investigacion actualizados  : " . $datos['id']);

          $validar =  $this->validar($datos['id']);

          $estado ="guardado";

          $listaDeCorreos_para_enviar =array();
          
          if ($validar == true){

          

            /*
             conseguimoe el id del incidente
            */ 
            $sql_incidenteid = DB::queryFirstField("select incidenteid from investigacion where id=%i",$datos['id']);

            DB::update('incidente',
            [ 'estado'    =>  'en llenado de seguimiento',],"id=%i",  $sql_incidenteid );
            
            
            DB::update('valoracionintegral',
            [ 'estadorespuesta'    =>  'cerrado' ,'colorestadorespuesta'=> 'green'],"incidenteid=%i",  $sql_incidenteid );


            DB::update('investigacion',
             [ 'estado'    =>  'cerrado'],"id=%i",$datos['id'] );
             $estado ="cerrado";


            /* **************************************************************
            Obtenemos lista de usuarios que reciben notificacion por correo 
            *****************************************************************/

            require $ROOT_DIR .'/apidatos/enviodecorreos/clsEnviarCorreo.php';
            
            $usuariosCorreos =  new clsEnviarCorreo();
        
            $listaDeCorreos_para_enviar= $usuariosCorreos->listaDeCorreos_depurada(); 
        
            /************************************************************** */




          }
          $data = array(
              'id'      => $datos['id'],
              'estado'  =>$estado,
              'correos' =>$listaDeCorreos_para_enviar
            );
   
          return json_encode($data);
    }



}