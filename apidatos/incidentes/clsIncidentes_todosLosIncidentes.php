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

$results = DB::query("SELECT * FROM incidente i join valoracionintegral v on v.incidenteid = i.id and i.progama = %s",$programaid);

return json_encode($results);

    }


}