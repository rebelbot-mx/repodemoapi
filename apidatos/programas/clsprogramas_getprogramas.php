<?php 


class clsprogramas_getprogramas {


    public function getprogramas($id) {

        $results = DB::query("SELECT * FROM programas where id =%i " ,$id );

        return json_encode($results);


    }

     public function getTodosprogramas() {

        $results = DB::query("SELECT * FROM programas " );

        return json_encode($results);


    }
    public function getTodosprogramascolumnas() {

        $results = DB::queryFirstColumn("SELECT  programa  FROM programas");

        return json_encode($results);


    }
    

    
}