<?php 

class clsroles_update {

    public function updateroles($datos){

       
         DB::update('roles', [
           
             'id'    =>  $datos['id'],
  'NOMBREDELROL'    =>  $datos['NOMBREDELROL'],
  'ALTADECATALOGOS'    =>  $datos['ALTADECATALOGOS'],
  'BAJADECATALOGOS'    =>  $datos['BAJADECATALOGOS'],
  'MODIFICACIOnDECATALOGOS'    =>  $datos['MODIFICACIOnDECATALOGOS'],
  'ALTADEUSUARIOS'    =>  $datos['ALTADEUSUARIOS'],
  'BAJADEUSUARIOS'    =>  $datos['BAJADEUSUARIOS'],
  'MODIFICACIONDEUSUARIOS'    =>  $datos['MODIFICACIONDEUSUARIOS'],
  'ALTADEROL'    =>  $datos['ALTADEROL'],
  'BAJADEROL'    =>  $datos['BAJADEROL'],
  'MODIFICACIONDEROL'    =>  $datos['MODIFICACIONDEROL'],
  'ALTADEVALORACIONINICIAL'    =>  $datos['ALTADEVALORACIONINICIAL'],
  'MODIFICACIONREAPERTURAVALORACIONINICIAL'    =>  $datos['MODIFICACIONREAPERTURAVALORACIONINICIAL'],
  'EDITARANTESDECIERREDELAVALORACIONINICIAL'    =>  $datos['EDITARANTESDECIERREDELAVALORACIONINICIAL'],
  'BAJAVALORACIONINICIAL'    =>  $datos['BAJAVALORACIONINICIAL'],
  'IMPRESIONVALORACIONINICIAL'    =>  $datos['IMPRESIONVALORACIONINICIAL'],
  'VISUALIZACIONVALORACIONINICIAL'    =>  $datos['VISUALIZACIONVALORACIONINICIAL'],
  'ALTADEVALORACIONINTEGRAL'    =>  $datos['ALTADEVALORACIONINTEGRAL'],
  'MODIFICACIONREAPERTURAVALORACIONINTEGRAL'    =>  $datos['MODIFICACIONREAPERTURAVALORACIONINTEGRAL'],
  'EDITARANTESDECIERREDELAVALORACIONINTEGRAL'    =>  $datos['EDITARANTESDECIERREDELAVALORACIONINTEGRAL'],
  'BAJAVALORACIONINTEGRAL'    =>  $datos['BAJAVALORACIONINTEGRAL'],
  'IMPRESIONVALORACIONINTEGRAL'    =>  $datos['IMPRESIONVALORACIONINTEGRAL'],
  'VISUALIZACIONVALORACIONINTEGRAL'    =>  $datos['VISUALIZACIONVALORACIONINTEGRAL'],
  'ALTADESEGUIMIENTO'    =>  $datos['ALTADESEGUIMIENTO'],
  'MODIFICACIONDESEGUIMIENTO'    =>  $datos['MODIFICACIONDESEGUIMIENTO'],
  'EDITARDESEGUIMIENTO'    =>  $datos['EDITARDESEGUIMIENTO'],
  'BAJADESEGUIMIENTO'    =>  $datos['BAJADESEGUIMIENTO'],
  'IMPRESIONDESEGUIMIENTO'    =>  $datos['IMPRESIONDESEGUIMIENTO'],
  'VISUALIZACIONDESEGUIMIENTO'    =>  $datos['VISUALIZACIONDESEGUIMIENTO'],
  'ALTADECIERRE'    =>  $datos['ALTADECIERRE'],
  'MODIFICACIONDECIERRE'    =>  $datos['MODIFICACIONDECIERRE'],
  'EDICIONDECIERRE'    =>  $datos['EDICIONDECIERRE'],
  'BAJADECIERRE'    =>  $datos['BAJADECIERRE'],
  'IMPRESIONDECIERRE'    =>  $datos['IMPRESIONDECIERRE'],
  'VISUALIZACIONDECIERRE'    =>  $datos['VISUALIZACIONDECIERRE'],
  'ALTADENUNCIA'    =>  $datos['ALTADENUNCIA'],
  'MODIFCACIONDENUNCIA'    =>  $datos['MODIFCACIONDENUNCIA'],
  'EDICIONDENUNCIA'    =>  $datos['EDICIONDENUNCIA'],
  'BAJADENUNCIA'    =>  $datos['BAJADENUNCIA'],
  'IMPRESIONDENUNCIA'    =>  $datos['IMPRESIONDENUNCIA'],
  'VISUALIZACIONDENUNCIA'    =>  $datos['VISUALIZACIONDENUNCIA'],
  'ALTAINVESTIGACION'    =>  $datos['ALTAINVESTIGACION'],
  'MODIFICACIONINVESTIGACION'    =>  $datos['MODIFICACIONINVESTIGACION'],
  'EDICIONINVESTIGACION'    =>  $datos['EDICIONINVESTIGACION'],
  'BAJAINVESTIGACION'    =>  $datos['BAJAINVESTIGACION'],
  'IMPRESIONINVESTIGACION'    =>  $datos['IMPRESIONINVESTIGACION'],
  'ALTAEVIDENCIA'    =>  $datos['ALTAEVIDENCIA'],
  'MODIFCACIONEVIDENCIA'    =>  $datos['MODIFCACIONEVIDENCIA'],
  'EDICIONEVIDENCIA'    =>  $datos['EDICIONEVIDENCIA'],
  'BAJAEVIDENCIA'    =>  $datos['BAJAEVIDENCIA'],
  'IMPRESIONEVIDENCIA'    =>  $datos['IMPRESIONEVIDENCIA'],
  'VISUALIZACIONEVIDENCIA'    =>  $datos['VISUALIZACIONEVIDENCIA'],
  'ALTADEARCHIVOS'    =>  $datos['ALTADEARCHIVOS'],
  'MODIFICACIONARCHIVOS'    =>  $datos['MODIFICACIONARCHIVOS'],
  'IMPRESIONARCHIVOS'    =>  $datos['IMPRESIONARCHIVOS'],
  'VISUALIZACIONARCHIVOS'    =>  $datos['VISUALIZACIONARCHIVOS'],
  'ACTIVO'    =>  $datos['ACTIVO'],
        
         ],"id=%i",$datos['id'] );

           
  
          error_log(" valor de roles actualizados  : " . $datos['id']);

          $data = array('id' => $datos['id']);
   
          return json_encode($data);
    }



}