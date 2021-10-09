<?php



trait traitValidarAbordaje{

    /*

    incidenteid              : this.incidenteIdPE,        
            status                   : this.$store.state.abordaje.abordaje_status,
            estado_informeenterector : this.$store.state.abordaje.abordaje_informaenterector,
            id_informeenterector     : this.$store.state.abordaje.abordaje_docto_informaenterector,           
           
            estado_pfn               : this.$store.state.abordaje.abordaje_seg_estado_pfn,
            id_pfn                   : this.$store.state.abordaje.abordaje_seg_docto_pfn,
            estado_pd                : this.$store.state.abordaje.abordaje_seg_estado_pd,
            id_pd                    : this.$store.state.abordaje.abordaje_seg_docto_pd,
            estado_pr
            id_pr
            
            id_actahechos            : this.$store.state.abordaje.abordaje_docto_actahecho,
            id_actavaloracion  

            */
    

    function validarAbordaje($incidenteid){


        $incidente = DB::queryFirstRow("select * from abordajinterno where incidenteid = %i", $incidenteid);
       
        $seguimiento = DB::queryFirstRow("select * from seguimiento where incidenteid = %i", $incidenteid);
    
        $actahecho = DB::queryFirstRow("select actavaloracion_docto from incidente where id = %i", $incidenteid);
    
        $actavaloracion = DB::queryFirstField("select medidasintegrales from valoracionintegral where incidenteid = %i", $incidenteid);
    
           
       $r2 = 0;
       error_log (" estatus " . $incidente['status'] ); 
       $r2 = $this->No_es_Valido_abordaje($incidente['status'],'');

       $r3 = 0;
       error_log ("ente rector " .  $incidente['informaenterector'] ); 
       $r3 =$this->No_es_Valido_abordaje($incidente['informaenterector'],'POR CONFIRMAR');
   

       $r4 = 0;
       $valida_r4 = str_replace('"',  '' , $incidente['docto_informaenterector']);
       error_log ("docto_informaenterector " . $valida_r4 ); 
       $valida_r4 == 0 ? $r4 =1 : $r4 = 0;

       /*
         "notificacionpfn"                =>    $parametros['estado_pfn'],
         "notificaciodenunciante"         =>    $parametros['estado_pd'],           
         "planrecuperacion"               =>    $parametros['estado_pr'],  
         "notificacionpfn_docto"          =>    $parametros['id_pfn'],
         "notificaciodenunciante_docto"   =>    $parametros['id_pd'],           
         "planrecuperacion_docto"         =>    $parametros['id_pr'],  
         */
       $r5 = 0;
       $r5 =$this->No_es_Valido_abordaje($seguimiento['notificacionpfn'],'POR CONFIRMAR');

       $r6 = 0;
       //$r6 =$this->No_es_Valido_abordaje($seguimiento['notificaciodenunciante'],'POR CONFIRMAR');

       $r7 = 0;
       $r7 =$this->No_es_Valido_abordaje($seguimiento['planrecuperacion'],'POR CONFIRMAR');

       $r8 = 0;
       $valida_r8 = str_replace ( '"',  '' , $seguimiento['notificacionpfn_docto'] ) ;
       error_log ("notificacionpfn_docto " . $valida_r8 ); 
       $valida_r8 == 0 ? $r8 = 1 : $r8 = 0;

       $r9 = 0;
       $valida_r9 = str_replace ( '"',  '' , $seguimiento['notificaciondenunciante_docto'] ) ;
      // $r9 =$this->No_es_Valido_abordaje($seguimiento['notificaciondenunciante_docto'],'0');
      
     if( $seguimiento['notificaciodenunciante']=='POR CONFIRMAR'){
           
        $r9=0;

     }else {

        $valida_r9 == 0 ? $r9 = 1 : $r9 = 0;

     }


       $r10 = 0;
       $valida_r10 = str_replace ( '"',  '' , $seguimiento['planrecuperacion_docto'] ) ;
       $valida_r10 == 0 ? $r10 = 1 : $r10 = 0;
       //$r10 =$this->No_es_Valido_abordaje($seguimiento['planrecuperacion_docto'],'0');

       
      

       $r11 = 0;
       $valida_r11 = str_replace ( '"',  '' , $actahecho ) ;
       $valida_r11 == 0 ? $r11 = 1 : $r11 = 0;

       $r12 = 0;
       $valida_r12 = str_replace ( '"',  '' , $actavaloracion ) ;
       $valida_r12 == 0 ? $r12 = 1 : $r12 = 0;


       
      /* $r6 = 0;
       $r6 = $this->No_es_Valido_abordaje($incidente['documentos'],0);*/


       $total =   $r2  +$r3 + $r4 +$r5 +$r6 + $r7 +$r8 +$r9 +$r10 + $r11 +$r12;

      // error_log(" r1 " .  $r1);
       error_log(" r2 " .  $r2);
       error_log(" r3 " .  $r3);
       error_log(" r4 " .  $r4);
       error_log(" r5 " .  $r5);
       error_log(" r6 " .  $r6);
       error_log(" r7 " .  $r7);
       error_log(" r8 " .  $r8);
       error_log(" r9 " .  $r9);
       error_log(" r10 " .  $r10);
       error_log(" r11 " .  $r11);
       error_log(" r12 " .  $r12);
       error_log(" total validacion abordaje interno " .  $total);
       //error_log(" r6 " .  $r6);

    

       error_log(" valor de  total validacion abordaje " . $total);
       
       if($total == 0) {
           return true; // se puede validar
       }else{
           return false; // no se puede validar
       }
       

    }


    
function esValidoAbordaje($campo, $valor){
        $res=0;
        if ($campo== $valor){
            $res = 0;

        }else {

         $res=1;
        }
        return $res;
 }

 function No_es_Valido_abordaje($campo, $valor){
     $res=0;
     if ($campo== $valor){
         $res = 1;

     }else {

      $res=0;
     }
     return $res;
}


}