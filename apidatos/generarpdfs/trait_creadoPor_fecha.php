<?php 


trait trait_creadoPor_fecha{

    
    function creadoPor_fecha($pdf, 
                             $texto_creadopor ,
                             $texto_fechadecreacion,
                             $valor_y) {
    //inicia en 60


    
        $pdf->SetLineWidth(0.1); 
        $pdf->SetFillColor(173,216,230); 
        $pdf->Rect(5, $valor_y, 120, 8, "DF");
        $pdf->SetXY( 5, $valor_y ); 
        $pdf->SetFont( "Arial", "B", 10 ); 
        $pdf->Cell( 0, 8, "Creado por : " , 0, 0, 'L');
    
        $pdf->SetLineWidth(0.1); 
        //$pdf->SetFillColor(192); 
        $pdf->Rect(125, $valor_y, 80, 8, "DF");
        $pdf->SetXY( 125,$valor_y ); 
        $pdf->SetFont( "Arial", "B", 10 ); 
        $pdf->Cell( 0, 8, "Fecha de creacion" , 0, 0, 'C');
    
       //textos
       $valor_y = $valor_y + 8;
        $pdf->SetLineWidth(0.1); 
        $pdf->SetFillColor(255,255,255); 
        $pdf->Rect(5, $valor_y, 120, 8, "DF");
        $pdf->SetXY( 5, $valor_y ); 
        $pdf->SetFont( "Arial", "B", 10 ); 
        $pdf->Cell( 0, 8,  $texto_creadopor  , 0, 0, 'L');
        
        $pdf->SetLineWidth(0.1); 
        //$pdf->SetFillColor(192); 
        $pdf->Rect(125, $valor_y, 80, 8, "DF");
        $pdf->SetXY( 125,$valor_y ); 
        $pdf->SetFont( "Arial", "B", 10 ); 
        $pdf->Cell( 0, 8, $texto_fechadecreacion , 0, 0, 'C');
    
    
        $respuesta['pdf'] = $pdf ;
        $respuesta['valory']=$valor_y;

        return $respuesta;

    }



}