<?php 
require 'traitBuscarId_por_Programa.php';

class clsIncidentes_nuevo {
use traiBuscarId_por_Programa;
    public function nuevoIncidente($datos){

      require 'clsIncidentes_folio.php';

      $f = new clsIncidentes_folio;

      $resultadoFolio = $f->generarFolio($datos['programa']);

      /** debenmo cambiar el programa por su id 
       * $datos['programa']
      */
      $programaid = clsIncidentes_nuevo::buscarIdDelPrograma($datos['programa']);

      /** debenmo cambiar el elabors por su id 
       * $datos['programa']
      */
      $elaboro = 1;
      /**  $datos['cargousuario'] */

      $cargoUsuario = 1;

      error_log(" valor de datos['adultoexterno'] " . $datos['adultoexterno']);
   
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
        'coloretapauno'=> $datos['coloretapauno'] ,
        'coloretapados'=> $datos['coloretapados'] ,
        'coloretapatres'=> $datos['coloretapatres'] ,
        'coloretapacuatro'=> $datos['coloretapacuatro'],
        'textocierre' => '.',
         'estado'=>'abierto'
  ]);

  $id = DB::insertId();
  
  error_log(" valor de id en incidente  : " . $id);

  $data = array('id' => $id,'folio' => $resultadoFolio["folio"]);

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
            'activo'                => 1
      ]);
        
    
  /* ------------------------------------------*/
   
  return json_encode($data);



    }


}//terminaclase