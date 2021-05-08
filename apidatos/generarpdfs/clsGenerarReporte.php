<?php 


require 'clsGenerarReporteInicial.php';
require 'trait_modificarVigencia.php';

class clsGenerarReporte {

  use trait_modificarVigencia;


  public function generarReporte($datos){

    $permisoId = $datos["id"];

    error_log("--generarReporte-- valor de permisoid " .  $permisoId);

    $permisos = clsGenerarReporte::cargarPermisoImpresion($permisoId);
 
    $incidenteId = $permisos["incidenteid"];
    $etapa = $permisos["etapa"];
    $ruta = "";
    $nombreDeArchivo = "";


    switch ($etapa) {
        case 'Valoracion Inicial':
            # code...
            $nombreDeArchivo = clsGenerarReporte::generarReporteInicial($incidenteId);
            break;
        
        default:
            # code...
            break;
    }
    
    error_log("nombre de archivo PDF generado " .  $nombreDeArchivo);
    $respuesta["msg"]="ok";
    $respuesta["nombrereporte"] =  $nombreDeArchivo;

    $this->modificarVigencia( $permisoId);

    return json_encode($respuesta);

  }
  

  public function generarReporteInicial($id) {
   

    $reporte  = new clsGenerarReporteInicial;

    $nombreDocumentopdf =  $reporte->generarReporteInicial($id);

    return $nombreDocumentopdf;
  }

  public function cargarPermisoImpresion($id){

    
    $results = DB::queryFirstRow("SELECT * FROM permisosimpresion where id =%i " ,$id );
       

      return $results;

  }

}