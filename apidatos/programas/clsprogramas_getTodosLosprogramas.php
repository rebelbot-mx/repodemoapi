<?php 


class clsprogramas_getTodosLosprogramas {


    public function getprogramas($id) {

        $results = DB::query("SELECT * FROM programas where incidenteid =%i " ,$id );

        return json_encode($results);


    }
}