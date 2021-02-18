<?php
trait traitSePuedeRealizarElcierre{
 
  function  estadoDelSeguimiento($id) {

    $est = DB::queryFirstField("select estado from seguimiento where incidenteid = %i",$id);

    return $est;
    }

}