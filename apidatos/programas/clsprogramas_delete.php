<?php 

class clsprogramas_delete {

    public function deleteprogramas($id){
        
        DB::delete('programas', 'id=%i',$id);
   
           
  
          error_log(" valor de programas borrado  : " . $id);

          $data = array('id' =>$id);
   
          return json_encode($data);
    }



}