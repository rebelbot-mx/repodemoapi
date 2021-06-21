<?php
require ('trait_totalIncidentes_Abiertos_Cerrados.php');
require ('trait_incidentes_x_programa.php');
require ('trait_variableGrafica3.php');
require ('trait_totales_topologia.php');
require ('trait_totales_niveles.php');
require ('trait_totales_por_tipodecaso.php');
require ('trait_total_por_respuesta.php');
  


class clsGenerarEstadisticas {
use trait_totalIncidentes_Abiertos_Cerrados,
    trait_incidentes_x_programa,
    trait_variableGrafica3,
    trait_totales_niveles,
    trait_totales_topologia,
    trait_totales_por_tipodecaso,
    trait_total_por_respuesta;

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



        ///////////////////////
        // GRAFICA 3
        //////////////////////
    
        ///////////////////////////////////////////////
        // generamos una lista con los nombred e los programas
        ////////////////////////////////////////////////////




        $listaProgamas_verificada = DB::query("select abreviatura from programas");
        
        $listp = array();

        error_log(" valores obtenidos al iterar en los programas ");

        foreach ($listaProgamas_verificada as  $value) {
            # code...
            array_push($listp,$value["abreviatura"]);
       }
        $grafica_tres['programas']=  $listp;




        $lp = [ 'ABUSO FISICO','ABUSO SEXUAL','ABUSO EMOCIONAL','NEGLIGENCIA Y/O TRATO NEGLIGENTE','VIOLACION DE LA PRIVACIDAD DE LOS NIÑOS Y NIÑAS'];

        $colores =[ "rgb(255, 99, 132)",
                    "rgb(255, 159, 64)",
                    "rgb(255, 205, 86)",
                    "rgb(75, 192, 192)",
                    "rgb(54, 162, 235)",
                    "rgb(153, 102, 255)",
                    "rgb(201, 203, 207)",
                    "rgb(195, 103, 207)",
                    "rgb(103, 162, 155)",
                ];
         
         $i = 0;

         $datos_para_la_grafica =array();

         foreach ($lp as $key => $value) {
             # code...

             $nombre = $value;

             $listaProgamas_x_id = DB::query("select id from programas");

             //$SQL_CONSULTA = "SELECT count(*) FROM `valoracionintegral` WHERE tipodecaSo like '".  $nombre ."' ";

            // 

             $data_estadistica = array();
              foreach ($listaProgamas_x_id as  $value) {
                  # code...

                $id_a_abuscar = $value["id"];

                $SQL_CONT = "  select count(*) from incidente i join valoracionintegral vi on vi.incidenteid = i.id where i.programa =  ". $id_a_abuscar . " and vi.tipodecaso like '".  $nombre  ."' ";

                $cuantos = DB::queryFirstField($SQL_CONT);
     
                array_push($data_estadistica,$cuantos);
 
              };          
            
            

            $array_temp = [ "label" => $nombre,
                            "backgroundColor" => $colores[$i],
                            "stack" => "Stack " . $i,
                            "data"  => $data_estadistica];

            array_push( $datos_para_la_grafica ,$array_temp);

            $i= $i + 1;
         }
       
         $grafica_tres['dataset']= $datos_para_la_grafica;

         /////////////////////////////////////////////////////////////
         // ¿ cuantos incidentes internos y cuantos externos        //
         /////////////////////////////////////////////////////////////
         error_log("grafica_topologia --- ");
         $grafica_topologia = $this->buscarTotales_topologia( $fi , $ff , $tipo );

      
         /////////////////////////////////////////////////////////////
         // ¿ cuantos incidentes por nivel del incidente            //
         /////////////////////////////////////////////////////////////
         error_log("grafica_tipo de nivel --- ");
         $grafica_tiponivel = $this->buscarTotales_niveles( $fi , $ff , $tipo );

         /////////////////////////////////////////////////////////////
         // ¿ cuantos incidentes por tipo de caso ?           //
         /////////////////////////////////////////////////////////////
         error_log("grafica_tipo de casos --- ");
         $grafica_tipodecasos = $this->buscarTotales_tipodecaso( $fi , $ff , $tipo );

         /////////////////////////////////////////////////////////////
         // ¿ cuantos incidentes por tipo de respuesta ?           //
         /////////////////////////////////////////////////////////////
         error_log("grafica_tipo de respuesta --- ");
         $grafica_tipoderespuesta = $this->buscarTotales_respuesta( $fi , $ff , $tipo );
   
       /////////////////////////////////////////////////////////////
       // Respuesta JSON
       ///////////////////////////////////////////////////////////////
  
        $respuesta['grafica1']= $res;
        $respuesta['grafica2']= $res2;
        $respuesta['grafica3']= $grafica_tres;
        $respuesta['grafica_topologia']=  $grafica_topologia;
        $respuesta['grafica_tiponivel']=  $grafica_tiponivel;
        $respuesta['grafica_tipodecasos']=  $grafica_tipodecasos;
        $respuesta['grafica_tipoderespuesta']=  $grafica_tipoderespuesta;

        return json_encode( $respuesta );

    }



}