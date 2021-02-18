<?php 
require 'traitSePuedeRealizarElcierre.php';
class clsIncidentes_getIncidente { 
     use traitSePuedeRealizarElcierre;

    public function getIncidente($id){

        $results = DB::query("SELECT * FROM incidente where id =%i " ,$id );
        
        //$estadoSeguimiento = $this->estadoDelSeguimiento($id);

        //$results['estado'] =$estadoSeguimiento;

        return json_encode($results);


    }




}