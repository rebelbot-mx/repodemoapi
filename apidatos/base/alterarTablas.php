<?php
require 'conexion.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die(" fallo la conexion: " . $conn->connect_error);
}


$sql2="ALTER TABLE `denuncialegal` 
ADD `programa` VARCHAR(50) NULL AFTER `foliodenuncia`;";

$sql3="ALTER TABLE `investigacion` 
ADD `programa` VARCHAR(50) NULL AFTER `folioinvestigacion`;
";


$sql4 = "ALTER TABLE `incidente` ADD `fechaCierre` DATE NULL AFTER `estado`;";

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
  echo "Table denuncialegal alterada";
} else {
  echo "Error denuncialegal : " . $conn->error;
}

if ($conn->query($sql3) === TRUE) {
  echo "investigacion  successfully";
} else {
  echo "Error investigacion : " . $conn->error;
}
if ($conn->query($sql4) === TRUE) {
  echo "se agrego el campo de fecha de cierre a la tabla incidentes  successfully";
} else {
  echo "Error incidentes : " . $conn->error;
}
$conn->close();
?> 