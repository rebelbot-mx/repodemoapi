<?php 

class clsparametros_delete {

    public function deleteparametros($id){
        
        DB::delete('parametros', 'id=%i',$id);
   
           
  
          error_log(" valor de parametros borrado  : " . $id);

          $data = array('id' =>$id);
   
          return json_encode($data);
    }



}