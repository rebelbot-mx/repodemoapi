<?php
trait traiBuscarId_por_Programa{

function buscarIdDelPrograma($nombrePrograma){

    $sql= "select id from programas where abreviatura  = '.$nombrePrograma .'";

    $resultado = DB::queryFirstField($sql);

    return $resultado;


}

}