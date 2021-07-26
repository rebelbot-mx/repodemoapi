<?php


class clsBorrarArchivos {


       public function borrarDoctos() {
       

        /* NOTA */ 

        /*
        hAY QUE TENER CUIDADO CON LAS RUTAS POR QUE SI SE FORMAN DE MANERA ERRONEA
        Y CORRESPONDE A ALGNA RUTA EN DONDE HAY CODIGO FUENTE FUNCIONANDO SE PUEDE 
        LLEGAR A BORRAR.  -- ACABA DE PASAR--
        */

        $raiz = $_ENV['RUTA'] . "/uploads";   
        $abordaje  = $raiz ."/abordaje";
        $actas  = $raiz ."/actas";
        $conciencia  = $raiz ."/concienciaprevencion";
        $denuncia  = $raiz ."/denuncia";
        $investigacion  = $raiz ."/investigacion/evidencias";
        $medidas  = $raiz ."/medidasintegrales";
        $seguimiento  = $raiz ."/seguimiento";

        error_log(" abordaje : " .  $abordaje);
        error_log(" actas    : " .  $actas);
        error_log(" raiz     : " .  $raiz);
        // List of name of files inside
        // specified folder
        $files_abordaje = glob($abordaje.'/*');
        $files_actas = glob($actas.'/*'); 
        $files_conciencia = glob($conciencia.'/*'); 
        $files_denuncia = glob($denuncia.'/*'); 
        $files_investigacion = glob($investigacion.'/*');
        $files_medidas = glob($medidas.'/*');
        $files_seguimiento = glob($seguimiento.'/*'); 


        error_log(" antes den entrar a los forechas : " );

           
        // Deleting all the files in the list
        foreach($files_abordaje as $file) {
           
            if(is_file($file)) 
                 
            error_log(" archivo : " . $file);
                // Delete the given file
                unlink($file); 
        }
        /*************** */

                // Deleting all the files in the list
                foreach($files_actas as $file) {
           
                    if(is_file($file)) 
                    
                        // Delete the given file
                        unlink($file); 
                }
    
          /*************** */

                // Deleting all the files in the list
                foreach($files_conciencia as $file) {
           
                    if(is_file($file)) 
                    
                        // Delete the given file
                        unlink($file); 
                }              
         /*************** */

                // Deleting all the files in the list
                foreach($files_denuncia as $file) {
           
                    if(is_file($file)) 
                    
                        // Delete the given file
                        unlink($file); 
                }    
         /*************** */

                // Deleting all the files in the list
                foreach($files_investigacion as $file) {
           
                    if(is_file($file)) 
                    
                        // Delete the given file
                        unlink($file); 
                }              
         /*************** */

                // Deleting all the files in the list
                foreach($files_medidas as $file) {
           
                    if(is_file($file)) 
                    
                        // Delete the given file
                        unlink($file); 
                }              
         /*************** */

                // Deleting all the files in the list
                foreach($files_seguimiento as $file) {
           
                    if(is_file($file)) 
                    
                        // Delete the given file
                        unlink($file); 
                }
                

                $data = array( 'msg' => 'ok');
                
                 return json_encode($data);
          

       }//termina funcion borrarDoctos

}//termina clase