<?php

trait trait_PreguntaIluminada {


  function preguntaIluminada($pdf,$pregunta, $respuesta, $valor_y) {


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
    $pdf->Cell( 0, 8, $respuesta, 0, 0, 'C');

    $valor_y =  $valor_y + 8;


    $respuesta['pdf'] = $pdf;
    $respuesta['valory']= $valor_y;

    return $respuesta;



  }



}
