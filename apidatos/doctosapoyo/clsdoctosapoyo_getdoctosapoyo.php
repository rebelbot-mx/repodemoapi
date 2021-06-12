<?php 


class clsdoctosapoyo_getdoctosapoyo {


    public function getdoctosapoyo($id) {

        $results = DB::query("SELECT * FROM doctosapoyo where id =%i " ,$id );

        return json_encode($results);


    }
}