<?php 

class clsconciencia_delete {

    public function deleteconciencia($id){
        
        DB::delete('conciencia', 'id=%i',$id);
   
           
  
          error_log(" valor de conciencia borrado  : " . $id);

          $data = array('id' =>$id);
   
          return json_encode($data);
    }



}