<?php 


class clsroles_getTodosLosroles {


    public function getroles() {

        error_log("en todos los usuarios");

        $results = DB::query("SELECT * FROM roles " );

        return json_encode($results);


    }
}