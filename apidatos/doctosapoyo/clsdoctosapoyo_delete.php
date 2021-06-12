<?php 

class clsdoctosapoyo_delete {

    public function deletedoctosapoyo($id){



        
        DB::delete('doctosapoyo', 'id=%i',$id);
   
           
  
          error_log(" valor de doctosapoyo borrado  : " . $id);

          $data = array('id' =>$id);
   
          return json_encode($data);
    }



}