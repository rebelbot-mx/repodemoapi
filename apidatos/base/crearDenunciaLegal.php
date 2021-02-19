<?php
require 'conexion.php';
/*$servername = "localhost";
$username = "mcabrera2";
$password = "2478*";
$dbname = "apialdeas";

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
$sql = "CREATE TABLE `denuncialegal` (
    `id` int(11) NOT NULL,
    `incidenteid` int(11) DEFAULT NULL COMMENT 'Llave secundaria, es el identificador del incidente',
    `foliodenuncia` varchar(50) DEFAULT NULL COMMENT 'Folio de la denuncia',
    `programa` varchar(50) DEFAULT NULL,
    `consenso` varchar(50) NOT NULL COMMENT 'Texto para redactar conclusiones del consenso',
    `consensodocto` varchar(50) NOT NULL COMMENT 'Identificador del documento , es el id del registro en la tabla doctos del consenso ',
    `soportecontacto` varchar(50) NOT NULL COMMENT 'Contacto al soporte legal',
    `soporteantes` varchar(50) NOT NULL COMMENT 'acompañamiento del soporte antes',
    `soportedurante` varchar(50) NOT NULL COMMENT 'acompañamiento del soporte legal durante',
    `soporteemocionalcontacto` varchar(50) NOT NULL COMMENT 'contacto con el soporte emocional',
    `soporteemocionalantes` varchar(50) NOT NULL COMMENT 'soporte emocional antes ',
    `soporteemocionaldurante` varchar(50) NOT NULL COMMENT 'soporte emocional durante',
    `medidasd` varchar(50) NOT NULL COMMENT 'Se han tomado medidas : SI,NO,POR CONFIRMAR',
    `medidasd_docto` varchar(50) NOT NULL COMMENT 'Identificador del documento , es el id del registro en la tabla doctos de las medidas tomadas',
    `medidastexto` text NOT NULL COMMENT 'Texto acerca de las medidas tomadas',
    `fechaCreacion` date NOT NULL COMMENT 'fecha de creacion',
    `fechaUpdate` date NOT NULL COMMENT 'fecha de actualizacion',
    `estado` varchar(50) NOT NULL COMMENT 'Estado de la denuncia ABIERTO O CERRADO'
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

$sql2="ALTER TABLE `denuncialegal`
  ADD PRIMARY KEY (`id`);";

$sql3="ALTER TABLE `denuncialegal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";


if ($conn->query($sql) === TRUE) {
  echo "Table denuncialegal created successfully  \n";
} else {
  echo "Error creating table: " . $conn->error;
}

if ($conn->query($sql2) === TRUE) {
  echo "Table denuncialegal llave primaria";
} else {
  echo "Error creating llave primaria: " . $conn->error;
}

if ($conn->query($sql3) === TRUE) {
  echo "incremental llave denuncialegal created successfully";
} else {
  echo "Error creating incremento: " . $conn->error;
}
$conn->close();
?> 