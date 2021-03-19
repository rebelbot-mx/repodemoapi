<?php


trait traitValidarInvestigacion{

    function validar($id){

     
     $denuncia = DB::queryFirstRow("select * from investigacion where id = %i",$id);
      
    
    $r1 = 0;
    $r1 = $this->No_es_Valido($denuncia['registroincidentes_docto'],'0');

    $r2 = 0;
    $r2 = $this->No_es_Valido($denuncia['cartautorizacion_docto'],0);

    $r3 = 0;
    $r3 = $this->No_es_Valido($denuncia['terminosreferencia_doctp'],0);
  
    $r4 = 0;
    $r4 = $this->No_es_Valido($denuncia['plan_docto'],0);

    $r5 = 0;
    $r5 = $this->No_es_Valido($denuncia['informe_docto'],0);
    
     
     error_log($r1. $r2 . $r3 . $r4. $r5 );
    

    $total =  $r1+ $r2 + $r3 + $r4+ $r5 ;
    error_log(" valor de  traitValidarInvestigacion " . $total);
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