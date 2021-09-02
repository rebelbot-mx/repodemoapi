<?php



trait trait_validarSeguimiento {

    function validarSeguimiento($id){

        $r1 =0;

        $temp_actavaloracion = DB::queryFirstField("select actavaloracion_docto from incidente where id = %i",$id);

        $actavaloracion_docto = str_replace( '"','',$temp_actavaloracion );

        $actavaloracion_docto == 0 ?  $r1=1 : $r1 = 0 ;
        //-----------------------------------------------------------------------


        $r2 = 0;

        $temp_actavaloracioninte = DB::queryFirstField("select medidasintegrales from valoracionintegral where incidenteid = %i",$id);

        $actavaloracioninte_docto = str_replace( '"','',$temp_actavaloracioninte );

        $actavaloracioninte_docto == 0 ?  $r2=1 : $r2 = 0 ;

        //-------------------------------------------------------------------------

        $denuncia = DB::queryFirstRow("select * from denuncialegal where incidenteid = %i",$id );

        $consenso                 = str_replace('"','',$denuncia["consenso"]);
        $consensodocto            = str_replace('"','',$denuncia["consensodocto"]);

        $denunciapresentada        = str_replace('"','',$denuncia["denunciapresentada"]);
        $docto_denunciapresentada  = str_replace('"','',$denuncia["docto_denunciapresentada"]);

        $medidasd                  = str_replace('"','', $denuncia["medidasd"]);
        $medidasd_docto            = str_replace('"','', $denuncia["medidasd_docto"]);

        
        $r3 = 0;

        $consenso                 == 'POR CONFIRMAR' ?  $r3 =1 : $r3 =0;

        $r4 = 0;
        $consensodocto            == 0 ?  $r4=1 : $r4 =0;

        $r5 =0;
        $denunciapresentada       == "SI" ? $r5 =0 : $r5=1;

        $r6 = 0;
        $docto_denunciapresentada == 0 ? $r6 =1 : $r6=0;

        $r7 = 0;
        $medidasd                 == "SI" ? $r7 =0 : $r7 = 1;

        $r8 = 0;
        $medidasd_docto           == 0 ? $r8 = 1 : $r8 =0;


        //--------------------------------------------------------------------------
        
        $seguimiento  = DB::queryFirstRow("select * from seguimiento where incidenteid = %i", $id);

        
        
        $notificacionpfn                = str_replace('"','',$seguimiento["notificacionpfn"]);
        $notificacionpfn_docto          = str_replace('"','',$seguimiento["notificacionpfn_docto"]);

        $notificaciodenunciante          = str_replace('"','',$seguimiento["notificaciodenunciante"]);
        $notificaciondenunciante_docto  = str_replace('"','',$seguimiento["notificaciondenunciante_docto"]);

        $planrecuperacion                = str_replace('"','',$seguimiento["planrecuperacion"]);
        $planrecuperacion_docto          = str_replace('"','',$seguimiento["planrecuperacion_docto"]);
    
        
        $r9 = 0 ;
        $notificacionpfn  == "POR CONFIRMAR" ? $r9= 1 : $r9=0;

        $r10 = 0;
        $notificacionpfn_docto == 0  ? $r10 =1  : $r10=0 ;

        $r11 = 0;
        $notificaciodenunciante == "POR CONFIRMAR" ? $r11 = 1 : $r11 = 0;

        $r12  = 0;
        $notificaciondenunciante_docto == 0 ? $r12 =1 : $r12 =0;

        $r13 = 0;
        $planrecuperacion  == "POR CONFIRMAR" ? $r13 = 1 : $r13 = 0 ;

        $r14 = 0;
        $planrecuperacion_docto  == 0  ? $r14 = 1 : $r14 =0;  

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
        error_log(" r13 " . $r13);
        error_log(" r14 " . $r14);

        $suma  = 0;


        $suma = $r1  + $r2  + $r3  + $r4 + $r5  +
                $r6  + $r7  + $r8  + $r9 + $r10 + 
                $r11 + $r12 + $r13 + $r14;
                
        
       error_log("suma =  " . $suma);

       $estado ="abierto";
       $res = false;

       $suma ==0 ? $res=true : $res = false;


       if ($res == true ){

        $estado  = "cerrado";

          //----------------------------------------
          // ACTUALIZAMOS LA TABLA SEGUIMIENTO
          //-----------------------------------------
           
           DB::update( 'seguimiento', 
                    
           [
               'estado' => 'cerrado'
           ],

           " incidenteid =%i",
           $id 
           );

          //----------------------------------------
          // ACTUALIZAMOS LA TABLA INCIDENTE
          //-----------------------------------------
          DB::update( 'incidente', 
                    
          [
              'coloretapatres' => 'green'
          ],

          " id =%i",
          $id 
          );

       }else {
          //----------------------------------------
          // ACTUALIZAMOS LA TABLA INCIDENTE
          //-----------------------------------------
          DB::update( 'incidente', 
                    
          [
              'coloretapatres' => 'yellow'
          ],

          " id =%i",
          $id 
          );
          //----------------------------------------
          // ACTUALIZAMOS LA TABLA SEGUIMIENTO
          //-----------------------------------------
           
          DB::update( 'seguimiento', 
                    
          [
              'estado' => 'abierto'
          ],

          " incidenteid =%i",
          $id 
          );

       }//termina actualizacion de tablas

       return $estado ;


    }
}