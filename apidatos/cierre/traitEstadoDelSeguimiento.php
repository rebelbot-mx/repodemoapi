<?php

trait traitEstadoDelSeguimiento{
 
 function  estadoDelSeguimiento($id) {

   $estadoDelSeguimiento = DB::queryFirstField("select estado from seguimiento where incidenteid = %i",$id);

   return $estadoDelSeguimiento;
   }

}