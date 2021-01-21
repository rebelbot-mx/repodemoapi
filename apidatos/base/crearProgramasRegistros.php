<?php
$servername = "localhost";
$username = "mcabrera2";
$password = "2478*";
$dbname = "apialdeas";
/*
$servername = "localhost";
$username = "aisosmx_rebelbot";
$password = "Rebelware10*";
$dbname = "aisosmx_apialdeas";*/


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die(" fallo la conexion: " . $conn->connect_error);
}


$sql2 = "INSERT INTO `programas` ( `programa`, `abreviatura`, `prefijofolio`) VALUES
( 'ACOGIMIENTO FAMILIAR TIJUANA', 'AF-TIJUANA', 'TIJ'),
('ACOGIMIENTO FAMILIAR MORELIA', 'AF-MORELIA', 'MO'),
( 'ACOGIMIENTO FAMILIAR CDMNX', 'AD-CDMX', 'MX'),
( 'ACOGIMIENTO FAMILIAR TUXTLA', 'AF TUXTLA', 'TX'),
( 'ACOGIMIENTO FAMILIAR COMITAN', 'AF COMITAN', 'CO'),
( 'FORTALECIMIENTO FAMILIAR HUEHUETOCA', 'FF HUEHUETOCA', 'HU'),
( 'FORTALECIMIENTO FAMILIAR TEHUACAN', 'FF TEHUACAN', 'TH'),
( 'FORTALECIMIENTO FAMILIAR COMITAN', 'FF COMITAN', 'COMITAN');";



if ($conn->query($sql2) === TRUE) {
  echo "Registros de los Programas Creados";
} else {
  echo "Error al crear los registros de los programas " . $conn->error;
}

$conn->close();
?> 