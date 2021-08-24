<?php 




trait trait_actualizaTablaValoracion{

    function actualizaTablaValoracion( $datos, $confirmanumerico, $estado, $temp_actaValoracion ){
         
        $actualizacion = DB::update('valoracionintegral',[
            // 'incidenteid'           =>  $datos['incidenteid'],
            // 'fechacreacion'         => $datos['fechacreacion'],
            // 'fechaupdate'           => $datos['fechaupdate'],
            'textovi'                       => $datos['textovi'],
            'tipologiadelincidente'         => $datos['tipologiadelincidente'],
            'niveldelincidente'             => $datos['niveldelincidente'],
            'tipodecaso'                    => $datos['tipodecaso'],
            'confirmaincidente'             => $datos['confirmaincidente'],
            'confirmaincidentenumerico'     => $confirmanumerico,
            'tipoderespuesta'               => $datos['tipoderespuesta'],
            'medidasintegrales'             => $temp_actaValoracion,
            'estado'                        => $estado
        ],"id=%i",$datos['id']);

    }
}