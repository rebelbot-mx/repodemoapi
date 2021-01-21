<?php


class clsArchivosUtils {

/* --doctos--
`incidenteId` 
`nombreOriginal`
`ext`
`fechaCreacion`
`fechaUpdate`
`nombreinterno`
`directorio`
*/

public function crearRegistro($datos){

    date_default_timezone_set('America/Mexico_City');
   $date = date("Y-m-d H:i:s");  
     
    DB::insert('doctos', [
        'incidenteId'    => $datos['incidenteId'],
        'nombreOriginal' => $datos['nombreOriginal'],
        'ext'            => $datos['ext'],
        'fechaCreacion'  => $date,
        'fechaUpdate'    => $date,
        'nombreinterno'  =>  $datos['nombreinterno'],
        'directorio'     =>  $datos['directorio'],
 ]);

    $id = DB::insertId();
        
    return $id;

}


}