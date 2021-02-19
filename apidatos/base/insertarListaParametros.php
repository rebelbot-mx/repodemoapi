<?php
/*$servername = "localhost";
$username = "aisosmx_rebelbot";
$password = "Rebelware10*";
$dbname = "aisosmx_apialdeas";


$servername = "localhost";
$username = "mcabrera";
$password = "2478";
$dbname = "apialdeas";
*/
require 'conexion.php';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die(" fallo la conexion: " . $conn->connect_error);
}


$sql2="INSERT INTO `parametros` ( `nombreParametro`, `descripcion`, `valor`) VALUES
( 'numerow', 'numero de whatsapp para soporte de la app', '921308299700000'),
( 'correosoporte', 'correo para el soporte ', 'gabrielmoralestaylor@gmail.com, mcabrera@rebelbot.mx'),
( 'versionapp', 'nunmero de version de la app', '0.1.0'),
( 'messenger', 'cuenta de faceboook messenger', 'Pasteleriachocolatecoatza'),
 (  'imagenEnLogin','imagen para desplegar en login', 'https://www.aldeasinfantiles.org.mx/getmedia/74fbaa0b-d357-480f-988c-adc2cba98bbf/conocenos.jpg?width=1366');
";




if ($conn->query($sql2) === TRUE) {
  echo "Lista de parametros actualizada";
} else {
  echo "Error denuncialegal : " . $conn->error;
}


$conn->close();
?> 