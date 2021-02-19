<?php
/*$servername = "localhost";
$username = "mcabrera2";
$password = "2478*";
$dbname = "apialdeas";

$servername = "localhost";
$username = "aisosmx_rebelbot";
$password = "Rebelware10*";
$dbname = "aisosmx_apialdeas";*/
require 'conexion.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die(" fallo la conexion: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE `doctos` (
    `id` int(11) NOT NULL COMMENT 'Identificador unico del registro y llave primaria',
    `incidenteId` int(11) NOT NULL COMMENT 'Llave secundaria, es el identificador del incidente',
    `nombreOriginal` text NOT NULL COMMENT 'Nombre del documento',
    `ext` varchar(50) NOT NULL COMMENT 'tipo de extesion del documento',
    `fechaCreacion` date NOT NULL COMMENT 'Fecha en la que se creo el documento',
    `fechaUpdate` date NOT NULL COMMENT 'Fecha en la que se actualizo el documento',
    `nombreinterno` text NOT NULL COMMENT 'Nombre que se le asigna en servidor',
    `directorio` text NOT NULL COMMENT 'carpeta en la que se aloja dentro del servidor'
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

$sql2="ALTER TABLE `doctos`
  ADD PRIMARY KEY (`id`);";

$sql3="ALTER TABLE `doctos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";


if ($conn->query($sql) === TRUE) {
  echo "Table doctos created successfully  \n";
} else {
  echo "Error creating table: " . $conn->error;
}

if ($conn->query($sql2) === TRUE) {
  echo "Table doctos llave primaria";
} else {
  echo "Error creating llave primaria: " . $conn->error;
}

if ($conn->query($sql3) === TRUE) {
  echo "incremental llave doctos created successfully";
} else {
  echo "Error creating incremento: " . $conn->error;
}
$conn->close();
?> 