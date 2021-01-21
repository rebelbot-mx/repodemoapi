<?php

class clsValoracion_crearTipoRespuesta {

    public function crearRespuesta($datos){

        $incidenteId = $datos['id'];
        $tipoRespuesta =  $datos['respuesta'];
       
        $perteneceAlprograma ="no hay datos";

        if( $tipoRespuesta ==='DENUNCIA PENAL') {
            clsValoracion_crearTipoRespuesta::crearDenuncia($incidenteId,$perteneceAlprograma);
        }

        if( $tipoRespuesta ==='INVESTIGACION INTERNA') {
            error_log(" creando respuesta ->investigacion interna");
            clsValoracion_crearTipoRespuesta::crearInvestigacion($incidenteId,$perteneceAlprograma);
  
        }

    }
    
    public function crearDenuncia($incidenteid, $programa){

        /* existe */

        $existe = DB::queryFirstField("SELECT count(*) FROM denuncialegal WHERE incidenteid=%i", $incidenteid);
         /* debo de hacer algo con el folio de la denuncia */
        if($existe== 0 ){


            $folio = clsValoracion_crearTipoRespuesta::generarFolioDenuncia($incidenteid);

            date_default_timezone_set('America/Mexico_City');
            $date = date("Y-m-d H:i:s");  
            DB::insert('denuncialegal', [
                'incidenteid'    =>  $incidenteid,
                'foliodenuncia'    =>   $folio,
                'consenso'    => "POR CONFIRMAR",
                'consensodocto'    => "0",
                'soportecontacto'    =>  "POR CONFIRMAR",
                'soporteantes'    =>  "POR CONFIRMAR",
                'soportedurante'    =>  "POR CONFIRMAR",
                'soporteemocionalcontacto'    => "POR CONFIRMAR",
                'soporteemocionalantes'    =>  "POR CONFIRMAR",
                'soporteemocionaldurante'    =>  "POR CONFIRMAR",
                'medidasd'    => "POR CONFIRMAR",
                'medidasd_docto'    => "0",
                'medidastexto'    =>  "POR CONFIRMAR",
                'fechaCreacion'    => $date,
                'fechaUpdate'    =>  $date,
                'estado'    =>  'EN PROCESO',
                ]);
        }

    }//termina funcion

    public function generarFolioDenuncia($incidenteId){

        //buscamos el programa y la fecha 
        //luego buscamos las denuncias asociadas a ese programa en particular 
        //  y las sumamos
        
        error_log(" Dentro de generarFolioDenuncia");
        $datos = DB::queryFirstRow("SELECT folio, programa , fechaAlta FROM incidente WHERE id=%i", $incidenteId);
        
     
        
        $programa=$datos["programa"];
        $fechaALta=$datos["fechaAlta"];

        error_log(" valores de programa : $programa y de fechaALtra : $fechaALta ");

        $folioprefijo =DB::queryFirstField("select prefijofolio from programas where abreviatura ='$programa'");

        $year = substr( $fechaALta, 0, 4);
        error_log(" valor de year : $year");
        //cuantas denuncias en el año
        $cuantasDenuncias=DB::queryFirstField("select count(*) from denuncialegal where programa ='$programa' and YEAR(fechaCreacion)='$fechaALta'  ");

        $consecutivo = $cuantasDenuncias + 1;
        $folio = "DL-$folioprefijo-$consecutivo-$year";
        return $folio;

    }

        public function generarFolioInvestigacion($incidenteId){

        //buscamos el programa y la fecha 
        //luego buscamos las denuncias asociadas a ese programa en particular 
        //  y las sumamos
        
        error_log(" Dentro de generarFolioDenuncia");
        $datos = DB::queryFirstRow("SELECT folio, programa , fechaAlta FROM incidente WHERE id=%i", $incidenteId);
        
     
        
        $programa=$datos["programa"];
        $fechaALta=$datos["fechaAlta"];

        error_log(" valores de programa : $programa y de fechaALtra : $fechaALta ");

        $folioprefijo =DB::queryFirstField("select prefijofolio from programas where abreviatura ='$programa'");

        $year = substr( $fechaALta, 0, 4);
        error_log(" valor de year : $year");
        //cuantas denuncias en el año
        $cuantasDenuncias=DB::queryFirstField("select count(*) from investigacion where programa ='$programa' and YEAR(fechaCreacion)='$fechaALta'  ");

        $consecutivo = $cuantasDenuncias + 1;
        $folio = "INV-$folioprefijo-$consecutivo-$year";
        return $folio;

    }

    public function crearInvestigacion($incidenteid, $programa) {

               /* existe */
               $existe = DB::queryFirstField("SELECT count(*) FROM investigacion WHERE incidenteid=%i", $incidenteid);
              /* debo de hacer algo con el folio de la denuncia */
              error_log( " valor de existe =>> " . $existe );
               if($existe== 0 ){

                 $folio = clsValoracion_crearTipoRespuesta::generarFolioInvestigacion($incidenteid);

                  date_default_timezone_set('America/Mexico_City');
                   $date = date("Y-m-d H:i:s");
                   
                   try {
                    error_log( "creando registro investigacoin =>> "  );
                    DB::insert('investigacion', [
     
                  
                       'incidenteid'           =>  $incidenteid,
                       'folioinvestigacion'    =>  $folio,
                       'registroincidentes_docto' => "0",
                       'cartautorizacion_docto' => "0",
                       'terminosreferencia_doctp' => "0",
                       'plan_docto' => "0",
                       'informe_docto' => "0",
                       'fechaCreacion' =>  $date,
                       'fechaUpdate' =>  $date
                        ]);                      
                   }catch(Exception $ex) {
                       error_log(" error en insertar investigacion"  . $ex);
                   }

  
               }

            }

}
