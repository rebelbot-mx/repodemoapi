<?php 

trait traitTemplate_cierreSeguimiento {

    function template(){
       
        $raiz = $_ENV['RUTA'];
        $ruta = $raiz .'/apialdeas/apidatos/enviodecorreos/traitTemplate_cierreSeguimiento.html';

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

    function populate_template($args){
      
         $tpl = $this->template();
         $folio =$args['folio'][0];
      
         
        // error_log( "folio " );
        // error_log(gettype($folio) );
        

        // $confirmacion = $args['confirmacion'];
         //$tipo = $args['tipoderespuesta'];

         $contenido = str_replace('{{folio}}', $folio ,$tpl);
         //$contenid2 = str_replace('{{confirmacion}}',$confirmacion  ,$contenido);
         //$contenid3 = str_replace('{{tipoderespuesta}}', $tipo ,$contenid2);
         
         //error_log( $contenid3 );
         return $contenido;

    }


}