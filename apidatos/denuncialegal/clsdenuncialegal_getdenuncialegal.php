<?php 


class clsdenuncialegal_getdenuncialegal {


    public function getdenuncialegal($id) {

        $results = DB::query("SELECT * FROM denuncialegal where id =%i " ,$id );

        return json_encode($results);


    }
}