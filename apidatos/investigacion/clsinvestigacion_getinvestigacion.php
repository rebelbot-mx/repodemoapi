<?php 


class clsinvestigacion_getinvestigacion {


    public function getinvestigacion($id) {

        $results = DB::query("SELECT * FROM investigacion where id =%i " ,$id );

        return json_encode($results);


    }

    
    public function getinvestigacion_x_incidenteid($id) {

        $results = DB::query("SELECT * FROM investigacion where incidenteid =%i " ,$id );

        //obtebnemos el folio
        $folio  = clsinvestigacion_getinvestigacion::getFolio($id);

        $results[0]['folio'] = $folio;

        $results2 = DB::queryFirstRow("SELECT * FROM investigacion where incidenteid =%i " ,$id );
 
        $cartautorizacion_docto_id = $results2["cartautorizacion_docto"];
        $cartautorizacion_docto_Archivo = clsinvestigacion_getinvestigacion::datoDelArchivo($cartautorizacion_docto_id);
        $results[0]["cartautorizacion_doctoArchivo"] =$cartautorizacion_docto_Archivo;

        $terminosreferencia_doctp_id = $results2["terminosreferencia_doctp"];
        $terminosreferencia_doctp_Archivo = clsinvestigacion_getinvestigacion::datoDelArchivo($terminosreferencia_doctp_id);
        $results[0]["terminosreferencia_doctpArchivo"] =$terminosreferencia_doctp_Archivo;

        
        $plan_docto_id = $results2["plan_docto"];
        $plan_docto_Archivo = clsinvestigacion_getinvestigacion::datoDelArchivo($plan_docto_id);
        $results[0]["plan_docto_Archivo"] =$plan_docto_Archivo;

        $informe_docto_id = $results2["informe_docto"];
        $informe_docto_Archivo = clsinvestigacion_getinvestigacion::datoDelArchivo($informe_docto_id);
        $results[0]["informe_docto_Archivo"] =$informe_docto_Archivo;



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