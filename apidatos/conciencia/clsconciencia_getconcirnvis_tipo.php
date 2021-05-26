<?php 


class clsconciencia_getconcirnvis_tipo {


    public function getconciencia_tipo($tipo) {

    $query = "SELECT * FROM conciencia where tipo='" .$tipo."'";

    error_log($query);

        $results = DB::query( $query );

        return json_encode($results);


    }
   
}