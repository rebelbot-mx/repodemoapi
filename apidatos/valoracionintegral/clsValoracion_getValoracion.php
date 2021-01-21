<?php 

class clsValoracion_getValoracion { 
 
    public function getValoracion($id){

        $results = DB::query("SELECT * FROM valoracionintegral where id =%i " ,$id );

        return json_encode($results);


    }

        public function getValoracion_x_incidenteid($id){

        $results = DB::query("SELECT * FROM valoracionintegral where incidenteid =%i " ,$id );
        
        //obtebnemos el folio
        $folio  = clsValoracion_getValoracion::getFolio($id);

        $results[0]['folio'] = $folio;

        return json_encode($results);


    }

    public function getFolio($id){
       
        $folio = DB::queryFirstField("SELECT folio FROM incidente WHERE id=%i", $id);
        
         return $folio;
    }






}