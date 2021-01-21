<?php 


class clscargos_getcargos {


    public function getcargos($id) {

        $results = DB::query("SELECT * FROM cargos where id =%i " ,$id );

        return json_encode($results);


    }
}