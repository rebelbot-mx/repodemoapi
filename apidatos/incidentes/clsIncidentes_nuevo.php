<?php 

//Use swiftmailer;
require 'traitBuscarId_por_Programa.php';



class clsIncidentes_nuevo {
use traiBuscarId_por_Programa;

    public function nuevoIncidente($datos,$ROOT_DIR ){

      require 'clsIncidentes_folio.php';

      $f = new clsIncidentes_folio;

      $id ="";

      $resultadoFolio = $f->generarFolio($datos['programa']);

      /** debenmo cambiar el programa por su id 
       * $datos['programa']
      */
      $programaid = $this->buscarIdDelPrograma($datos['programa']);

      /** debenmo cambiar el elabors por su id 
       * $datos['programa']
      */
      $elaboro = 1;
      /**  $datos['cargousuario'] */

      $cargoUsuario = 1;

      error_log(" valor de datos['adultoexterno'] " . $datos['adultoexterno']);
   
      /////////////////////////////////////////
      // esta if es para ver si tenemos ya el acta de valoracion , en caso 
      // no tenerla el estado del reporte sera amarillo 
      ///////////////////////////////////////////////////////////////////////////////////////////////////////////
      $color_etapauno = 'yellow';
      if($datos['actavaloracion']== '0'){

        $color_etapauno = 'yellow';

       }else {

        $color_etapauno = 'green';

       }
 

      DB::insert('incidente', [
        
        'folio' => $resultadoFolio["folio"],
        'programa'=>  $resultadoFolio["id"],
        'fechaAlta'=>  $datos['fechaAlta'],
        'fechaUpdate'=>  $datos['fechaUpdate'],
        'usuarioCreador'=>  $datos['usuarioCreador'],
        'involucrados'=>  $datos['involucrados'],
        'elaboro'=>  $datos['elaboro'], 
        'cargousuario'=>   $datos['cargousuario'],
        'registrohechos'=>  $datos['registrohechos'],
        'prefildelagresor'=> $datos['perfildelagresor'] ,
        'paadultocolaborador' => $datos['paadultocolaborador'],
        'paadultocolaboradortipo' => $datos['paadultocolaboradortipo'],
        'pafamilia' =>$datos['pafamilia'],
        'pafamiliatipo' =>$datos['pafamiliatipo'], 
        'adultoexterno' => $datos['adultoexterno'],
        'nnj'=> $datos['nnj'],
        'perfilvictima'=>  $datos['perfilvictima'],
        'recibeayuda' => $datos['recibeayuda'],
        'medidasproinmediatas'=> $datos['medidasproinmediatasdiatas'] ,
      'incidenteconfirmado'=>  $datos['incidenteconfirmado'],
        'testigos' => $datos['testigos'],
        'etapa'=> $datos['etapa'] ,
        'activo'=> 1,

        'etapauno'=> $datos['etapauno'] ,
        'etapados'=> $datos['etapados'] ,
        'etapatres'=> $datos['etapatres'] ,
        'etapacuatro'=> $datos['etapacuatro'] ,
        'coloretapauno'=> $color_etapauno ,
        'coloretapados'=> $datos['coloretapados'] ,
        'coloretapatres'=> $datos['coloretapatres'] ,
        'coloretapacuatro'=> $datos['coloretapacuatro'],
        'textocierre' => '.',
        'actavaloracion'=> $datos['actavaloracion'],
         'estado'=>'en espera de valoracion'
  ]);

  $id = DB::insertId();
  
  error_log(" valor de id en incidente  : " . $id);

 // $data = array('id' => $id,'folio' => $resultadoFolio["folio"]);

  /* ----------------------------------------- */
     //creamos el registro para  valoracionintegral

      DB::insert('valoracionintegral', [
        'incidenteid' => $id,
        'fechacreacion' => $datos['fechaAlta'],
        'fechaupdate' => $datos['fechaAlta'],
        'textovi'               => '.',
            'tipologiadelincidente' => '.',
            'niveldelincidente'     => '.',
            'tipodecaso'            => '.',
            'confirmaincidente'     => 'En Proceso de Valoracion',
            'confirmaincidentenumerico'     => 0,
            'tipoderespuesta'       => 'En Proceso de Valoracion',
            'medidasintegrales'     => '0',
            'activo'                => 1,
            'estado'                => 'abierto',
            'colorestadorespuesta'=> 'yellow',
           
            'estadorespuesta'=> 'abierto'
      ]);
        
    
  /* ------------------------------------------*/
   require $ROOT_DIR .'/apidatos/enviodecorreos/clsEnviarCorreo.php';
     
   $seEnvianLosCorreos  = $_ENV['ENVIO_DE_CORREOS'];

   $usuariosCorreos =  new clsEnviarCorreo();
   $listaDeCorreos_para_enviar= $usuariosCorreos->listaDeCorreos_depurada(); 
        
   if ($seEnvianLosCorreos =="SI"){
   $enviarCorreo = new clsEnviarCorreo();
   $enviarCorreo->enviarCorreo_version_extendida_nuevoIncidente($resultadoFolio["folio"],$ROOT_DIR);
   }
   
   $data = array(
          'id'    => $id,
          'folio' => $resultadoFolio["folio"],
          'correos' => $listaDeCorreos_para_enviar);

  return json_encode($data);



    }
    //apiañldeas sendgrdi 
    //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
  

}//terminaclase