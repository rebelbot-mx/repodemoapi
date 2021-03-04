<?php
trait traiBuscarId_por_Programa{

function buscarIdDelPrograma($nombrePrograma){

    $sql= "select id from programas where abreviatura  = '$nombrePrograma'";

    $resultado = DB::queryFirstField($sql);

    error_log("valor del id del programa recuperado desde el trait: " . $resultado);

    return $resultado;


}

}