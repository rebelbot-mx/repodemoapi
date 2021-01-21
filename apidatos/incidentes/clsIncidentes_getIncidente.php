<?php 

class clsIncidentes_getIncidente { 
 
    public function getIncidente($id){

        $results = DB::query("SELECT * FROM incidente where id =%i " ,$id );

        return json_encode($results);


    }




}