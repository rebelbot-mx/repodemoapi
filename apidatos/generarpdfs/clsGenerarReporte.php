<?php 


require 'clsGenerarReporteInicial.php';
require 'clsGenerarReporteValoracion.php';
require 'trait_modificarVigencia.php';
/*include ('trait_generarEncabezado.php');
include ('trait_tituloReporte.php');
include ('trait_creadoPor_fecha.php');
include ('trait_textArea.php');
include ('trait_piedeDePagina.php');
include ('trait_ParDeValores.php');
include ('trait_EncabezadoRenglon.php');
include ('trait_PreguntaIluminada.php');*/

class clsGenerarReporte {

  use trait_modificarVigencia;

 
  public function generarReporte($datos){




    $incidenteId ="";
    $etapa = "";
    $ruta = "";
    $nombreDeArchivo = "";
    
    /*
    @param tipo : determina si se imprimiar por peticion o solo sera impresion
                  depende del valor , se buscara el incidenteid y la etapa.
                  los valores pueden ser : autorizacion, sin autorizacion
    */
    $tipo =  $datos["tipo"];

    if ($tipo == "autorizacion"){
      /*
       Se inicia proceso para generar el archivo pdf , pero se revisara 
       previamente los valores de la tabla permisosimpresion.
      
      */
      $permisoId = $datos["id"];

      error_log("--generarReporte-- valor de permisoid " .  $permisoId);

      $permisos = clsGenerarReporte::cargarPermisoImpresion($permisoId);

      
      
      $incidenteId = $permisos["incidenteid"];
      $etapa = $permisos["etapa"];
  
      error_log("--generarReporte-- valor de incidenteId " .  $incidenteId);
      error_log("--generarReporte-- valor de etapa " .  $etapa);

      /*
      Se modifica la vigencia del permiso, pasara de SI a No
      */
      $this->modificarVigencia( $permisoId);

      error_log("--generarReporte-- ya se realizo la modificacion " );

    }else {
      /*
      Se inicia el proceso para generar el archivo pdf, pero solo ser requieren los datos 
      del incidente y la etapa.
      */

      $incidenteId = $datos["incidenteid"];
      $etapa = $datos["etapa"];


    }



    switch ($etapa) {
        case 'Valoracion Inicial':
            # code...
            $nombreDeArchivo = clsGenerarReporte::generarReporteInicial($incidenteId);
            break;
            case 'Valoracion Integral':
              # code...
              $nombreDeArchivo = clsGenerarReporte::generarValoracionIntegral($incidenteId);
              break;
        
        default:
            # code...
            break;
    }
    
    error_log("nombre de archivo PDF generado " .  $nombreDeArchivo);
    $respuesta["msg"]="ok";
    $respuesta["nombrereporte"] =  $nombreDeArchivo;

    

   // return json_encode($nombreDeArchivo);

   return $nombreDeArchivo;


  }
  

  public function generarReporteInicial($id) {
   

    $reporte  = new clsGenerarReporteInicial;

    $nombreDocumentopdf =  $reporte->generarReporteInicial($id);

    return $nombreDocumentopdf;
  }


  public function generarValoracionIntegral($id) {
   

    $reporte  = new clsGenerarReporteValoracion;

    $nombreDocumentopdf =  $reporte->generarReporteValoracion($id);

    return $nombreDocumentopdf;
  }



  
  public function cargarPermisoImpresion($id){

    
    $results = DB::queryFirstRow("SELECT * FROM permisosimpresion where id =%i " ,$id );
       

      return $results;

  }

}