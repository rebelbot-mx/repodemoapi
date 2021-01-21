<?php 


class clsTestigo_getTestigo {


    public function getTestigo($id) {

        $results = DB::query("SELECT * FROM testigoscierre where id =%i " ,$id );

        return json_encode($results);


    }
}