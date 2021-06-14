<?php 


//require_once ('fpdf.php');
include ('trait_generarEncabezado.php');
include ('trait_tituloReporte.php');
include ('trait_creadoPor_fecha.php');
include ('trait_textArea.php');
include ('trait_piedeDePagina.php');
include ('trait_ParDeValores.php');
include ('trait_EncabezadoRenglon.php');
include ('trait_PreguntaIluminada.php');


class clsGenerarReporteInicial{
use trait_generarEncabezado,
    trait_tituloReporte,
    trait_creadoPor_fecha,
    trait_textArea,
    trait_piedeDePagina,
    trait_ParDeValores,
    trait_EncabezadoRenglon,
    trait_PreguntaIluminada;


   public function generarReporteInicial( $incidenteid ){
     $tituloPlatafomra  =" ";

    $texto_piedepagina = "Mantener la información confidencial en estricta reserva y no revelar ningún dato de la información a ninguna otra parte, relacionada o no, sin el consentimiento previo escrito del divulgador.";


     $datos  = clsGenerarReporteInicial::cargarDatosDelIncidente($incidenteid);
     $valor_y =60;
     $folio = $datos["folio"];
    
     error_log("Folio del incidente a  generar pdf " . $datos["folio"]);

     $pdf = new FPDF( 'P', 'mm', 'A4' );
     $directorio  = '/reportesetapas/';
     $nombre_archivo = "reporte_inicial_". $folio . ".pdf";

     $ruta = $directorio . $nombre_archivo;
 
     $pdf->AddPage();

     $pdf = $this->generarEncabezado($pdf);
     $pdf = $this->tituloReporte($pdf,$folio, "Reporte Inicial"); 
     
     $respuesta =  $this->creadoPor_fecha($pdf,$datos["usuarioCreador"],$datos["fechaAlta"], $valor_y);
    
     $pdf = $respuesta['pdf'];
     $valor_y =  $respuesta['valory'];

     $valor_y =  $valor_y + 8;

     $respuesta = $this->textArea($pdf,$valor_y,"Involucrados",$datos["involucrados"],60);

     $pdf = $respuesta['pdf'];
     $valor_y =  $respuesta['valory'];
     error_log(" valor de y despuyes de textarera : " . $valor_y);

     $respuesta = $this->parDeValores($pdf, "Denunciante", "Cargo",$datos["elaboro"] ,$datos["cargousuario"] , $valor_y);

     $pdf = $respuesta['pdf'];
     $valor_y =  $respuesta['valory'];

   
     $respuesta = $this->textArea($pdf,$valor_y,"Registro de hechos",$datos["registrohechos"],60);

     $pdf = $respuesta['pdf'];
     $valor_y =  $respuesta['valory'];

    $textopa = $datos["prefildelagresor"] . ", " . $datos["paadultocolaborador"] . ", " .$datos["paadultocolaboradortipo"] ;
    $respuesta = $this->encabezadoRenglon($pdf,"Perfil del agresor",$textopa,$valor_y);

    $pdf = $respuesta['pdf'];
    $valor_y =  $respuesta['valory'];

   $textopv = $datos["perfilvictima"] . ", " . $datos["recibeayuda"] ;
   $respuesta = $this->encabezadoRenglon($pdf,"Perfil de la victima",$textopv,$valor_y);

   $pdf = $this->pieDePagina($pdf,$texto_piedepagina);

   //pagina 2
   $pdf->AddPage();

   $pdf = $this->generarEncabezado($pdf);
   $pdf = $this->tituloReporte($pdf,$folio, "Reporte Inicial"); 



   $valor_y = 60;

   $respuesta = $this->textArea($pdf,$valor_y,"Medidas de proteccion inmediatas",$datos["medidasproinmediatas"],60);

   $pdf = $respuesta['pdf'];
   $valor_y =  $respuesta['valory'];

   $respuesta = $this->textArea($pdf,$valor_y,"Testigos",$datos["testigos"],20);

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


   //-----------------------------------------------------------------------------
   //$pdf = $respuesta['pdf'];
   $pdf = $this->pieDePagina($pdf,$texto_piedepagina);

    // on sup les 2 cm en bas
    $pdf->SetAutoPagebreak(False);
    $pdf->SetMargins(0,0,0);

   
    $cadena_generada = "";

    try {
      //al final cambiar parametro I y por F
     // $cadena_generada = $pdf->Output("S",  $nombre_archivo);
     $pdf->Output("I",  $nombre_archivo);

      //mover de lugar el archivo creado 

      //rename($nombre_archivo, $ruta);

    }catch(Exception $ex){

      error_log($ex->getMessage());

      $nombre_archivo ="ocurrio un error " . $ex->getMessage();


    }

    
    error_log("nombre del documento pdf creado  : " . $nombre_archivo);
    
    return $nombre_archivo;

   }

   public function cargarDatosDelIncidente($incidenteid) {

    $results = DB::queryFirstRow("SELECT * FROM incidente where id =%i " ,$incidenteid );
        
    $pr = $results['programa'];

    $nombrePrograma  = DB::queryFirstField("select programa from programas where id = %i",$pr);
    $idUsuarioCreador  = $results["usuarioCreador"];

    $usuarioCreador = DB::queryFirstRow("select nombre,programa from usuarios where id = %i",$idUsuarioCreador);
    $programa = DB::queryFirstField("select programa from programas where id = %i",$usuarioCreador['programa']);

    $results['nombreprograma']=$nombrePrograma;
    $results['usuarioCreador']= $usuarioCreador['nombre'] . " --  " . $programa;
    //$estadoSeguimiento = $this->estadoDelSeguimiento($id);

    //$results['estado'] =$estadoSeguimiento;

    return $results;



   }



}