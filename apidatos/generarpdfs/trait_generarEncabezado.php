<?php

trait trait_generarEncabezado {



   /*
    $pdf     : nombre del documento que genera la libreria
    $valor_y : valor que tiene la coordenada y  
   */


    function generarEncabezado($pdf){
    
   
            // logo con 30 de largo 19 de alto .

    $ruta_imagen = "logo.jpg";        
   
    $pdf->Image( $ruta_imagen, 10, 10, 30, 19,'');

    $pdf->SetXY( 10, 13 ); 
    $pdf->SetFont('Arial','',14);
    $pdf->Cell( $pdf->GetPageWidth(), 7, "Plataforma Interna De Proteccion Infantil De  Aldeas Infantiles ", 0, 0, 'C');
     

    $pdf->SetXY( 10, 21 ); 
    $pdf->SetFont('Arial','',14);
    $pdf->Cell( $pdf->GetPageWidth(), 7, " SOS De Mexico IAP", 0, 0, 'C');

    //linea que viene inmediatamente despues del logo. y el titulo.

    $pdf->SetLineWidth(0.8);
    $pdf->Rect(5, 35, 200, 1, "D");

    $valor_y = 35;


    return $pdf;




    }


}