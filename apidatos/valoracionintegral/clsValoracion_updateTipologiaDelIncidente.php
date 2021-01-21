<?php 

class clsValoracion_updateTipologiaDelIncidente { 
 
    public function updateTipologiaDelIncidente($datos){

        $id = $datos['id'];

        $incidenteId  = $datos['incidenteid'];
        
        $textovi =  $datos['textovi'];

        $results = DB::query("update  valoracionintegral set TipologiaDelIncidente = %s where id =%i " ,$id,$textovi );

        return json_encode($results);


    }


}