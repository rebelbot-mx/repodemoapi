<?php 

trait traitTemplateBase_nuevoIncidente {

    function template($ROOT_DIR){
        $raiz = $_ENV['RUTA'];
        error_log(" valor de raiz en trait nuevo incidente " . $raiz);
        $ruta = $raiz . '/apidatos/enviodecorreos/template_nuevoIncidente.html';

        $myfile = fopen($ruta, "r");
        // some code to be <executed class="77">
        $elTemplate ="";

        while(!feof($myfile)) {
            $elTemplate =  $elTemplate . fgets($myfile);
          }
         
        fclose($myfile);
      // error_log("valor de elTemplate : " . $elTemplate );
        return $elTemplate;    
    


    }


}