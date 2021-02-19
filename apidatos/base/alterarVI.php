<?php
require 'conexion.php';


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die(" fallo la conexion: " . $conn->connect_error);
}



$sql4="ALTER TABLE `valoracionintegral`
 ADD `estado` VARCHAR(50) NULL
  COMMENT 'Si el todo el registro ha sido completado
   el valor cambiar cerrado.' AFTER `activo`;";


if ($conn->query($sql4) === TRUE) {
  echo "valoracionintegral  successfully";
} else {
  echo "Error investigacion : " . $conn->error;
}


$conn->close();
?> 