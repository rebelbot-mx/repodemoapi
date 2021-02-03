<?php

class clsIncidentes_folio{

    public function generarFolio($unidadId) {

        //aqui generarmos el folio con la nomenclatura 
        // unidad - numerodecaso- año

        // se recibe el nombre del programa y obtenemos el di 

        $programaDatos = DB::queryFirstRow("select id,prefijofolio from programas where programa= %s",$unidadId);
       
        $idPrograma = $programaDatos['id'];

        $folioprefijo = $programaDatos['prefijofolio'];
        
        $ano =date("Y");
        
        $cuantos =  DB::queryFirstField("SELECT COUNT(*) FROM incidente where year(fechaAlta) = $ano and programa ='$idPrograma'");

        $folio = $cuantos + 1;
       

        $folioGenerado = $folioprefijo . '-' . $folio . '-' . $ano;

        $resultado = array();
        $resultado['folio'] = $folioGenerado;
        $resultado['id'] = $idPrograma;

        return  $resultado;

    }

}