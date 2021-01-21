<?php
require 'clsConexionDB.php';
class clsHola
{
   public function hola(){

        $saludo= "hello mfckers";

        $row = DB::queryFirstRow("SELECT name, email, edad FROM users WHERE id=%i LIMIT 1", 832);

        $saludo  =  $saludo  . $row['name'] . ' ' . $row['email'];
        return $saludo;

   }
}
