<?php 

class clsusuarios_delete {

    public function deleteusuarios($id){
        
        DB::delete('usuarios', 'id=%i',$id);
   
           
  
          error_log(" valor de usuarios borrado  : " . $id);

          $data = array('id' =>$id);
   
          return json_encode($data);
    }



}