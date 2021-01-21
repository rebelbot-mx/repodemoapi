<?php
/*
DB::$user = 'mcabrera';
DB::$password = '2478';
DB::$dbName = 'apialdeas';*/
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


$sql2 = "INSERT INTO `usuarios` ( `nombre`, `email`, `password`, `rol`, `programa`, `fechaCreacion`, `activo`) VALUES
( 'ADMINISTRADOR', 'a@g.com', '12345', '1', 1, '2021-01-08', '1')";




if ($conn->query($sql2) === TRUE) {
  echo "Usuario admin creadro";
} else {
  echo "Error creating usuario admina : " . $conn->error;
}

$conn->close();
?> 