<?php 


//require ('fpdf.php');


class clsGenerarReporteValoracion{
use trait_generarEncabezado,
    trait_tituloReporte,
    trait_creadoPor_fecha,
    trait_textArea,
    trait_piedeDePagina,
    trait_ParDeValores,
    trait_EncabezadoRenglon,
    trait_PreguntaIluminada;


   public function generarReporteValoracion( $incidenteid ){
     $tituloPlatafomra  =" ";

    $texto_piedepagina = "Mantener la información confidencial en estricta reserva y no revelar ningún dato de la información a ninguna otra parte, relacionada o no, sin el consentimiento previo escrito del divulgador.";


     $datos  = clsGenerarReporteValoracion::cargarDatosDelIncidente_valoracion($incidenteid);
     $valor_y =60;
     $folio = $datos["folio"];
    
     error_log("Folio del incidente a  generar pdf " . $datos["folio"]);

     $pdf = new FPDF( 'P', 'mm', 'A4' );
     $directorio  = $_ENV['RUTA']  . "/apidatos/reportesetapas/";
     $nombre_archivo = "reporte_vi_". $folio . ".pdf";

     $ruta = $directorio . $nombre_archivo;
 
     $pdf->AddPage();

     $pdf = $this->generarEncabezado($pdf);
     $pdf = $this->tituloReporte($pdf,$folio, "Valoracion Integral"); 
     
     $respuesta =  $this->creadoPor_fecha($pdf,$datos["usuarioCreador"],$datos["fechaAlta"], $valor_y);
    
     $pdf = $respuesta['pdf'];
     $valor_y =  $respuesta['valory'];

     $valor_y =  $valor_y + 8;



     /* -------------------------------------------*/
     /* Valoracion Integral 
     -----------------------------------------------*/

     $respuesta = $this->textArea($pdf,$valor_y,"Valoracion Integral",$datos["textovi"],60);
     $pdf = $respuesta['pdf'];
     $valor_y =  $respuesta['valory'];
     error_log(" valor de y despuyes de textarera : " . $valor_y);

     if ($datos["confirmaincidente"]=="SI ES UN INCIDENTE"){

      /****************************************************** */

      //$respuesta = $this->preguntaIluminada($pdf,$pregunta,$datos["incidenteconfirmado"],$valor_y);
   
       //------------------------------------------------
       // tipologia  del incidente
       //-------------------------------------------------

      $pdf = $respuesta['pdf'];
      $valor_y =  $respuesta['valory'];
   
   
      $pregunta  =  "Tipologia del incidente";
      $res  = $datos["tipologiadelincidente"];

       $str_pregunta =  utf8_decode($pregunta);
   
       $pdf->SetLineWidth(0.1); 
       $pdf->SetFillColor(173,216,230); 
       $pdf->Rect(5,  $valor_y, 150, 8, "DF");
       $pdf->SetXY( 5,  $valor_y ); 
       $pdf->SetFont( "Arial", "B", 10 ); 
       $pdf->Cell( 0, 8, $str_pregunta , 0, 0, 'C');
   
       
       $pdf->SetFillColor(255,255,255); 
       $pdf->Rect(155,  $valor_y, 50, 8, "DF");
       $pdf->SetXY( 155,  $valor_y ); 
       $pdf->SetFont( "Arial", "B", 10 ); 
       $pdf->Cell( 0, 8, $res, 0, 0, 'C');


       //------------------------------------------------
       // Nivel  del incidente
       //-------------------------------------------------

      
       $valor_y =  $valor_y + 8 ;
    
    
       $pregunta  =  "Nivel del incidente";
       $res  = $datos["niveldelincidente"];
 
        $str_pregunta =  utf8_decode($pregunta);
    
        $pdf->SetLineWidth(0.1); 
        $pdf->SetFillColor(173,216,230); 
        $pdf->Rect(5,  $valor_y, 150, 8, "DF");
        $pdf->SetXY( 5,  $valor_y ); 
        $pdf->SetFont( "Arial", "B", 10 ); 
        $pdf->Cell( 0, 8, $str_pregunta , 0, 0, 'C');
    
        
        $pdf->SetFillColor(255,255,255); 
        $pdf->Rect(155,  $valor_y, 50, 8, "DF");
        $pdf->SetXY( 155,  $valor_y ); 
        $pdf->SetFont( "Arial", "B", 10 ); 
        $pdf->Cell( 0, 8, $res, 0, 0, 'C');   


       //------------------------------------------------
       // Tipo de caso
       //-------------------------------------------------

      
       $valor_y =  $valor_y + 8 ;
    
    
       $pregunta  =  "Tipo de Caso";
       $res  = $datos["tipodecaso"];
 
        $str_pregunta =  utf8_decode($pregunta);
    
        $pdf->SetLineWidth(0.1); 
        $pdf->SetFillColor(173,216,230); 
        $pdf->Rect(5,  $valor_y, 150, 8, "DF");
        $pdf->SetXY( 5,  $valor_y ); 
        $pdf->SetFont( "Arial", "B", 10 ); 
        $pdf->Cell( 0, 8, $str_pregunta , 0, 0, 'C');
    
        
        $pdf->SetFillColor(255,255,255); 
        $pdf->Rect(155,  $valor_y, 50, 8, "DF");
        $pdf->SetXY( 155,  $valor_y ); 
        $pdf->SetFont( "Arial", "B", 10 ); 
        $pdf->Cell( 0, 8, $res, 0, 0, 'C');   

        //------------------------------------------------
       // Tipo de respuesta
       //-------------------------------------------------

      
       $valor_y =  $valor_y + 8 ;
    
    
       $pregunta  =  "Tipo de Respuesta";
       $res  = $datos["tipoderespuesta"];
 
        $str_pregunta =  utf8_decode($pregunta);
    
        $pdf->SetLineWidth(0.1); 
        $pdf->SetFillColor(173,216,230); 
        $pdf->Rect(5,  $valor_y, 150, 8, "DF");
        $pdf->SetXY( 5,  $valor_y ); 
        $pdf->SetFont( "Arial", "B", 10 ); 
        $pdf->Cell( 0, 8, $str_pregunta , 0, 0, 'C');
    
        
        $pdf->SetFillColor(255,255,255); 
        $pdf->Rect(155,  $valor_y, 50, 8, "DF");
        $pdf->SetXY( 155,  $valor_y ); 
        $pdf->SetFont( "Arial", "B", 10 ); 
        $pdf->Cell( 0, 8, $res, 0, 0, 'C');   

      /******************************************************* */
     }else{

      /**************************************************** */
      /* SE TERMINA EL REPORTE DE VALORACION INICIAL POR QUE NO 
         ES UN INCIDENTE                                    
       ***************************************************  */
       $pdf = $respuesta['pdf'];
       $valor_y =  $respuesta['valory'];
    
    
       $pregunta  =  "¿Es un incidente de desproteccion infantil ?";
       $res  = $datos["incidenteconfirmado"];
       //$respuesta = $this->preguntaIluminada($pdf,$pregunta,$datos["incidenteconfirmado"],$valor_y);
    
        //------------------------------------------------
        // ¿ es un incidente ?
        //-------------------------------------------------
        $str_pregunta =  utf8_decode($pregunta);
    
        $pdf->SetLineWidth(0.1); 
        $pdf->SetFillColor(173,216,230); 
        $pdf->Rect(5,  $valor_y, 150, 8, "DF");
        $pdf->SetXY( 5,  $valor_y ); 
        $pdf->SetFont( "Arial", "B", 10 ); 
        $pdf->Cell( 0, 8, $str_pregunta , 0, 0, 'C');
    
        
        $pdf->SetFillColor(255,255,255); 
        $pdf->Rect(155,  $valor_y, 50, 8, "DF");
        $pdf->SetXY( 155,  $valor_y ); 
        $pdf->SetFont( "Arial", "B", 10 ); 
        $pdf->Cell( 0, 8, $res, 0, 0, 'C');
    
        //$valor_y =  $valor_y + 8;

      /**************************************************** */
     }
     

   $pdf = $this->pieDePagina($pdf,$texto_piedepagina);

      // on sup les 2 cm en bas
    $pdf->SetAutoPagebreak(False);
    $pdf->SetMargins(0,0,0);

  
    //al final cambiar parametro I y por F
    $pdf->Output("F",  $nombre_archivo);

    //mover de lugar el archivo creado 

    rename($nombre_archivo, $ruta);
    
    error_log("nombre del documento pdf creado  : " . $nombre_archivo);
    
    return $nombre_archivo;

   }

   public function cargarDatosDelIncidente_valoracion($incidenteid) {

    $results = DB::queryFirstRow("SELECT * FROM valoracionintegral where incidenteid =%i " ,$incidenteid );
    
    
    $incidente = DB::queryFirstRow("select * from incidente where id= %i",$results["id"]);
    //$estadoSeguimiento = $this->estadoDelSeguimiento($id);
    $folio =  $incidente["folio"];
    $pr = $incidente['programa'];
    $fecha = $incidente['fechaAlta'];

    $nombrePrograma  = DB::queryFirstField("select programa from programas where id = %i",$pr);
    $idUsuarioCreador  = $incidente["usuarioCreador"];

    $usuarioCreador = DB::queryFirstRow("select nombre,programa from usuarios where id = %i",$idUsuarioCreador);
    $programa = DB::queryFirstField("select programa from programas where id = %i",$usuarioCreador['programa']);

    $results['nombreprograma']=$nombrePrograma;
    $results['usuarioCreador']= $usuarioCreador['nombre'] . " --  " . $programa;
    $results['fechaAlta']= $fecha;
    $results['folio'] =$folio;

    return $results;



   }



}