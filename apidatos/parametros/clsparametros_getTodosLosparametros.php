<?php 


class clsparametros_getTodosLosparametros {


    public function getparametros($id) {

        $results = DB::query("SELECT * FROM parametros where incidenteid =%i " ,$id );

        return json_encode($results);


    }
    public function getTodosLosparametros() {

        $results = DB::query("SELECT * FROM parametros " );

        return json_encode($results);


    }

    public function getParametro_por_nombre($parametro){

        $results = DB::queryFirstRow("SELECT * FROM parametros where nombreParametro =%s",$parametro );
        
        
        return json_encode($results);

    }
}