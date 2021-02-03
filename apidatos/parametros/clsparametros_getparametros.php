<?php 


class clsparametros_getparametros {


    public function getparametros($id) {

        $results = DB::query("SELECT * FROM parametros where id =%i " ,$id );

        return json_encode($results);


    }
}