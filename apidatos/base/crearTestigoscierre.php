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
$sql = "CREATE TABLE `testigoscierre` (
    `id` int(11) NOT NULL COMMENT 'Identificador unico del registro y llave primaria',
    `incidenteid` int(11) DEFAULT NULL COMMENT 'Llave secundaria, es el identificador del incidente',
    `nombre` text COMMENT 'Nombre del testigo que participa en el cierre del incidente',
    `cargo` varchar(50) DEFAULT NULL COMMENT 'Cargo  que ostenta el testigo '
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
  
";

$sql2="ALTER TABLE `testigoscierre`
  ADD PRIMARY KEY (`id`);";

$sql3="ALTER TABLE `testigoscierre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";


if ($conn->query($sql) === TRUE) {
  echo "Table testigoscierre created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

if ($conn->query($sql2) === TRUE) {
  echo "Table testigoscierre llave primaria";
} else {
  echo "Error creating llave primaria: " . $conn->error;
}

if ($conn->query($sql3) === TRUE) {
  echo "incremental llave testigoscierre created successfully";
} else {
  echo "Error creating incremento: " . $conn->error;
}
$conn->close();
?> 