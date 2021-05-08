<?php

//
// exemple de facture avec mysqli
// gere le multi-page
// Ver 1.0 THONGSOUME Jean-Paul
//



    require('../fpdf.php');
    
    // le mettre au debut car plante si on declare $mysqli avant !
    $pdf = new FPDF( 'P', 'mm', 'A4' );
    $nombre_archivo = "reporte_inicial1.pdf";

    $pdf->AddPage();
        
    // logo con 30 de largo 19 de alto .
    $pdf->Image('logo.jpg', 10, 10, 30, 19);

    $pdf->SetXY( 10, 13 ); 
    $pdf->SetFont('Arial','',14);
    $pdf->Cell( $pdf->GetPageWidth(), 7, "Plataforma interna de proteccion infantil de  Aldeas Infantiles ", 0, 0, 'C');
     

    $pdf->SetXY( 10, 21 ); 
    $pdf->SetFont('Arial','',14);
    $pdf->Cell( $pdf->GetPageWidth(), 7, " SOS de Mexico y  IAP", 0, 0, 'C');

    //linea que viene inmediatamente despues del logo. y el titulo.

    $pdf->SetLineWidth(0.8);
    $pdf->Rect(5, 35, 200, 1, "D");

    // Encabezado del reporte
    
    $num_fact = "FOLIO  #-" . str_pad('2478', 4, '0', STR_PAD_LEFT);
 
    $pdf->SetLineWidth(0.1); 
    $pdf->SetFillColor(173,216,230); 
    $pdf->Rect(5, 40, 50, 8, "DF");
    $pdf->SetXY( 5, 40 ); 
    $pdf->SetFont( "Arial", "B", 12 ); 
    $pdf->Cell( 50, 8, $num_fact, 0, 0, 'C');

 
    // Encabezado del reporte -- NOMBRE
    
    $num_fact2 = " Reporte inicial ";

    $pdf->SetLineWidth(0.1); 
    //$pdf->SetFillColor(192); 
    $pdf->Rect(55, 40, 150, 8, "DF");
    $pdf->SetXY( 55, 40 ); 
    $pdf->SetFont( "Arial", "B", 12 ); 
    $pdf->Cell( 0, 8, $num_fact2, 0, 0, 'C');


    //======================================================================
    // Termina encabezado
    //======================================================================

   
    // aqui empieza el reporte
    
    //Espacio para datos "creado por " y "fecha de creacion "

    $texto_creadopor = "marcos cabrera -Acogimiento familiar tijuana";
    $texto_fechadecreacion =" 23-12-2021";

    $pdf->SetLineWidth(0.1); 
    $pdf->SetFillColor(173,216,230); 
    $pdf->Rect(5, 60, 120, 8, "DF");
    $pdf->SetXY( 5, 60 ); 
    $pdf->SetFont( "Arial", "B", 10 ); 
    $pdf->Cell( 0, 8, "Creado por : " , 0, 0, 'L');

    $pdf->SetLineWidth(0.1); 
    //$pdf->SetFillColor(192); 
    $pdf->Rect(125, 60, 80, 8, "DF");
    $pdf->SetXY( 125, 60 ); 
    $pdf->SetFont( "Arial", "B", 10 ); 
    $pdf->Cell( 0, 8, "Fecha de creacion" , 0, 0, 'C');

   //textos
    $pdf->SetLineWidth(0.1); 
    $pdf->SetFillColor(255,255,255); 
    $pdf->Rect(5, 68, 120, 8, "DF");
    $pdf->SetXY( 5, 68 ); 
    $pdf->SetFont( "Arial", "B", 10 ); 
    $pdf->Cell( 0, 8,  $texto_creadopor  , 0, 0, 'L');
    
    $pdf->SetLineWidth(0.1); 
    //$pdf->SetFillColor(192); 
    $pdf->Rect(125, 68, 80, 8, "DF");
    $pdf->SetXY( 125, 68 ); 
    $pdf->SetFont( "Arial", "B", 10 ); 
    $pdf->Cell( 0, 8, $texto_fechadecreacion , 0, 0, 'C');





    //-----------------------------------------------
    //involucrados encabezados
    //-----------------------------------------------
    $texto_involucrados = " Involucrados ";

    $pdf->SetLineWidth(0.1); 
    $pdf->SetFillColor(173,216,230); 
    $pdf->Rect(5, 80, 200, 8, "DF");
    $pdf->SetXY( 5, 80 ); 
    $pdf->SetFont( "Arial", "B", 10 ); 
    $pdf->Cell( 0, 7, $texto_involucrados, 0, 0, 'C',false);

        //involucrados cuerpo

    $texto_involucrados = " Involucrados,Involucrados ,Involucrados ,Involucrados,Involucrados,Involucrados,Involucrados ";

    $pdf->SetLineWidth(0.1); 
    $pdf->SetFillColor(255,255,255); 
    $pdf->Rect(5, 88, 200, 60, "DF");
    $pdf->SetXY( 5, 88 ); 
    $pdf->SetFont( "Arial", "B", 10 ); 
    //$pdf->Cell( 0, 6, $texto_involucrados, 0, 0, 'C',false);
    $pdf->Cell( $pdf->GetPageWidth(), 7,  $texto_involucrados , 0, 0, 'C');

        
        //y vale 138

        //---------------------------------
        // DENUNCIANTE Y CARGO
        //---------------------------------

        //Espacio para datos "creado por " y "fecha de creacion "

    $texto_denunciante = "Marcos Alberto cabrera Abarca";
    $texto_cargo =" Cuidador de Aencion directa";

    $pdf->SetLineWidth(0.1); 
    $pdf->SetFillColor(173,216,230); 
    $pdf->Rect(5, 138, 120, 8, "DF");
    $pdf->SetXY( 5, 138 ); 
    $pdf->SetFont( "Arial", "B", 10 ); 
    $pdf->Cell( 0, 8, "Denunciante " , 0, 0, 'L');

    $pdf->SetLineWidth(0.1); 
    //$pdf->SetFillColor(192); 
    $pdf->Rect(125, 138, 80, 8, "DF");
    $pdf->SetXY( 125, 138 ); 
    $pdf->SetFont( "Arial", "B", 10 ); 
    $pdf->Cell( 0, 8, "Cargo" , 0, 0, 'C');

   //textos
    $pdf->SetLineWidth(0.1); 
    $pdf->SetFillColor(255,255,255); 
    $pdf->Rect(5, 146, 120, 8, "DF");
    $pdf->SetXY( 5, 146 ); 
    $pdf->SetFont( "Arial", "B", 10 ); 
    $pdf->Cell( 0, 8,  $texto_denunciante  , 0, 0, 'L');
    
    $pdf->SetLineWidth(0.1); 
    //$pdf->SetFillColor(192); 
    $pdf->Rect(125, 146, 80, 8, "DF");
    $pdf->SetXY( 125, 146 ); 
    $pdf->SetFont( "Arial", "B", 10 ); 
    $pdf->Cell( 0, 8, $texto_cargo , 0, 0, 'C');


    //---------------------------------------------------
    // HECHOS 
    //---------------------------------------------------
    // termina con 146 sumamos 8
    $texto_hechos = " Hechos, hechos ,hechos ";

    $pdf->SetLineWidth(0.1); 
    $pdf->SetFillColor(173,216,230); 
    $pdf->Rect(5, 154, 200, 8, "DF");
    $pdf->SetXY( 5, 154 ); 
    $pdf->SetFont( "Arial", "B", 10 ); 
    $pdf->Cell( 0, 7, "Hechos", 0, 0, 'C',false);

        //involucrados cuerpo

  
    $pdf->SetLineWidth(0.1); 
    $pdf->SetFillColor(255,255,255); 
    $pdf->Rect(5, 162, 200, 60, "DF");
    $pdf->SetXY( 5, 162 ); 
    $pdf->SetFont( "Arial", "B", 10 ); 
    //$pdf->Cell( 0, 6, $texto_involucrados, 0, 0, 'C',false);
    $pdf->Cell( $pdf->GetPageWidth(), 7,  $texto_hechos , 0, 0, 'L');

    
    //------------------------------------------------
    //perfil del agresor
    //------------------------------------------------
    //valort dey 162 + 68 = 230

    $texto_pf_agresor = " adulto a niña o niño - FAMILIA DE ORIGE - HERMANASTRO ";

    $pdf->SetLineWidth(0.1); 
    $pdf->SetFillColor(173,216,230); 
    $pdf->Rect(5, 222, 200, 8, "DF");
    $pdf->SetXY( 5, 222 ); 
    $pdf->SetFont( "Arial", "B", 10 ); 
    $pdf->Cell( 0, 7, "Perfil del Agresor", 0, 0, 'C',false);

    $pdf->SetLineWidth(0.1); 
    $pdf->SetFillColor(255,255,255); 
    $pdf->Rect(5, 230, 200, 8, "DF");
    $pdf->SetXY( 5, 230 ); 
    $pdf->SetFont( "Arial", "B", 10 ); 
    //$pdf->Cell( 0, 6, $texto_involucrados, 0, 0, 'C',false);
    $pdf->Cell( $pdf->GetPageWidth(), 7,   utf8_decode($texto_pf_agresor) , 0, 0, 'L');


   
    //------------------------------------------------
    //perfil del VICTIMA
    //------------------------------------------------
    //valort dey 230 + 8 = 238

    $texto_pf_victima = " Niña -    NO RECIBE AYUDA SOS ";

    $pdf->SetLineWidth(0.1); 
    $pdf->SetFillColor(173,216,230); 
    $pdf->Rect(5, 238, 200, 8, "DF");
    $pdf->SetXY( 5, 238 ); 
    $pdf->SetFont( "Arial", "B", 10 ); 
    $pdf->Cell( 0, 7, "Perfil de la victima", 0, 0, 'C',false);

    $pdf->SetLineWidth(0.1); 
    $pdf->SetFillColor(255,255,255); 
    $pdf->Rect(5, 246, 200, 8, "DF");
    $pdf->SetXY( 5, 246 ); 
    $pdf->SetFont( "Arial", "B", 10 ); 
    //$pdf->Cell( 0, 6, $texto_involucrados, 0, 0, 'C',false);
    $pdf->Cell( $pdf->GetPageWidth(), 7,   utf8_decode($texto_pf_victima) , 0, 0, 'L');


        // **************************
        // pied de page
        // **************************
        $pdf->SetLineWidth(0.1);
        $pdf->Rect(5, 268, 200, 6, "D");
        $pdf->SetXY( 5, 268 ); 
        $pdf->SetFont('Arial','',7);
        $pdf->Cell( $pdf->GetPageWidth(), 7, "Plataforma interna de proteccion infantil de Aldeas Infantiles SOS de Mexico y  IAP  Pagina 1/2", 0, 0, 'C');
        
       


        //------------------------------------
        // AGREGAMOS OTRA PAGINA 
        //-------------------------------------


        $pdf->AddPage();
        
        // logo con 30 de largo 19 de alto .
        $pdf->Image('logo.jpg', 10, 10, 30, 19);
    
        $pdf->SetXY( 10, 13 ); 
        $pdf->SetFont('Arial','',14);
        $pdf->Cell( $pdf->GetPageWidth(), 7, "Plataforma interna de proteccion infantil de  Aldeas Infantiles ", 0, 0, 'C');
         
    
        $pdf->SetXY( 10, 21 ); 
        $pdf->SetFont('Arial','',14);
        $pdf->Cell( $pdf->GetPageWidth(), 7, " SOS de Mexico y  IAP", 0, 0, 'C');
    
        //linea que viene inmediatamente despues del logo. y el titulo.
    
        $pdf->SetLineWidth(0.8);
        $pdf->Rect(5, 35, 200, 1, "D");


        //----------------------------------------------------

    //---------------------------------------------------
    // medidas de proteccion inmediata. 
    //---------------------------------------------------
    // y se inicializa de nuevo .
    $texto_medidas = " Medidas de proteccion inmediata ";

    $pdf->SetLineWidth(0.1); 
    $pdf->SetFillColor(173,216,230); 
    $pdf->Rect(5, 43, 200, 8, "DF");
    $pdf->SetXY( 5, 43 ); 
    $pdf->SetFont( "Arial", "B", 10 ); 
    $pdf->Cell( 0, 7, "Medidas de Proteccion inmediatas", 0, 0, 'C',false);

        //involucrados cuerpo

  
    $pdf->SetLineWidth(0.1); 
    $pdf->SetFillColor(255,255,255); 
    $pdf->Rect(5, 51, 200, 60, "DF");
    $pdf->SetXY( 5, 51 ); 
    $pdf->SetFont( "Arial", "B", 10 ); 
    //$pdf->Cell( 0, 6, $texto_involucrados, 0, 0, 'C',false);
    $pdf->Cell( $pdf->GetPageWidth(), 7,  $texto_medidas , 0, 0, 'L');


   //---------------------------------------------------
    // Testigos
    //---------------------------------------------------
    // y se inicializa de nuevo .
    $texto_testigos = " Marcos Cabrera , victor balcazar , jose juan pio quinto. ";

    $pdf->SetLineWidth(0.1); 
    $pdf->SetFillColor(173,216,230); 
    $pdf->Rect(5, 111, 200, 8, "DF");
    $pdf->SetXY( 5, 111 ); 
    $pdf->SetFont( "Arial", "B", 10 ); 
    $pdf->Cell( 0, 7, "Testigos", 0, 0, 'C',false);

        //involucrados cuerpo

  
    $pdf->SetLineWidth(0.1); 
    $pdf->SetFillColor(255,255,255); 
    $pdf->Rect(5, 119, 200, 20, "DF");
    $pdf->SetXY( 5, 119 ); 
    $pdf->SetFont( "Arial", "B", 10 ); 
    //$pdf->Cell( 0, 6, $texto_involucrados, 0, 0, 'C',false);
    $pdf->Cell( $pdf->GetPageWidth(), 7,  $texto_testigos , 0, 0, 'L');


    //------------------------------------------------
    // ¿ es un incidente ?
    //-------------------------------------------------
    $str_pregunta =  utf8_decode("¿Es un incidente de desproteccion infantil ?");
    $pdf->SetLineWidth(0.1); 
    $pdf->SetFillColor(173,216,230); 
    $pdf->Rect(5, 147, 150, 8, "DF");
    $pdf->SetXY( 5, 147 ); 
    $pdf->SetFont( "Arial", "B", 10 ); 
    $pdf->Cell( 0, 8, $str_pregunta , 0, 0, 'C');

 
  
    
    $texto_incidente = " SI ";

    $pdf->SetLineWidth(0.1); 
    $pdf->SetFillColor(255,255,255); 
    $pdf->Rect(155, 147, 50, 8, "DF");
    $pdf->SetXY( 155, 147 ); 
    $pdf->SetFont( "Arial", "B", 10 ); 
    $pdf->Cell( 0, 8, $texto_incidente, 0, 0, 'C');

    // **************************
    // pied de page
    // **************************
    $pdf->SetLineWidth(0.1);
    $pdf->Rect(5, 268, 200, 6, "D");
    $pdf->SetXY( 5, 268 ); 
    $pdf->SetFont('Arial','',7);
    $pdf->Cell( $pdf->GetPageWidth(), 7, "Plataforma interna de proteccion infantil de Aldeas Infantiles SOS de Mexico y  IAP  Pagina 2/2", 0, 0, 'C');
        
  
   
    // on sup les 2 cm en bas
    $pdf->SetAutoPagebreak(False);
    $pdf->SetMargins(0,0,0);

  
    //al final cambiar parametro I y por F
    $pdf->Output("I", $nombre_archivo);
?>