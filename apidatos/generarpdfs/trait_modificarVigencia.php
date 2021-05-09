<?php

trait trait_modificarVigencia {


     function   modificarVigencia($id){

      error_log("dentro de trait modificarVigencia");

      $modificar = DB::query("update permisosimpresion set vigente ='NO' where id =%i ",$id);
       
      return;
     
    }


}