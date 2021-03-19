<?php

class clsIncidentes_buscarIncidentePorFolio {

                    
   public  function buscarIncidentePorFolio($folio){

      $sql = "select * from incidente where folio = '". $folio ."'";
      $results = DB::query($sql);

      /*$pr = $results['programa'];

      $nombrePrograma  = DB::queryFirstField("select programa from programas where id = %i",$pr);
      $idUsuarioCreador  = $results["usuarioCreador"];

      $usuarioCreador = DB::queryFirstRow("select nombre,programa from usuarios where id = %i",$idUsuarioCreador);
      $programa = DB::queryFirstField("select programa from programas where id = %i",$usuarioCreador['programa']);
  
      $results['nombreprograma']=$nombrePrograma;
      $results['usuarioCreador']= $usuarioCreador['nombre'] . " --  " . $programa;
      //$estadoSeguimiento = $this->estadoDelSeguimiento($id);

      //$results['estado'] =$estadoSeguimiento;*/

      return json_encode($results);

    }


}