<?php
require ('trait_totalIncidentes_Abiertos_Cerrados.php');
require ('trait_incidentes_x_programa.php');

class clsGenerarEstadisticas {
use trait_totalIncidentes_Abiertos_Cerrados,
    trait_incidentes_x_programa;

    public function generarReporte($datos){



        $fi = $datos["fi"];
        $ff = $datos["ff"];
        $tipo = $datos["tipo"];

        $res = $this->generar( $fi , $ff , $tipo);

        $res2 = $this->generar_incidentes_x_programa(  $fi , $ff , $tipo );

        $respuesta = ['grafica1'=>$res, 'grafica2'=>$res2];


        return json_encode( $respuesta );

    }



}