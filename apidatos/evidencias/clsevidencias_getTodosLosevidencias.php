<?php 


class clsevidencias_getTodosLosevidencias {


    public function getevidencias($id) {

        $results = DB::query("SELECT * FROM evidencias where incidenteid =%i " ,$id );

        return json_encode($results);


    }

    public function getevidencias_de_una_denuncia($id){

        $results = DB::query("SELECT * FROM evidencias where investigacionid =%i " ,$id );

        $respuesta = array();

    foreach ($results as $key => $value) {
        # code...
          
        error_log("tipo : " . $value["tipo"]);

        error_log("ubicacion : " . $value["ubicacion"]);

        if ($value["tipo"]=='Documento' || $value["tipo"]=='Imagen'){

            $sql ="select * from doctos where id = " . $value["ubicacion"];

            $doctoUbicacion = DB::queryFirstRow($sql);

            $ubicacion =$doctoUbicacion['directorio'] ."/". $doctoUbicacion["nombreinterno"];

            $value['ubicacion']= $ubicacion;
        }

          $respuesta[]=$value;

    }

        return json_encode($respuesta);

    }
}