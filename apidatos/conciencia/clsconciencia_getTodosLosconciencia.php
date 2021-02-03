<?php 


class clsconciencia_getTodosLosconciencia {


    public function getconciencia($id) {

        $results = DB::query("SELECT * FROM conciencia where incidenteid =%i " ,$id );

        return json_encode($results);


    }
    public function getTodosLosconciencia() {

        $results = DB::query("SELECT * FROM conciencia " );

        return json_encode($results);


    }
}