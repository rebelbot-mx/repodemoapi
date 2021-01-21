<?php 


class clscargos_getTodosLoscargos {


    public function getcargos($id) {

        $results = DB::query("SELECT * FROM cargos where incidenteid =%i " ,$id );

        return json_encode($results);


    }
 public function get_todos_los_cargos() {

        $results = DB::query("SELECT * FROM cargos " );

        return json_encode($results);


    }
    
}