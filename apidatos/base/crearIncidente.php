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
$sql = "CREATE TABLE `incidente` (
    `id` bigint(20) NOT NULL COMMENT 'Identificador unico del registro y llave primaria',
    `folio` varchar(50) NOT NULL COMMENT 'Folio que identifica el incidente durante el proceso',
    `programa` varchar(50) NOT NULL COMMENT 'Programa en donde se genero el incidente',
    `fechaAlta` datetime NOT NULL COMMENT 'fecha de creacion del registro',
    `fechaUpdate` datetime NOT NULL COMMENT 'Fecha de Actualizacion del registro',
    `usuarioCreador` int(11) NOT NULL COMMENT 'usuario que creo el. registro',
    `involucrados` text NOT NULL COMMENT 'Texto en donde se describen los involucrados',
    `elaboro` varchar(50) NOT NULL COMMENT 'Nombre si se conoce del denunciante',
    `cargousuario` varchar(50) NOT NULL COMMENT 'cargo del denunciante',
    `registrohechos` text NOT NULL COMMENT 'Texto en donde se registran los hechos',
    `prefildelagresor` varchar(50) NOT NULL COMMENT 'Perfil del Agresor : Adulto a niña/niño o Entre pares',
    `paadultocolaborador` varchar(50) DEFAULT NULL COMMENT 'Opciones: Colaborador SOS, Familiar o Adulto Externo',
    `paadultocolaboradortipo` varchar(50) DEFAULT NULL COMMENT 'Opciones a escoger de COlaborador SOS u Opciones de Famila',
    `pafamilia` varchar(50) DEFAULT NULL COMMENT 'obsoleto',
    `pafamiliatipo` varchar(50) DEFAULT NULL COMMENT 'obsoleto',
    `adultoexterno` varchar(50) DEFAULT NULL COMMENT 'obsoleto',
    `perfilvictima` varchar(50) NOT NULL COMMENT 'Niña o niño',
    `recibeayuda` varchar(50) NOT NULL COMMENT 'Es apoyado o no por SOS',
    `medidasproinmediatas` text NOT NULL COMMENT 'Texto para describir las medidas integrales que se han tomado en primer instancia',
    `incidenteconfirmado` varchar(50) NOT NULL COMMENT 'Primera evaluación del incidente',
    `testigos` text COMMENT 'Texto para la descripcion de los testigos involucrados en el incidente',
    `nnj` varchar(50) NOT NULL COMMENT 'obsoleto',
    `etapa` int(11) NOT NULL COMMENT 'etapa actual en la que se encuentra el incidente-uso grafico',
    `activo` int(11) NOT NULL COMMENT 'Estado del status',
    `etapauno` varchar(50) DEFAULT NULL COMMENT 'Para uso grafico  , muestr u oculta el boton de valoracion inicial',
    `etapados` varchar(50) DEFAULT NULL COMMENT ' 	Para uso grafico , muestr u oculta el boton de valoracion Integral',
    `etapatres` varchar(50) DEFAULT NULL COMMENT ' 	Para uso grafico , muestr u oculta el boton de seguimiento',
    `etapacuatro` varchar(50) DEFAULT NULL COMMENT ' 	Para uso grafico , muestr u oculta el boton de cierre',
    `coloretapauno` varchar(50) DEFAULT NULL COMMENT 'Para manejo del color actual del boton de valoracion inicial',
    `coloretapados` varchar(50) DEFAULT NULL COMMENT 'Para manejo del color actual del boton de valoracion Integral',
    `coloretapatres` varchar(50) DEFAULT NULL COMMENT 'Para manejo del color actual del boton de seguimiento',
    `coloretapacuatro` varchar(50) DEFAULT NULL COMMENT 'Para manejo del color actual del boton de cierre',
    `textocierre` text COMMENT 'Texto del dictamen del cierre del incidente',
    `estado` varchar(50) DEFAULT NULL COMMENT 'Estado de este incidente, puede ser abierto , cerrado o cerrado por no ser incidente'
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

$sql2="ALTER TABLE `incidente`
  ADD PRIMARY KEY (`id`);";

$sql3="ALTER TABLE `incidente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";


if ($conn->query($sql) === TRUE) {
  echo "Table incidente created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

if ($conn->query($sql2) === TRUE) {
  echo "Table incidente llave primaria";
} else {
  echo "Error creating llave primaria: " . $conn->error;
}

if ($conn->query($sql3) === TRUE) {
  echo "incremental llave incidente created successfully";
} else {
  echo "Error creating incremento: " . $conn->error;
}
$conn->close();
?> 