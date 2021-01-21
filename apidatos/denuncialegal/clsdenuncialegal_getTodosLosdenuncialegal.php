<?php 


class clsdenuncialegal_getTodosLosdenuncialegal {


    public function getdenuncialegal($id) {

        $results = DB::query("SELECT * FROM denuncialegal where incidenteid =%i " ,$id );

        $folio = clsdenuncialegal_getTodosLosdenuncialegal::getFolio($id);

        $results[0]["folio"] =$folio;
        
        $results2 =DB::queryFirstRow("SELECT * FROM denuncialegal where incidenteid =%i " ,$id );


        $consensodoctoid = $results2["consensodocto"];
        $consensoArchivo = clsdenuncialegal_getTodosLosdenuncialegal::datoDelArchivo($consensodoctoid);
        $results[0]["consensoArchivo"] =$consensoArchivo;


        $medidasd = $results2["medidasd_docto"];
        $medidasArchivo = clsdenuncialegal_getTodosLosdenuncialegal::datoDelArchivo($medidasd);
        $results[0]["medidasArchivo"] =$medidasArchivo;

        return json_encode($results);


    }

    public function getFolio($id){
       
        $folio = DB::queryFirstField("SELECT folio FROM incidente WHERE id=%i", $id);
        
         return $folio;
    }

    public function datoDelArchivo($id){
          
        if($id == '0') {

           
         error_log(" id es igual a 0 : " );
         $respuesta = [
             'nombreOriginal'=>'No existe archivo',
             'ext'=>'',
             'nombreinterno'=>'No existe archivo',
             'directorio'=>'',
             'hayArchivo' => false,
             'id' => '0',
 
         ];

         return $respuesta;
 
        }

        $results = DB::queryFirstRow("SELECT * FROM doctos where id = %i",$id);

         error_log(" nombreOriginal : " . $results['nombreOriginal'] );
        $respuesta = [
            'nombreOriginal'=>$results['nombreOriginal'],
            'ext'=>$results['ext'],
            'nombreinterno'=>$results['nombreinterno'],
            'directorio'=>$results['directorio'],
            'hayArchivo' => true,
            'id' => $id,

        ];

        return $respuesta;

    }
}