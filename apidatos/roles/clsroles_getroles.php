<?php 


class clsroles_getroles {


    public function getroles($id) {

        $results = DB::query("SELECT * FROM roles where id =%i " ,$id );

        return json_encode($results);


    }
}