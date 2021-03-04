<?php 

class clspermisosimpresion_delete {

    public function deletepermisosimpresion($id){
        
        DB::delete('permisosimpresion', 'id=%i',$id);
   
           
  
          error_log(" valor de permisosimpresion borrado  : " . $id);

          $data = array('id' =>$id);
   
          return json_encode($data);
    }



}