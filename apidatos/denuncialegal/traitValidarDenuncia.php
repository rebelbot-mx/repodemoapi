<?php


trait traitValidarDenuncia{

    function validar($id){

     
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
    $r10= $this->No_es_Valido($denuncia['medidasd_docto'],0);
    }
   


    $r11 = 0;
    $r11 = $this->No_es_Valido($denuncia['medidastexto'],'POR CONFIRMAR');

    $total =  $r1+ $r2 + $r3 + $r4+ $r5+ $r6 + $r7 + $r8 +$r9 + $r10 +$r11 ;
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