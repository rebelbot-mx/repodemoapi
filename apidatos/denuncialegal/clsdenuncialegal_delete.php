<?php 

class clsdenuncialegal_delete {

    public function deletedenuncialegal($id){
        
        DB::delete('denuncialegal', 'id=%i',$id);
   
           
  
          error_log(" valor de denuncialegal borrado  : " . $id);

          $data = array('id' =>$id);
   
          return json_encode($data);
    }



}