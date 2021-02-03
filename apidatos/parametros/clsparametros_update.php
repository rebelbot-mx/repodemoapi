<?php 

class clsparametros_update {

    public function updateparametros($datos){

       
         DB::update('parametros', [
           
             'id'    =>  $datos['id'],
  'nombreParametro'    =>  $datos['nombreParametro'],
  'descripcion'    =>  $datos['descripcion'],
  'valor'    =>  $datos['valor'],

        
         ],"id=%i",$datos['id'] );

           
  
          error_log(" valor de parametros actualizados  : " . $datos['id']);

          $data = array('id' => $datos['id']);
   
          return json_encode($data);
    }


    public function updateparametro_por_nombre($datos){

        DB::update('parametros', [
         
               
       'valor'    =>  $datos['valor'],

       
        ],"nombreParametro=%s",$datos['parametro'] );

          
 
         //error_log(" valor de parametros actualizados  : " . $datos['id']);

         $data = array('valor' => $datos['valor']);
  
         return json_encode($data);
   }


    }



