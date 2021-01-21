<?php 

class clsSeguimiento_getSeguimiento { 
 
    public function getSeguimiento($id){

        $results = DB::query("SELECT * FROM seguimiento where id =%i " ,$id );

        return json_encode($results);


    }

        public function getSeguimiento_x_incidenteid($id){

        $results = DB::query("SELECT * FROM seguimiento where incidenteid =%i " ,$id );
        
        //obtebnemos el folio
        $folio  = clsSeguimiento_getSeguimiento::getFolio($id);
        $tipoDeRespuesta = clsSeguimiento_getSeguimiento::gettipoDeRespuesta($id);

        $results[0]['folio'] = $folio;
        $results[0]['tipoderespuesta'] = $tipoDeRespuesta;

        return json_encode($results);

             


    }
    public function getFolio($id){
       
        $folio = DB::queryFirstField("SELECT folio FROM incidente WHERE id=%i", $id);
        
         return $folio;
    }

    public function gettipoDeRespuesta($id){
       
        $tipoderespuesta = DB::queryFirstField("SELECT tipoderespuesta FROM valoracionintegral WHERE incidenteid=%i", $id);
        
         return $tipoderespuesta;
    }



}