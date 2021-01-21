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
$sql = "CREATE TABLE `programas` (
  `id` int(11) NOT NULL,
  `programa` varchar(50) NOT NULL,
  `abreviatura` varchar(50) NOT NULL,
  `prefijofolio` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
";

$sql2="ALTER TABLE `programas`
  ADD PRIMARY KEY (`id`);";

$sql3="ALTER TABLE `programas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
";


if ($conn->query($sql) === TRUE) {
  echo "Table programas created successfully";
} else {
  echo "Error creating table: " . $conn->error;
}

if ($conn->query($sql2) === TRUE) {
  echo "Table programas llave primaria";
} else {
  echo "Error creating llave primaria: " . $conn->error;
}

if ($conn->query($sql3) === TRUE) {
  echo "incremental llave programas created successfully";
} else {
  echo "Error creating incremento: " . $conn->error;
}
$conn->close();
?> 