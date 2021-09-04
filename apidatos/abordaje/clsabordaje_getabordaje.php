<?php 


class clsabordaje_getabordaje {

    public function getabordaje($id){

       $results = DB::query("SELECT * FROM abordajinterno where id =%i " ,$id );
  

       $idincidente = DB::queryFirstField("Select incidenteid from abordajinterno where id = %i  ", $id);

       $folioIncidente = DB::queryFirstField("select folio from incidente where id = %i" , $idincidente);
        
       $seguimiento = DB::queryFirstRow("select * from seguimiento where incidenteid = %i",$idincidente);
       
       $idactahecho = DB::queryFirstField("select actavaloracion_docto from incidente where id = %id", $idincidente);
       
       $idactavaloracion = DB::queryFirstField("select medidasintegrales from valoracionintegral where id = %id", $idincidente);
       //print_r( $results);

       //$results['folioincidente'] = $folioIncidente;

       $results["seguimiento"]       = $seguimiento ; 
       $results["id_actahechos"]     = $idactahecho ; 
       $results["id_actavaloracion"] = $idactavaloracion ; 


        return json_encode($results);

    }//termina function

    public function getabordaje_por_incidente($id){

        try {
                error_log("Dentreo de getabordaje_por_incidente " );
            

            $idabordaje = DB::queryFirstField("select id from abordajinterno where incidenteid = %i",$id);
            
            error_log(" idabordaje  " .  $idabordaje  );

            $folioIncidente = DB::queryFirstField("select folio from incidente where id = %i",$id);
            
            error_log(" folioIncidente  " .  $folioIncidente  );

            $results = DB::queryFirstRow("SELECT * FROM abordajinterno where id =%i " ,$idabordaje );

            //print_r( $results);
            $results[1]['folioincidente'] =  $folioIncidente;

            $folioIncidente = DB::queryFirstField("select folio from incidente where id = %i" , $id);
        
            $seguimiento = DB::queryFirstRow("select * from seguimiento where incidenteid = %i",$id);
            
            $idactahecho = DB::queryFirstField("select actavaloracion_docto from incidente where id = %i", $id);
            
            $idactavaloracion = DB::queryFirstField("select medidasintegrales from valoracionintegral where id = %i", $id);
            //print_r( $results);
     
            //$results['folioincidente'] = $folioIncidente;


            /* Tabla abordaje */
            $results0["folioAbordaje"]                  = $results["folioabordaje"] ;
            $results0["fechaUpdate"]                    = $results["fechaUpdate"] ; 
            $results0["status"]                         = $results["status"] ;
            $results0["informaenterector"]              = $results["informaenterector"] ;
            $results0["docto_informaenterector"]        = $results["docto_informaenterector"] ;
            $results0["estado"]                         = $results["estado"] ;
     
            /* tabla seguimiento */
            
            $results0["id_actahechos"]     = $idactahecho ; 
            
            $results0["id_actavaloracion"] = $idactavaloracion ; 
            $results0["folioIncidente"]    = $folioIncidente ; 
            
            $results0["seguimiento"]       = $seguimiento ; 

            return json_encode($results0);
            
        }catch(Exception $ex) {

          error_log($ex);

        }



    }
}