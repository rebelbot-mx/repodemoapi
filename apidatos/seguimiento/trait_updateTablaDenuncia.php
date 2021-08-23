<?php 



trait trait_updateTablaDenuncia {

    /*
     - se actualizan campos consenso y consensodocto
     - se actualizan campos denunciapresentada y docto_denunciapresentada
     - se actualizan campos medidasd y medidas_docto
    */
    function actualizarTablaDenuncia($datos){

      DB::update('denuncialegal',
      [ 'consenso'               => str_replace('"','',$datos["estatus_consenso"]),
        'consensodocto'          => str_replace('"','',$datos["id_consensodocto"]),

       'denunciapresentada'      => str_replace('"','',$datos["estatus_denuncia"]),
       'docto_denunciapresentada'=> str_replace('"','',$datos["id_denunciadocto"]),

       'medidasd'                =>str_replace('"','', $datos["estatus_medidas"]),
       'medidasd_docto'          => str_replace('"','',$datos["id_medidasdocto"]),
    
    ], " incidenteid=  %i", $datos["incidenteid"]);

    }//termina funcion


}//termina trait