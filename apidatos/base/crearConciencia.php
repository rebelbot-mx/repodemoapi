<?php
/*
$servername = "localhost";
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

// sql to create table
$sql = "CREATE TABLE `conciencia` (
    `id` int(11) NOT NULL,
    `estatus` text NOT NULL,
    `clasificacion` varchar(50) NOT NULL,
    `docto` VARCHAR(50) NULL,
    `activo` varchar(50) NOT NULL,
    `tipo` VARCHAR(50) NOT NULL ,
    `estatusplan` VARCHAR(50) NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

$sql2="ALTER TABLE `conciencia`
  ADD PRIMARY KEY (`id`);";

$sql3="ALTER TABLE `conciencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";


if ($conn->query($sql) === TRUE) {
  echo "Table conciencia created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

if ($conn->query($sql2) === TRUE) {
  echo "Table conciencia llave primaria";
} else {
  echo "Error creating llave primaria: " . $conn->error;
}

if ($conn->query($sql3) === TRUE) {
  echo "incremental llave conciencia created successfully";
} else {
  echo "Error creating incremento: " . $conn->error;
}
$conn->close();
?> 