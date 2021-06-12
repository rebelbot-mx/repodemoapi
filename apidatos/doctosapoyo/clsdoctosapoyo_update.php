<?php 
////////////////////////////////////////////////////////////
// se agrega un parametros llamado operacion
// el cual puede contener dos valores : activar y update
// activar es para mover de 1 a o el valor del campo actibo 
// update  es para realizar cualquier cambio en el registro.
///////////////////////////////////////////////////////////
class clsdoctosapoyo_update {

    public function updatedoctosapoyo($datos){
      


        if (isset($datos["operacion"])){

            if ($datos["operacion"] =="activar"){

                DB::update('doctosapoyo', [

                   'activo'    =>  $datos['activo'],

                ],"id=%i",$datos['id'] );

            }


            if ($datos["operacion"] =="update"){

                DB::update('doctosapoyo', [
           
                    'id'    =>  $datos['id'],
                   'nombredocto'    =>  $datos['nombredocto'],
                   
                   'descripcion'    =>  $datos['descripcion'],
                   'link'    =>  $datos['link'],
                   'categoria'    =>  $datos['categoria'],
                   'activo'    =>  $datos['activo'],
       
               
                ],"id=%i",$datos['id'] );
       
                  
         
                 error_log(" valor de doctosapoyo actualizados  : " . $datos['id']);
               

            }


        }



          $data = array('id' => $datos['id']);
   
          return json_encode($data);
    }



}