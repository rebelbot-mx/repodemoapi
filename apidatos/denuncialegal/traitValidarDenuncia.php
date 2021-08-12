<?php


trait traitValidarDenuncia{

    function validar($id){
    /*
    Consenso nacional para denuncia debe ser "CONFIRMADO"
    y el documento adjunto es obligatorio 

    Informa al patronato cualquier valor esta bien y el documento
    adjunto es opcional

    Informa a la oficina regional cualquier valor esta bien y el documento
    adjunto es opcional

    Informa al ente rector cualquier valor esta bien y el documento
    adjunto es opcional

    Para los valores de soporte de un asesor legal deben de ser distinto de
    "POR CONFIRMAR" Y el documento adjunto es obligatorio

    Para los valores de soporte emocional para nnaj deben de ser distinto de
    "POR CONFIRMAR" Y el documento adjunto es obligatorio

    Para los valores de medidas disciplinarias ligadas al resultados de las 
    denuncias debe de ser distinto a "POR CONFIRMAR" Y el documento adjunto 
    es obligatorio

    Para el texto  "ACERCA DE LAS MEDIDAS" debe de tener un valor distinto a 
    "POR CONFIRMAR"
    
    Para la denuncia presentada el valor debe de ser distinto a  "POR CONFIRMAR"
    Y el documento adjunto es obligatorio  

    */
     
     $denuncia = DB::queryFirstRow("select * from denuncialegal where id = %i",$id);
      
     $r1 = 0;
     $r1 =$this->No_es_Valido($denuncia['consenso'],'POR CONFIRMAR');
    
    // si el consenso es no , puede guardarse
    $r2 = 0;
    if ($denuncia['consenso']=="SI"){
    $r2 = $this->No_es_Valido($denuncia['consensodocto'],0);
    }


    $r3 = 0;
    $r3 = $this->No_es_Valido($denuncia['soportecontacto'],'POR CONFIRMAR');

    $r4 = 0;
    $r4 = $this->No_es_Valido($denuncia['soporteantes'],'POR CONFIRMAR');

    $r5 = 0;
    $r5 = $this->No_es_Valido($denuncia['soportedurante'],'POR CONFIRMAR');

    $r6 = 0;
    $r6 = $this->No_es_Valido($denuncia['soporteemocionalcontacto'],'POR CONFIRMAR');

    $r7 = 0;
    $r7 = $this->No_es_Valido($denuncia['soporteemocionalantes'],'POR CONFIRMAR');

    $r8 = 0;
    $r8 = $this->No_es_Valido($denuncia['soporteemocionaldurante'],'POR CONFIRMAR');
    
    $r9 = 0;
    $r9 = $this->No_es_Valido($denuncia['medidasd'],'POR CONFIRMAR');

    
    // si las medidas son igual a no pueden guardarse , puede guardarse
    $r10 = 0;
    if ($denuncia['medidasd']=="SI") {
    
     error_log("valor de medidasd_docto en la validacion " . $denuncia['medidasd_docto']);
  
     $temp_doctodenu_medidasd_docto = $denuncia['medidasd_docto'];
    
    $temp_docto_md = str_replace('"','',$temp_doctodenu_medidasd_docto);

    $r10= $this->No_es_Valido($temp_docto_md,0);
    }
   


    $r11 = 0;
    $r11 = $this->No_es_Valido($denuncia['medidastexto'],'POR CONFIRMAR');

    /*************************************************************
     * Validar que si exista un documento para la denuncia
     * ***********************************************************/ 
  
    $r12 = 0;
    error_log("valor de docto_denunciapresentada en la validacion " . $denuncia['docto_denunciapresentada']);
  
    $temp_docto_denunciapresentada = $denuncia['docto_denunciapresentada'];

    $temp_docto_dp = str_replace('"','',$temp_docto_denunciapresentada);

    error_log("valor de temp_docto_dp en la validacion " . $temp_docto_dp);
    error_log(" r12 " . $r12);

    $r12 = $this->No_es_Valido($temp_docto_dp,'0');

    error_log(" r12 " . $r12);
    /*****************************************************************/


     /*************************************************************
     * Validar que si exista un documento para soporte emocional
     * ***********************************************************/ 
  
    $r13 = 0;
    error_log("valor de docto_soporteemocional en la validacion " . $denuncia['docto_soporteemocional']);
  
    $temp_docto_soporteemocional = $denuncia['docto_soporteemocional'];

    $temp_docto_dpse = str_replace('"','',$temp_docto_soporteemocional);

    error_log("valor de temp_docto_dpse en la validacion " . $temp_docto_dpse);
    error_log(" r13 " . $r13);

    $r13 = $this->No_es_Valido($temp_docto_dpse,'0');

    error_log(" r13 " . $r13);
    /*****************************************************************/


     /*************************************************************
     * Validar que si exista un documento para soporte emocional
     * ***********************************************************/ 
  
    $r14 = 0;
    error_log("valor de docto_soporteemocional en la validacion " . $denuncia['docto_soporteemocional']);
  
    $temp_docto_soporteemocional = $denuncia['docto_soporteemocional'];

    $temp_docto_dpse = str_replace('"','',$temp_docto_soporteemocional);

    error_log("valor de temp_docto_dpse en la validacion " . $temp_docto_dpse);
    error_log(" r14 " . $r14);

    $r14 = $this->No_es_Valido($temp_docto_dpse,'0');

    error_log(" r14 " . $r14);
    /*****************************************************************/

     /*************************************************************
     * Validar que si exista un documento para soporte legal
     * ***********************************************************/ 
  
    $r15 = 0;

    error_log("valor de docto_soportelegal en la validacion " . $denuncia['docto_soportelegal']);
  
    $temp_docto_soportelegal = $denuncia['docto_soportelegal'];

    $temp_docto_dpsl = str_replace('"','',$temp_docto_soportelegal);

    error_log("valor de temp_docto_dpsl en la validacion " . $temp_docto_dpsl);
    error_log(" r15 " . $r15);

    $r15 = $this->No_es_Valido($temp_docto_dpsl,'0');

    error_log(" r15 " . $r15);
    /*****************************************************************/
    error_log(" r1 " . $r1);
    error_log(" r2 " . $r2);
    error_log(" r3 " . $r3);
    error_log(" r4 " . $r4);
    error_log(" r5 " . $r5);

    error_log(" r6 " . $r6);
    error_log(" r7 " . $r7);
    error_log(" r8 " . $r8);
    error_log(" r9 " . $r9);
    error_log(" r10 " . $r10);

    error_log(" r11 " . $r11);
    error_log(" r12 " . $r12);

    $total =  $r1+ $r2 + $r3 + $r4+ $r5 + $r6 + $r7 + $r8 + $r9  + $r10 + $r11 + $r12 + $r13 + $r14 + $r15;


    error_log(" valor de  totla " . $total);
    if($total == 0) {
        return true; // se puede validar
    }else{
        return false; // no se puede validar
    }
    

    }


    function esValido($campo, $valor){
        $res=0;
        if ($campo== $valor){
            $res = 0;

        }else {

         $res=1;
        }
        return $res;
 }

 function No_es_Valido($campo, $valor){
     $res=0;
     if ($campo== $valor){
         $res = 1;

     }else {

      $res=0;
     }
     return $res;
}
}