<?php



trait trait_textArea{


    function textArea($pdf,$valor_y,$encabezado,$texto,$alto) {



    $pdf->SetLineWidth(0.1); 
    $pdf->SetFillColor(173,216,230); 
    $pdf->Rect(5, $valor_y, 200, 8, "DF");
    $pdf->SetXY( 5, $valor_y ); 
    $pdf->SetFont( "Arial", "B", 10 ); 
    $pdf->Cell( 0, 7, $encabezado, 0, 0, 'C',false);

    $valor_y = $valor_y + 8;

    $pdf->SetLineWidth(0.1); 
    $pdf->SetFillColor(255,255,255); 
    $pdf->Rect(5,  $valor_y, 200, $alto, "DF");
    $pdf->SetXY( 5,  $valor_y ); 
    $pdf->SetFont( "Arial", "B", 10 ); 
    //$pdf->Cell( 0, 6, $texto_involucrados, 0, 0, 'C',false);
    $pdf->Cell( $pdf->GetPageWidth(), 7,  $texto , 0, 0, 'C');

    $valor_y =  $valor_y + $alto;

    error_log("valor de y en trait textarea: " .  $valor_y);

    $respuesta['pdf'] = $pdf;
    $respuesta['valory']= $valor_y;

    return $respuesta;


    }
}