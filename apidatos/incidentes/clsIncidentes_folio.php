<?php

class clsIncidentes_folio{

    public function generarFolio($unidadId) {

        //aqui generarmos el folio con la nomenclatura 
        // unidad - numerodecaso- año
       
        $ano =date("Y");
        
        $cuantos =  DB::queryFirstField("SELECT COUNT(*) FROM incidente where year(fechaAlta) = $ano and programa ='$unidadId' ");

        $folio = $cuantos + 1;

        $folioprefijo =DB::queryFirstField("select prefijofolio from programas where id =%i",$unidadId);

        

        $folioGenerado = $folioprefijo . '-' . $folio . '-' . $ano;

        return $folioGenerado;

    }

}