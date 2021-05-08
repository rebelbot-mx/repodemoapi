<?php


trait trait_ParDeValores{

   function parDeValores($pdf,$encabezado_uno, $encabezado_dos,$contenido_uno,$contenido_dos,$valor_y) {


        //-------------------------------------------------------
        //   encabezado 1               | Encabezado 2          |
        //-------------------------------------------------------
        //   valor 1                    | valor 2               |
        //-------------------------------------------------------

        //Espacio para datos "creado por " y "fecha de creacion "

        $texto_denunciante = "Marcos Alberto cabrera Abarca";
        $texto_cargo =" Cuidador de Aencion directa";
    
        $pdf->SetLineWidth(0.1); 
        $pdf->SetFillColor(173,216,230); 
        $pdf->Rect(5, $valor_y, 120, 8, "DF");
        $pdf->SetXY( 5, $valor_y ); 
        $pdf->SetFont( "Arial", "B", 10 ); 
        $pdf->Cell( 0, 8, $encabezado_uno , 0, 0, 'L');
    
        $pdf->SetLineWidth(0.1); 
        //$pdf->SetFillColor(192); 
        $pdf->Rect(125, $valor_y, 80, 8, "DF");
        $pdf->SetXY( 125, $valor_y ); 
        $pdf->SetFont( "Arial", "B", 10 ); 
        $pdf->Cell( 0, 8, $encabezado_dos , 0, 0, 'C');
    
       //textos
       $valor_y = $valor_y +8;
        $pdf->SetLineWidth(0.1); 
        $pdf->SetFillColor(255,255,255); 
        $pdf->Rect(5, $valor_y, 120, 8, "DF");
        $pdf->SetXY( 5, $valor_y ); 
        $pdf->SetFont( "Arial", "B", 10 ); 
        $pdf->Cell( 0, 8,  $contenido_uno  , 0, 0, 'L');
        
        $pdf->SetLineWidth(0.1); 
        //$pdf->SetFillColor(192); 
        $pdf->Rect(125, $valor_y, 80, 8, "DF");
        $pdf->SetXY( 125, $valor_y ); 
        $pdf->SetFont( "Arial", "B", 10 ); 
        $pdf->Cell( 0, 8,$contenido_dos , 0, 0, 'C');

        $valor_y = $valor_y + 8 ; 
        
        $respuesta['pdf'] = $pdf;
        $respuesta['valory']= $valor_y;

        return $respuesta ;

   }

}