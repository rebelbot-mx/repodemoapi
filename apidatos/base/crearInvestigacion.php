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
$sql = "CREATE TABLE `investigacion` (
    `id` int(11) NOT NULL COMMENT ' 	Identificador unico del registro y llave primaria',
    `incidenteid` int(11) NOT NULL COMMENT 'Llave secundaria, es el identificador del incidente ',
    `folioinvestigacion` varchar(50) NOT NULL COMMENT 'Folio de la Investigacion',
    `programa` varchar(50) DEFAULT NULL,
    `registroincidentes_docto` text NOT NULL COMMENT 'Id del docuemento en la tabla Doctos',
    `cartautorizacion_docto` varchar(50) NOT NULL COMMENT 'Id del docuemento en la tabla Doctos',
    `terminosreferencia_doctp` varchar(50) NOT NULL COMMENT 'Id del docuemento en la tabla Doctos',
    `plan_docto` varchar(50) NOT NULL COMMENT 'Id del docuemento en la tabla Doctos',
    `informe_docto` varchar(50) NOT NULL COMMENT 'Id del docuemento en la tabla Doctos',
    `fechaCreacion` date NOT NULL COMMENT 'Fe cha de la creacion del Registro',
    `fechaUpdate` date NOT NULL COMMENT 'Fecha de actualizacion del registro'
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

$sql2="ALTER TABLE `investigacion`
  ADD PRIMARY KEY (`id`);";

$sql3="ALTER TABLE `investigacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";


if ($conn->query($sql) === TRUE) {
  echo "Table investigacion created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

if ($conn->query($sql2) === TRUE) {
  echo "Table investigacion llave primaria";
} else {
  echo "Error creating llave primaria: " . $conn->error;
}

if ($conn->query($sql3) === TRUE) {
  echo "incremental llave investigacion created successfully";
} else {
  echo "Error creating incremento: " . $conn->error;
}
$conn->close();
?> 