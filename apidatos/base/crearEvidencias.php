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

// sql to create table
$sql = "CREATE TABLE `evidencias` (
    `id` int(11) NOT NULL,
    `nombre` text NOT NULL,
    `descripcion` text NOT NULL,
    `ubicacion` text NOT NULL,
    `tipo` varchar(50) NOT NULL,
    `investigacionid` int(11) NOT NULL,
    `activo` bit(1) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

$sql2="ALTER TABLE `evidencias`
  ADD PRIMARY KEY (`id`);";

$sql3="ALTER TABLE `evidencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";


if ($conn->query($sql) === TRUE) {
  echo "Table evidencias created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

if ($conn->query($sql2) === TRUE) {
  echo "Table evidencias llave primaria";
} else {
  echo "Error creating llave primaria: " . $conn->error;
}

if ($conn->query($sql3) === TRUE) {
  echo "incremental llave evidencias created successfully";
} else {
  echo "Error creating incremento: " . $conn->error;
}
$conn->close();
?> 