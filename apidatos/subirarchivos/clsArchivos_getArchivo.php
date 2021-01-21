<?php



class clsArchivos_getArchivo {

    public function getArchivo($id){
        
        

    $results = DB::query("SELECT * FROM doctos where id =%i " ,$id );

        return json_encode($results);


    }


}


