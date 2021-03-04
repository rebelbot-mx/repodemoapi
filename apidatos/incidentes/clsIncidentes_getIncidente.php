<?php 
require 'traitSePuedeRealizarElcierre.php';
class clsIncidentes_getIncidente { 
     use traitSePuedeRealizarElcierre;

    public function getIncidente($id){

        $results = DB::queryFirstRow("SELECT * FROM incidente where id =%i " ,$id );
        
        $pr = $results['programa'];

        $nombrePrograma  = DB::queryFirstField("select programa from programas where id = %i",$pr);
        $results['nombreprograma']=$nombrePrograma;
        //$estadoSeguimiento = $this->estadoDelSeguimiento($id);

        //$results['estado'] =$estadoSeguimiento;

        return json_encode($results);


    }




}