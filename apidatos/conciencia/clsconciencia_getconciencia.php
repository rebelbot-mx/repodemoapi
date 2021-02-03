<?php 


class clsconciencia_getconciencia {


    public function getconciencia($id) {

        $results = DB::query("SELECT * FROM conciencia where id =%i " ,$id );

        return json_encode($results);


    }
}