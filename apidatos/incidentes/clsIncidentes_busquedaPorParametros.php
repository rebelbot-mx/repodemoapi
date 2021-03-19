<?php 
require 'traitPermisoParaVerIncidentes.php';

class clsIncidentes_busquedaPorParametros {
    use traitPermisoParaVerIncidentes;


    function busqueda ($datos) {
 

       

        $idusuario = $datos['idusuario'];
        $tipoDePrograma = $datos['tipoDePrograma'];
        $tipoDeEstado = $datos['tipoDeEstado'];
        $tipoDeRespuesta =$datos['tipoDeRespuesta'];

        //Se obtienen los datos del usuario .
        $datosUsuario = DB::queryFirstRow("select * from usuarios where id = %i",$idusuario);
        $programaid =$datosUsuario["programa"];

/*
  VERIFICAR LOS PERMISOS DEL USUARIO , SI PUEDE VER TODOS LOS INCIDENTES
*/

$queIncidentesSePuedenVer =  $this->permisoParaVerLosincidente($idusuario);

//posibles respuestas : todos, programas, propios
/*
//  
     { text: "Programa", value: "programa" },
      { text: "Fecha", value: "fechaAlta" },
      { text: "¿Incidente?", value: "incidenteconfirmado" },
      { text: "Confirmacion", value: "confirmaincidente" },

      { text: "Respuesta", value: "tipoderespuesta" },
      //{ text: "Hechos", value: "data-table-expand" },
      // { text: "Activo", value: "activo" },
      { text: "Estado", value: "estado" },
      { text: "R Inicial", value: "etapauno" },
      { text: "V Integral", value: "etapados" },
      { text: "Seguimiento", value: "etapatres" },
      { text: "Cierre", value: "etapacuatro" },
      //{ text: "Etapas", value: "actions", sortable: false },
    ],

*/

if ($queIncidentesSePuedenVer  == "TODOS"){

    $query = "
    SELECT 
    i.id as 'id',
    i.folio as 'folio',
    i.programa ,
    i.fechaAlta as 'fechaAlta',
    i.incidenteconfirmado as 'incidenteconfirmado',
    v.confirmaincidente as 'confirmaincidente',
    v.tipoderespuesta as 'tipoderespuesta',
    i.estado as 'estado',
    i.etapauno as 'etapauno',
    i.etapados as 'etapados',
    i.etapatres as 'etapatres',
    i.etapacuatro as 'etapacuatro',
    i.coloretapauno as 'coloretapauno',
    i.coloretapados as 'coloretapados',
    i.coloretapatres as 'coloretapatres',
    i.coloretapacuatro as 'coloretapacuatro',
    v.estado as 'estadoseguimiento',
    v.confirmaincidentenumerico as 'confirmaincidentenumerico'
    FROM incidente i join valoracionintegral v on v.incidenteid = i.id ";

    $sqlPrograma ="  ";
    $sqlRespuesta = " ";
    $sqlEstado = " ";
    
    $tipoDeEstado = $datos['tipoDeEstado'];
    $tipoDeRespuesta =$datos['tipoDeRespuesta'];   
    $tipoDePrograma = '';
    
    $nombrePrograma = $datos['tipoDePrograma'];
    if($nombrePrograma == 'TODOS'){

        $tipoDePrograma = "TODOS";
    }else{
         $tipoDePrograma  = DB::queryFirstField("select id from programas where programa = %s",$nombrePrograma);
   
    }
   
    



   $sqlPredicado = "";

    if ($tipoDePrograma == 'TODOS'){
        /*
        
        */
        if ($tipoDeEstado == 'TODOS'){

            /*
             */

            if ($tipoDeRespuesta == 'TODOS'){
             /*
             la query se va sin cambios
             */
            }else {
        
                $sqlRespuesta = " where   v.tipoderespuesta ='".   $tipoDeRespuesta  ."' ";

                $sqlPredicado = $sqlRespuesta;
            }

              




        }else {

            $sqlEstado ="  where i.estado ='".   $tipoDeEstado  ."' ";

            $sqlPredicado = $sqlPredicado .   $sqlEstado;

            if ($tipoDeRespuesta == 'TODOS'){

            }else {
        
                $sqlRespuesta = " and   v.tipoderespuesta ='".   $tipoDeRespuesta  ."' ";
                $sqlPredicado =   $sqlPredicado .  $sqlRespuesta;
            }


        }


    }else {
        /*
         
        */
        $sqlPrograma =" where  i.programa ='".   $tipoDePrograma  ."' ";
        $sqlPredicado =  $sqlPredicado .   $sqlPrograma;
            if ($tipoDeEstado == 'TODOS'){

            }else {
                $sqlEstado ="  and i.estado ='".   $tipoDeEstado  ."' ";
                $sqlPredicado =  $sqlPredicado .  $sqlEstado;

                    if ($tipoDeRespuesta == 'TODOS'){

                    }else {
                
                        $sqlRespuesta = " and   v.tipoderespuesta ='".   $tipoDeRespuesta  ."' ";
                        $sqlPredicado =  $sqlPredicado .    $sqlRespuesta;
                    }

            }       

    }
    
    $query = $query .   $sqlPredicado;

    error_log($query);



    //------------------------------------------------------------
    $results = DB::query($query);

return json_encode($results);


}
/*
if ($queIncidentesSePuedenVer  == "PROGRAMA"){

    $results = DB::query("SELECT 
       i.id as 'id',
       i.folio as 'folio',
       i.programa ,
       i.fechaAlta as 'fechaAlta',
       i.incidenteconfirmado as 'incidenteconfirmado',
       v.confirmaincidente as 'confirmaincidente',
       v.tipoderespuesta as 'tipoderespuesta',
       i.estado as 'estado',
       i.etapauno as 'etapauno',
       i.etapados as 'etapados',
       i.etapatres as 'etapatres',
       i.etapacuatro as 'etapacuatro',
       i.coloretapauno as 'coloretapauno',
       i.coloretapados as 'coloretapados',
       i.coloretapatres as 'coloretapatres',
       i.coloretapacuatro as 'coloretapacuatro',
       v.estado as 'estadoseguimiento',
       v.confirmaincidentenumerico as 'confirmaincidentenumerico'
       FROM incidente i join valoracionintegral v on v.incidenteid = i.id where i.programa = %s",$programaid);

return json_encode($results);

}*/
/*
if ($queIncidentesSePuedenVer  == "PROPIOS"){

    
    $results = DB::query("SELECT 
       i.id as 'id',
       i.folio as 'folio',
       i.programa ,
       i.fechaAlta as 'fechaAlta',
       i.incidenteconfirmado as 'incidenteconfirmado',
       v.confirmaincidente as 'confirmaincidente',
       v.tipoderespuesta as 'tipoderespuesta',
       i.estado as 'estado',
       i.etapauno as 'etapauno',
       i.etapados as 'etapados',
       i.etapatres as 'etapatres',
       i.etapacuatro as 'etapacuatro',
       i.coloretapauno as 'coloretapauno',
       i.coloretapados as 'coloretapados',
       i.coloretapatres as 'coloretapatres',
       i.coloretapacuatro as 'coloretapacuatro',
       v.estado as 'estadoseguimiento',
       v.confirmaincidentenumerico as 'confirmaincidentenumerico'
       FROM incidente i join valoracionintegral v on v.incidenteid = i.id where i.usuariocreador = %i",$idusuario);

return json_encode($results);

}*/
    }// termina
}