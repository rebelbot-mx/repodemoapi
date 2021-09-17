<?php 
require 'traitSePuedeRealizarElcierre.php';
require 'trait_formarDatosNavegacion.php';
class clsIncidentes_getIncidente { 
     use traitSePuedeRealizarElcierre,trait_formarDatosNavegacion;

    public function getIncidente($id){

        $results = DB::queryFirstRow("SELECT * FROM incidente where id =%i " ,$id );
        
        $pr = $results['programa'];

        $nombrePrograma  = DB::queryFirstField("select programa from programas where id = %i",$pr);
        $idUsuarioCreador  = $results["usuarioCreador"];

        $usuarioCreador = DB::queryFirstRow("select nombre,programa from usuarios where id = %i",$idUsuarioCreador);
        $programa = DB::queryFirstField("select programa from programas where id = %i",$usuarioCreador['programa']);
    
        $results['nombreprograma']=$nombrePrograma;
        $results['usuarioCreador']= $usuarioCreador['nombre'] . " --  " . $programa;
        //$estadoSeguimiento = $this->estadoDelSeguimiento($id);

        //$results['estado'] =$estadoSeguimiento;

        $datosNavegacion =$this->getDatosNavegacion($id);
        $results['datosNavegacion']=$datosNavegacion;
        return json_encode($results);


    }




}