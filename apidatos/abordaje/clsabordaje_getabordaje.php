<?php 


class clsabordaje_getabordaje {

    public function getabordaje($id){

       $results = DB::query("SELECT * FROM abordajinterno where id =%i " ,$id );
  

       $idincidente = DB::queryFirstField("Select incidenteid from abordajinterno where id = %i  ", $id);

       $folioIncidente = DB::queryFirstField("select folio from incidente where id = %i" , $idincidente);
        
       //print_r( $results);

       //$results['folioincidente'] = $folioIncidente;

        return json_encode($results);

    }//termina function

    public function getabordaje_por_incidente($id){

        try {
                error_log("Dentreo de getabordaje_por_incidente " );
            

            $idabordaje = DB::queryFirstField("select id from abordajinterno where incidenteid = %i",$id);
            
            error_log(" idabordaje  " .  $idabordaje  );

            $folioIncidente = DB::queryFirstField("select folio from incidente where id = %i",$id);
            
            error_log(" folioIncidente  " .  $folioIncidente  );

            $results = DB::query("SELECT * FROM abordajinterno where id =%i " ,$idabordaje );

            //print_r( $results);
            $results[1]['folioincidente'] =  $folioIncidente;

            return json_encode($results);
            
        }catch(Exception $ex) {

          error_log($ex);

        }



    }
}