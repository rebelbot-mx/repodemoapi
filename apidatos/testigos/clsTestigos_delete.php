<?php 

class clsTestigos_delete {

    public function deleteTestigo($id){
        
        DB::delete('testigoscierre', 'id=%i',$id);
   
           
  
          error_log(" valor de testigos borrado  : " . $id);

          $data = array('id' =>$id);
   
          return json_encode($data);
    }



}