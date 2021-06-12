<?php 


class clsdoctosapoyo_getTodosLosdoctosapoyo {


    public function getdoctosapoyo($id) {

        $results = DB::query("SELECT * FROM doctosapoyo where incidenteid =%i " ,$id );

        return json_encode($results);


    }
    public function getTodosLosdoctosapoyo() {

        $results = DB::query("SELECT * FROM doctosapoyo " );

        return json_encode($results);


    }

    public function getTodosLosdoctosapoyo_categoria($categoria) {
  
        $query = "SELECT * FROM doctosapoyo where categoria = '" . $categoria ."'";
        error_log("vl : " . $query);
        $results = DB::query($query  );

        return json_encode($results);


    }
}