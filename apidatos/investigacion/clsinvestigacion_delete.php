<?php 

class clsinvestigacion_delete {

    public function deleteinvestigacion($id){
        
        DB::delete('investigacion', 'id=%i',$id);
   
           
  
          error_log(" valor de investigacion borrado  : " . $id);

          $data = array('id' =>$id);
   
          return json_encode($data);
    }



}