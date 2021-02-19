<?php

require 'conexion.php';


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die(" fallo la conexion: " . $conn->connect_error);
}


$sql2=" create database apialdeasbdd;";

if ($conn->query($sql2) === TRUE) {
  echo "Base de datos creada";
} else {
  echo "Error al crear la base de datos : " . $conn->error;
}
 /////////////////////////////////////////////////////////////

 $sql3=" create user 'phpappusersos' identified by 'mysqlazure2021';";

if ($conn->query($sql3) === TRUE) {
  echo "Usuario creado";
} else {
  echo "Error al crear usuario : " . $conn->error;
}
/////////////////////////////////////////////////////////////

$sql4=" grant all privileges on apialdeasbdd.* to  'phpappusersos';";

if ($conn->query($sql4) === TRUE) {
  echo "Usuario creado";
} else {
  echo "Error al crear usuario : " . $conn->error;
}

$conn->close();
?>