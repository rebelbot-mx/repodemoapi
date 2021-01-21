<?php 


class clsevidencias_getevidencias {


    public function getevidencias($id) {

        $results = DB::query("SELECT * FROM evidencias where id =%i " ,$id );

        return json_encode($results);


    }
}