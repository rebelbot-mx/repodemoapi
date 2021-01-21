<?php
/*$servername = "localhost";
$username = "mcabrera2";
$password = "2478*";
$dbname = "apialdeas";*/

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

// sql to create table
$sql = "DROP TABLE usuarios";



if ($conn->query($sql) === TRUE) {
  echo "Table usuarios dropeada exitosamente";
} else {
  echo "Error en drop table " . $conn->error;
}


$conn->close();
?> 