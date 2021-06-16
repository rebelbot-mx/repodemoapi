<?php



trait traitValidarAbordaje{

    function validar($incidenteid){

        $incidente = DB::queryFirstRow("select * from abordajinterno where incidenteid = %i", $incidenteid);
    

       $r1 = 0;
       $r1 =$this->No_es_Valido($incidente['plan'],'POR CONFIRMAR');
       
       $r2 = 0;
       $r2 = $this->No_es_Valido($incidente['status'],'');


       $r3 = 0;
       if($incidente['plan']== "SI") {
       $r3 = $this->No_es_Valido($incidente['plan_docto'],0);
       }


       $r4 = 0;
       if($incidente['documentos']=='SI APLICA'){
       $r4 = $this->No_es_Valido($incidente['documentos_docto'],0);
       }
      /* $r6 = 0;
       $r6 = $this->No_es_Valido($incidente['documentos'],0);*/


       $total =  $r1+ $r2 + $r3 + $r4;

       error_log(" r1 " .  $r1);
       error_log(" r2 " .  $r2);
       error_log(" r3 " .  $r3);
       error_log(" r4 " .  $r4);
       //error_log(" r6 " .  $r6);

    

       error_log(" valor de  total validacion abordaje " . $total);
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