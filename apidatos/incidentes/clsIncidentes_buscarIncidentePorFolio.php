<?php

class clsIncidentes_buscarIncidentePorFolio {

                    
   public  function buscarIncidentePorFolio($folio){

    //  $sql = "select * from incidente where folio like '%". $folio ."%'";
    $query = "SELECT 
    i.id as 'id',
    i.folio as 'folio',
    i.programa ,
    i.fechaAlta as 'fechaAlta',
    i.incidenteconfirmado as 'incidenteconfirmado',
    v.confirmaincidente as 'confirmaincidente',
    v.tipoderespuesta as 'tipoderespuesta',
    v.estadorespuesta as 'estadorespuesta',
    v.colorestadorespuesta as 'colorestadorespuesta',
    i.estado as 'estado',
    i.etapauno as 'etapauno',
    i.etapados as 'etapados',
    i.etapatres as 'etapatres',
    i.etapacuatro as 'etapacuatro',
    i.coloretapauno as 'coloretapauno',
    i.coloretapados as 'coloretapados',
    i.coloretapatres as 'coloretapatres',
    i.coloretapacuatro as 'coloretapacuatro',
    v.estado as 'estadoseguimiento',
    v.confirmaincidentenumerico as 'confirmaincidentenumerico'
    FROM incidente i join valoracionintegral v on v.incidenteid = i.id 
    where i.folio like '%". $folio ."%'";

    $results = DB::query($query);

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