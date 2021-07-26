<?php 

class clsOPeracionesdb {

    public function truncartablas(){

    $servername  = DB::$host;
    $username    = DB::$user;
    $password    = DB::$password;
    $dbname      = DB::$dbName;

  
   
  // Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die(" fallo la conexion: " . $conn->connect_error);
}


$sql1="truncate  TABLE abordajinterno ;";
$sql2="truncate  TABLE conciencia ;";
$sql3="truncate  TABLE denuncialegal ;";

$sql4="truncate  TABLE doctos ;";

$sql5="truncate  TABLE evidencias ;";

$sql6="truncate  TABLE incidente ;";

$sql7="truncate  TABLE investigacion ;";

$sql8="truncate  TABLE permisosimpresion ;";

$sql9="truncate  TABLE seguimiento ;";

$sql10="truncate  TABLE valoracionintegral ;";





if ($conn->query($sql1) === TRUE) {
    echo "abordajeinterno truncate ok";
  } else {
    echo "Error abordajeinterno : " . $conn->error;
  }

  if ($conn->query($sql2) === TRUE) {
    echo "conciencia ok";
  } else {
    echo "Error conciencia : " . $conn->error;
  }

  if ($conn->query($sql3) === TRUE) {
    echo "denuncialegal  ok";
  } else {
    echo "Error  denuncialegal : " . $conn->error;
  }

  if ($conn->query($sql4) === TRUE) {
    echo "docotos ok";
  } else {
    echo "Error doctos : " . $conn->error;
  }


/***************************** */

if ($conn->query($sql5) === TRUE) {
    echo "evidencias ok";
  } else {
    echo "Error evidencias : " . $conn->error;
  }

  if ($conn->query($sql6) === TRUE) {
    echo "incidentes ok";
  } else {
    echo "Error incidentes : " . $conn->error;
  }

  if ($conn->query($sql7) === TRUE) {
    echo "investigacion ok";
  } else {
    echo "Error investigacion : " . $conn->error;
  }

  if ($conn->query($sql8) === TRUE) {
    echo "permisosimpresion ok";
  } else {
    echo "Error permisosimpresion : " . $conn->error;
  }


  if ($conn->query($sql9) === TRUE) {
    echo "seguimiento ok";
  } else {
    echo "Error seguimiento : " . $conn->error;
  }


  if ($conn->query($sql10) === TRUE) {
    echo "valoracionintegral ok";
  } else {
    echo "Error valoracionintegral : " . $conn->error;
  }


  $conn->close();


  $data = array(
    'msg' => 'ok');

 return json_encode($data);
        
       
    }



}