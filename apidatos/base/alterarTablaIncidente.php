<?php
$servername = "localhost";
$username = "aisosmx_rebelbot";
$password = "Rebelware10*";
$dbname = "aisosmx_apialdeas";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die(" fallo la conexion: " . $conn->connect_error);
}




$sql4 = "ALTER TABLE `incidente` ADD `fechaCierre` DATE NULL AFTER `estado`;";

if ($conn->query($sql4) === TRUE) {
  echo "se agrego el campo de fecha de cierre a la tabla incidentes  successfully";
} else {
  echo "Error incidentes : " . $conn->error;
}


$conn->close();
?> 