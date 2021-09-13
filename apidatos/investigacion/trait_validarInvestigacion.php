<?php 




trait trait_validarInvestigacion {

    function validarInvestigacion($datos) {

        $registroincidentes_docto     = str_replace( '"','', $datos['registroincidentes_docto']);
        $cartautorizacion_docto       = str_replace( '"','', $datos['cartautorizacion_docto']);
        $terminosreferencia_doctp     = str_replace( '"','', $datos['terminosreferencia_doctp']);
        $plan_docto                   = str_replace( '"','', $datos['plan_docto']);    
        $informe_docto                = str_replace( '"','', $datos['informe_docto']);

        $r1 = 0 ;
        strlen($registroincidentes_docto) > 10 ? $r1 = 0 : $r1=1;

        $r2 = 0;
        $cartautorizacion_docto== 0  ? $r2 = 1 : $r2 = 0;

        $r3 = 0;
        $terminosreferencia_doctp== 0  ? $r3 = 1 : $r3 = 0;

        $r4 = 0;
        $plan_docto== 0  ? $r4 = 1 : $r4 = 0;


        $r5 =0;
        $informe_docto== 0  ? $r5 = 1 : $r5 = 0;


        $r6 = 0;
        $cuantasPruebas = DB::queryFirstField(" select count(*) from evidencias where investigacionid = %i", $datos["id"]);
        $cuantasPruebas > 0 ? $r6 =0 : $r6=1;


        $suma = 0;
        $suma =  $r1 +$r2 +$r3 +$r4+$r5+$r6;

        error_log(" validando investigacion ");
        error_log($r1);
        error_log($r2);
        error_log($r3);
        error_log($r4);
        error_log($r5);
        error_log($r6);

        $res = false;

        $suma == 0 ? $res= true : $res = false;

        return $res;

    }

}