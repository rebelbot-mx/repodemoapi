<?php

trait trait_modificarVigencia {


     function   modificarVigencia($id){

      $modificar = DB::update("update permisosimpresion set vigente ='NO' where id =%i ",$id);
       
      return;
     
    }


}