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


$sql2="ALTER TABLE `denuncialegal` 
ADD `programa` VARCHAR(50) NULL AFTER `foliodenuncia`;";

$sql3="ALTER TABLE `investigacion` 
ADD `programa` VARCHAR(50) NULL AFTER `folioinvestigacion`;
";




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
$conn->close();
?> 