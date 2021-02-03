<?php 


class clsconciencia_getconcirnvis_tipo {


    public function getconciencia_tipo($tipo) {

        $results = DB::query("SELECT * FROM conciencia where tipo=%s " ,$tipo );

        return json_encode($results);


    }
   
}