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
$sql = "CREATE TABLE `seguimiento` (
    `id` int(11) NOT NULL COMMENT 'Identificador unico del registro y llave primaria',
    `incidenteid` int(11) DEFAULT NULL COMMENT 'Llave secundaria, es el identificador del incidente',
    `status` text COMMENT 'Texto para inidicar el Estatus de esta parte del proceso',
    `plan` varchar(50) DEFAULT NULL COMMENT 'Estatus del Plan : Si,NO,POR CONFIRMAR',
    `documentos` varchar(50) NOT NULL,
    `notificaciondif` text NOT NULL COMMENT 'Estatus de la notificacion al DIF si es que aplica : Si,NO,POR CONFIRMAR',
    `notificacionautoridad` text NOT NULL COMMENT 'Estatus de la notificacion al Autoridad si es que aplica : Si,NO,POR CONFIRMAR',
    `notificacionpfn` text NOT NULL COMMENT 'Estatus de la Notificaion al PFN : Si,NO,POR CONFIRMAR',
    `notificaciodenunciante` text NOT NULL COMMENT 'Estatus de la notificaion  a la persona que hizo la denuncia : Si,NO,POR CONFIRMAR',
    `actavaloracion` text NOT NULL COMMENT 'Estatus del Acta de Valoracion: Si,NO,POR CONFIRMAR',
    `planrecuperacion` text NOT NULL COMMENT 'Estatus del Plan de recuperacion : Si,NO,POR CONFIRMAR',
    `actavaloracion_docto` varchar(50) NOT NULL COMMENT 'Identificador del documento , es el id del registro en la tabla doctos de acta de valoracion',
    `documentos_docto` varchar(50) NOT NULL COMMENT 'Identificador del documento , es el id del registro en la tabla doctos de los documentos oficiales ',
    `notificaciondenunciante_docto` varchar(50) NOT NULL COMMENT 'Identificador del documento , es el id del registro en la tabla doctos de la notificacion al denunciante',
    `notificacionautoridad_docto` varchar(50) NOT NULL COMMENT 'Identificador del documento , es el id del registro en la tabla doctos de la notificacion a la autoridad',
    `notificaciondif_docto` varchar(50) NOT NULL COMMENT 'Identificador del documento , es el id del registro en la tabla doctos de la notificacion al DIF',
    `notificacionpfn_docto` varchar(50) NOT NULL COMMENT 'Identificador del documento , es el id del registro en la tabla doctos de la notificacion al PFN',
    `plan_docto` varchar(50) NOT NULL COMMENT 'Identificador del documento , es el id del registro en la tabla doctos del Plan y cronograma',
    `planrecuperacion_docto` varchar(50) NOT NULL COMMENT 'Identificador del documento , es el id del registro en la tabla doctos del Plan de recuperacion',
    `protocolosos` varchar(50) DEFAULT NULL COMMENT 'Estatus de la respuesta (Denuncia o investigacion) SI, NO, PENDIENTE'
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

$sql2="ALTER TABLE `seguimiento`
  ADD PRIMARY KEY (`id`);";

$sql3="ALTER TABLE `seguimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";


if ($conn->query($sql) === TRUE) {
  echo "Table seguimiento created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

if ($conn->query($sql2) === TRUE) {
  echo "Table seguimiento llave primaria";
} else {
  echo "Error creating llave primaria: " . $conn->error;
}

if ($conn->query($sql3) === TRUE) {
  echo "incremental llave seguimiento created successfully";
} else {
  echo "Error creating incremento: " . $conn->error;
}
$conn->close();
?> 