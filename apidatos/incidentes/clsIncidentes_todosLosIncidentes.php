<?php 

class clsIncidentes_todosLosIncidentes { 
 
    public function todosLosIncidentes_join(){

        $results = DB::query("SELECT * FROM incidente");

        return json_encode($results);


    }

    public function todosLosIncidentes($idusuario) {

        /* $results = DB::query("SELECT * FROM tbl WHERE name=%s AND age > %i AND height <= %d", $name, 15, 13.75);

foreach ($results as $row) {
  echo "Name: " . $row['name'] . "\n";
  echo "Age: " . $row['age'] . "\n";
  echo "Height: " . $row['height'] . "\n";
  echo "-------------\n";
}*/
//$results = DB::query("SELECT * FROM incidente i join valoracionintegral v on v.incidenteid = i.id join seguimiento s on s.incidenteid = i.id ");

//Se obtienen los datos del usuario .
$datosUsuario = DB::queryFirstRow("select * from usuarios where id = %i",$idusuario);
$programaid =$datosUsuario["programa"];

/*
//  
     { text: "Programa", value: "programa" },
      { text: "Fecha", value: "fechaAlta" },
      { text: "¿Incidente?", value: "incidenteconfirmado" },
      { text: "Confirmacion", value: "confirmaincidente" },

      { text: "Respuesta", value: "tipoderespuesta" },
      //{ text: "Hechos", value: "data-table-expand" },
      // { text: "Activo", value: "activo" },
      { text: "Estado", value: "estado" },
      { text: "R Inicial", value: "etapauno" },
      { text: "V Integral", value: "etapados" },
      { text: "Seguimiento", value: "etapatres" },
      { text: "Cierre", value: "etapacuatro" },
      //{ text: "Etapas", value: "actions", sortable: false },
    ],

*/

if ($programaid  == 0){

    $results = DB::query("SELECT 
       i.id as 'id',
       i.folio as 'folio',
       i.programa ,
       i.fechaAlta as 'fechaAlta',
       i.incidenteconfirmado as 'incidenteconfirmado',
       v.confirmaincidente as 'confirmaincidente',
       v.tipoderespuesta as 'tipoderespuesta',
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
       FROM incidente i join valoracionintegral v on v.incidenteid = i.id ");

return json_encode($results);


}else {
    $results = DB::query("SELECT 
       i.id as 'id',
       i.folio as 'folio',
       i.programa ,
       i.fechaAlta as 'fechaAlta',
       i.incidenteconfirmado as 'incidenteconfirmado',
       v.confirmaincidente as 'confirmaincidente',
       v.tipoderespuesta as 'tipoderespuesta',
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
       FROM incidente i join valoracionintegral v on v.incidenteid = i.id where i.programa = %s",$programaid);

return json_encode($results);

}


    }//termina


}