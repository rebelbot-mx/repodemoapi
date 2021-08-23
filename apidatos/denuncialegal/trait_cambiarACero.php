<?php

trait trait_cambiarACero{
    
    /********************************** 
     * En caso de que el valor se "En espera "
     * se regresara un  valor de 0
     * 
     ***********************************/
    function cambiarACero($valor){

    

        if ( $valor == 'En espera' ) {
            
            $mx =0;

        }else {
            $mx = $valor;
        }

        return $mx;

   //?  return 0 : return $valor;

    }//termina la funcion

}