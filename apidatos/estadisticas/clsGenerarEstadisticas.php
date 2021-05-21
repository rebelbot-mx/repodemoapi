<?php
require ('trait_totalIncidentes_Abiertos_Cerrados.php');
require ('trait_incidentes_x_programa.php');
require ('trait_variableGrafica3.php');

class clsGenerarEstadisticas {
use trait_totalIncidentes_Abiertos_Cerrados,
    trait_incidentes_x_programa,
    trait_variableGrafica3;

    public function generarReporte($datos){



        $fi = $datos["fi"];
        $ff = $datos["ff"];
        $tipo = $datos["tipo"];

        $res = $this->generar( $fi , $ff , $tipo);

        $res2 = $this->generar_incidentes_x_programa(  $fi , $ff , $tipo );

        $cuantos_items_en_res2 =count($res2);

        error_log("cuantos_items_en_res2 " .  $cuantos_items_en_res2);
        

        $lista_de_programas="";
        $data_ia="";
        $data_ic= "";
        $data_ip="";

        for ($i=0; $i < count($res2); $i++) { 
            # code...
             $temp_programa_nombre = $res2[$i]["programa"];
             $temp_ia              = $res2[$i]["TotalIncidenteAbiertos"];
             $temp_ic              = $res2[$i]["TotalIncidenteCerrados"];
             $temp_ip              = $res2[$i]["TotalIncidentePendientes"];
             
             $coma =",";
             if($i == 0 ){
             $coma = " ";
             }

             $lista_de_programas =  $lista_de_programas .   $coma . "'". $temp_programa_nombre."'";
             $data_ia            =   $data_ia . $coma .  $temp_ia;
             $data_ic            =   $data_ic . $coma .  $temp_ic;
             $data_ip            =   $data_ip . $coma .  $temp_ip;
        }

        error_log(  $lista_de_programas );
        error_log(  $data_ia   );
        error_log(  $data_ic   );
        error_log(  $data_ip   );

        $res3_temp = $this->generarVariable($lista_de_programas, $data_ia , $data_ic  , $data_ip  );
        
        $res3 = str_replace("\\r\\n","", $res3_temp);

        $respuesta['grafica1']= $res;
        $respuesta['grafica2']= $res2;
        $respuesta['grafica3']= $res3;
         


        return json_encode( $respuesta );

    }



}