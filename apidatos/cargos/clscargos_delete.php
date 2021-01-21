<?php 

class clscargos_delete {

    public function deletecargos($id){
        
        DB::delete('cargos', 'id=%i',$id);
   
           
  
          error_log(" valor de cargos borrado  : " . $id);

          $data = array('id' =>$id);
   
          return json_encode($data);
    }



}