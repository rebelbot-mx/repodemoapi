<?php 


class clsTestigo_getTodosLosTestigos {


    public function getTestigos($id) {

        $results = DB::query("SELECT * FROM testigoscierre where incidenteid =%i " ,$id );

        return json_encode($results);


    }
}