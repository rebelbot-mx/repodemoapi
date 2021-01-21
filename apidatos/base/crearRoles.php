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
$sql = "CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `NOMBREDELROL` varchar(50) NOT NULL,
  `ALTADECATALOGOS` varchar(50) NOT NULL,
`BAJADECATALOGOS` varchar(50) NOT NULL,
`MODIFICACIOnDECATALOGOS` varchar(50) NOT NULL,
`ALTADEUSUARIOS` varchar(50) NOT NULL,
`BAJADEUSUARIOS` varchar(50) NOT NULL,
`MODIFICACIONDEUSUARIOS` varchar(50) NOT NULL,
`ALTADEROL` varchar(50) NOT NULL,
`BAJADEROL` varchar(50) NOT NULL,
`MODIFICACIONDEROL` varchar(50) NOT NULL,
`ALTADEVALORACIONINICIAL` varchar(50) NOT NULL,
`MODIFICACIONREAPERTURAVALORACIONINICIAL` varchar(50) NOT NULL,
`EDITARANTESDECIERREDELAVALORACIONINICIAL` varchar(50) NOT NULL,
`BAJAVALORACIONINICIAL` varchar(50) NOT NULL,
`IMPRESIONVALORACIONINICIAL` varchar(50) NOT NULL,
`VISUALIZACIONVALORACIONINICIAL` varchar(50) NOT NULL,
`ALTADEVALORACIONINTEGRAL` varchar(50) NOT NULL,
`MODIFICACIONREAPERTURAVALORACIONINTEGRAL` varchar(50) NOT NULL,
`EDITARANTESDECIERREDELAVALORACIONINTEGRAL` varchar(50) NOT NULL,
`BAJAVALORACIONINTEGRAL` varchar(50) NOT NULL,
`IMPRESIONVALORACIONINTEGRAL` varchar(50) NOT NULL,
`VISUALIZACIONVALORACIONINTEGRAL` varchar(50) NOT NULL,
`ALTADESEGUIMIENTO` varchar(50) NOT NULL,
`MODIFICACIONDESEGUIMIENTO` varchar(50) NOT NULL,
`EDITARDESEGUIMIENTO` varchar(50) NOT NULL,
`BAJADESEGUIMIENTO` varchar(50) NOT NULL,
`IMPRESIONDESEGUIMIENTO` varchar(50) NOT NULL,
`VISUALIZACIONDESEGUIMIENTO` varchar(50) NOT NULL,
`ALTADECIERRE` varchar(50) NOT NULL,
`MODIFICACIONDECIERRE` varchar(50) NOT NULL,
`EDICIONDECIERRE` varchar(50) NOT NULL,
`BAJADECIERRE` varchar(50) NOT NULL,
`IMPRESIONDECIERRE` varchar(50) NOT NULL,
`VISUALIZACIONDECIERRE` varchar(50) NOT NULL,
`ALTADENUNCIA` varchar(50) NOT NULL,
`MODIFCACIONDENUNCIA` varchar(50) NOT NULL,
`EDICIONDENUNCIA` varchar(50) NOT NULL,
`BAJADENUNCIA` varchar(50) NOT NULL,
`IMPRESIONDENUNCIA` varchar(50) NOT NULL,
`VISUALIZACIONDENUNCIA` varchar(50) NOT NULL,
`ALTAINVESTIGACION` varchar(50) NOT NULL,
`MODIFICACIONINVESTIGACION` varchar(50) NOT NULL,
`EDICIONINVESTIGACION` varchar(50) NOT NULL,
`BAJAINVESTIGACION` varchar(50) NOT NULL,
`IMPRESIONINVESTIGACION` varchar(50) NOT NULL,
`VISUALIZACIONINVESTIGACION` varchar(50) NOT NULL,
`ALTAEVIDENCIA` varchar(50) NOT NULL,
`MODIFCACIONEVIDENCIA` varchar(50) NOT NULL,
`EDICIONEVIDENCIA` varchar(50) NOT NULL,
`BAJAEVIDENCIA` varchar(50) NOT NULL,
`IMPRESIONEVIDENCIA` varchar(50) NOT NULL,
`VISUALIZACIONEVIDENCIA` varchar(50) NOT NULL,
`ALTADEARCHIVOS` varchar(50) NOT NULL,
`MODIFICACIONARCHIVOS` varchar(50) NOT NULL,
`IMPRESIONARCHIVOS` varchar(50) NOT NULL,
`VISUALIZACIONARCHIVOS` varchar(50) NOT NULL,
`ACTIVO` BIT(1) NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

$sql2="ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);";

$sql3="ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";


if ($conn->query($sql) === TRUE) {
  echo "Table roles created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

if ($conn->query($sql2) === TRUE) {
  echo "Table roles llave primaria";
} else {
  echo "Error creating llave primaria: " . $conn->error;
}

if ($conn->query($sql3) === TRUE) {
  echo "incremental llave roles created successfully";
} else {
  echo "Error creating incremento: " . $conn->error;
}
$conn->close();
?> 
