<?php 

class clsevidencias_delete {

    public function deleteevidencias($id){
        
        DB::delete('evidencias', 'id=%i',$id);
   
           
  
          error_log(" valor de evidencias borrado  : " . $id);

          $data = array('id' =>$id);
   
          return json_encode($data);
    }



}