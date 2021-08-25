<?php 


trait trait_updateTablas_despues_de_validarDenuncia {

    
    function actualizarTablaIncidente_despues_de_validarDenuncia($estaValidadoDenuncia,$id){
      /*
     
      */
     if ($estaValidadoDenuncia == true){

                DB::update('incidente',
                             [ 'coloretapatres' =>'green' ],
                              " id=  %i", 
                                $id
                             );

                DB::update('valoracionintegral',
                          [ 
                            'colorestadorespuesta' => 'green',
                            'estadorespuesta'      => 'cerrado'
                         ],
                         " incidenteid=  %i", 
                          $id
                        );

     }
   

     /*
     Se realiza validacion de valoracion inicial
     */

    }//termina funcion


}//termina trait