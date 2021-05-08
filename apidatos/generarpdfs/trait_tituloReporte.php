<?php 


trait trait_tituloReporte {



   function tituloReporte($pdf,$folio,$nombrereporte){


  
    
    $num_fact = "FOLIO  #-" . $folio ;
 
    $pdf->SetLineWidth(0.1); 
    $pdf->SetFillColor(173,216,230); 
    $pdf->Rect(5, 40, 50, 8, "DF");
    $pdf->SetXY( 5, 40 ); 
    $pdf->SetFont( "Arial", "B", 12 ); 
    $pdf->Cell( 50, 8, $num_fact, 0, 0, 'C');

 
    // Encabezado del reporte -- NOMBRE
    
  

    $pdf->SetLineWidth(0.1); 
    //$pdf->SetFillColor(192); 
    $pdf->Rect(55, 40, 150, 8, "DF");
    $pdf->SetXY( 55, 40 ); 
    $pdf->SetFont( "Arial", "B", 12 ); 
    $pdf->Cell( 0, 8, $nombrereporte, 0, 0, 'C');

    return $pdf;

   }

}