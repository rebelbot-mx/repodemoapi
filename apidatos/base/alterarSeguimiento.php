<?php
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


$sql2="ALTER TABLE `seguimiento` 
ADD `estado` VARCHAR(50) NULL COMMENT 'En este camo se almacen el estado del seguimiento, si ya todos las condiciones se cumplen para cerrar el seguimiento valores: abierto y/o cierre' AFTER `protocolosos`;
";



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

$conn->close();
?> 