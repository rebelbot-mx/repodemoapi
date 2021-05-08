<?php 


trait trait_piedeDePagina {

    function pieDePagina($pdf, $texto) {


        $pdf->SetLineWidth(0.1);
        $pdf->Rect(5, 268, 200, 6, "D");
        $pdf->SetXY( 5, 268 ); 
        $pdf->SetFont('Arial','',5);
        $pdf->Cell( $pdf->GetPageWidth(), 7, utf8_decode($texto), 0, 0, 'C');
       
        return $pdf;


    }



}