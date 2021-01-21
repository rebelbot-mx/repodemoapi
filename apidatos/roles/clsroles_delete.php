<?php 

class clsroles_delete {

    public function deleteroles($id){
        
        DB::delete('roles', 'id=%i',$id);
   
           
  
          error_log(" valor de roles borrado  : " . $id);

          $data = array('id' =>$id);
   
          return json_encode($data);
    }



}