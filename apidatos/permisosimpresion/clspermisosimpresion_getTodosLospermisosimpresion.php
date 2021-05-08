<?php 

require 'traitBuscarProgramaDeUsuario.php';
class clspermisosimpresion_getTodosLospermisosimpresion {
use traitBuscarProgramaDeUsuario;


    //DEVUELVE LOS PERMISOS DE UN PROGRAMA O DE TODOS
    public function getpermisosimpresion($id) {
        
        //se recibe el id del usuario 

        $programaid = $this->buscar_programaId_x_idusuario($id);

        error_log(" valor de programaid : ". $programaid);

        //como filtrar esta informacion? 
        // no se pueden regresar todos los permisos
        if ($programaid == 0){
            $query =" SELECT *  FROM permisosimpresion p 
            join incidente i on i.id = p.incidenteid
            join usuarios u on u.id = p.usuarioid  
            where p.respuesta = 'PENDIENTE'";
            error_log("query de permisos --->>> : " . $query);
            $results = DB::query($query );

         

          

       

           

            return json_encode($results);      
        }else {
          
          $query ="SELECT * FROM permisosimpresion p 
          join incidente i on i.id = p.incidenteid
          join usuarios u on u.id = p.usuarioid 
          where i.programa= " . $programaid . "
           and  p.respuesta = 'PENDIENTE' " ;
          error_log("query de permisos ******: " .$query);   
 

           
         
           $results = DB::query($query);

          
           
           return json_encode(  $results);  


        }

  


    }
    public function getTodosLospermisosimpresion() {

        $results = DB::query("SELECT * FROM permisosimpresion " );

        return json_encode($results);


    }
}