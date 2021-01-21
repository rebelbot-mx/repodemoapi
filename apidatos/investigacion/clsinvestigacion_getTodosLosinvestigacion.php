<?php 


class clsinvestigacion_getTodosLosinvestigacion {


    public function getinvestigacion($id) {

        $results = DB::query("SELECT * FROM investigacion where incidenteid =%i " ,$id );

        return json_encode($results);


    }
}