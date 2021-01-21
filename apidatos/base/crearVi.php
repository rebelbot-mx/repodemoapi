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
$sql = "CREATE TABLE `valoracionintegral` (
    `id` int(11) NOT NULL COMMENT 'Identificadro unico del registro',
    `incidenteid` int(11) NOT NULL COMMENT 'Llave secundaria, es el identificador del incidente',
    `fechacreacion` date NOT NULL COMMENT 'fecha en la que se creo el registro',
    `fechaupdate` date NOT NULL COMMENT 'fecha en la que se actualizo el registro',
    `textovi` text NOT NULL COMMENT 'Testo en donde se describe la valoracion acerca de este incidente',
    `tipologiadelincidente` varchar(50) NOT NULL COMMENT 'si es de caracter interno o externo',
    `niveldelincidente` varchar(50) NOT NULL COMMENT 'Bajo nivel , Alto Nivel o Critico',
    `tipodecaso` varchar(50) NOT NULL COMMENT 'Seleccion entre Abusos ,Negligencia o Violaacion',
    `confirmaincidente` varchar(50) NOT NULL COMMENT 'Se confirma a traves de la valoracion si es un incidente o no.',
    `confirmaincidentenumerico` decimal(10,0) DEFAULT NULL COMMENT 'Uso Grafico, determina un comportamiento en la pantalla. su valor es 1 y 2',
    `tipoderespuesta` varchar(50) NOT NULL COMMENT 'Denuncia Penal, Investigacion Interna, Abordaje interno y cuando el regstro se crea por primera vez tiene su valor es En proceso de Valoracion',
    `medidasintegrales` text NOT NULL COMMENT 'Identificador del documento , es el id del registro en la tabla doctos',
    `activo` bit(1) NOT NULL COMMENT 'Estado del registro'
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

$sql2="ALTER TABLE `valoracionintegral`
  ADD PRIMARY KEY (`id`);";

$sql3="ALTER TABLE `valoracionintegral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";


if ($conn->query($sql) === TRUE) {
  echo "Table valoracionintegral created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

if ($conn->query($sql2) === TRUE) {
  echo "Table valoracionintegral llave primaria";
} else {
  echo "Error creating llave primaria: " . $conn->error;
}

if ($conn->query($sql3) === TRUE) {
  echo "incremental llave valoracionintegral created successfully";
} else {
  echo "Error creating incremento: " . $conn->error;
}
$conn->close();
?> 