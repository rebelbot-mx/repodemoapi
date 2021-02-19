<?php
require 'conexion.php';


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die(" fallo la conexion: " . $conn->connect_error);
}


$sql2=" ALTER TABLE `roles` 
ADD `RECIBECORREOS` VARCHAR(50) NULL AFTER `ACTIVO`;";



/*$sql4="ALTER TABLE `valoracionintegral`
 ADD `estado` VARCHAR(50) NULL
  COMMENT 'Si el todo el registro ha sido completado
   el valor cambiar cerrado.' AFTER `activo`;";
if ($conn->query($sql4) === TRUE) {
  echo "valoracionintegral  successfully";
} else {
  echo "Error investigacion : " . $conn->error;
}*/



if ($conn->query($sql2) === TRUE) {
  echo "Table roles alterada";
} else {
  echo "Error roles : " . $conn->error;
}

$conn->close();
?>