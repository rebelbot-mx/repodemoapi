<?php 

class clsValoracion_updateTextovi { 
 
    public function updateTextovi($datos){

        $id = $datos['id'];

        $incidenteId  = $datos['incidenteid'];
        
        $textovi =  $datos['textovi'];

        $results = DB::query("update  valoracionintegral set textovi = %s where id =%i " ,$id,$textovi );

        return json_encode($results);


    }


}