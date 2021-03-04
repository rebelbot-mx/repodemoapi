<?php 

require 'traitBuscarProgramaDeUsuario.php';
class clspermisosimpresion_getpermisosimpresion {
use traitBuscarProgramaDeUsuario;

    public function getpermisosimpresion($id) {

        $results = DB::query("SELECT * FROM permisosimpresion where id =%i " ,$id );

        return json_encode($results);


    }

        //DEVUELVE LOS PERMISOS DE UN PROGRAMA O DE TODOS
        public function getpermisosimpresion_x_usuario($id) {
        
            //se recibe el id del usuario 
    
            $programaid = $this->buscar_programaId_x_idusuario($id);
    
            error_log(" valor de programaid : ". $programaid);
    
            //como filtrar esta informacion? 
            // no se pueden regresar todos los permisos
            if ($programaid == 0){
                $query ="SELECT * FROM permisosimpresion p 
                join incidente i on i.id = p.incidenteid
                join usuarios u on u.id = p.usuarioid ";
                error_log("query de permisos : " .$query);
                $results = DB::queryRaw($query );
    
                return json_encode($results);      
            }else {
              
              $query ="SELECT * FROM permisosimpresion p 
              join incidente i on i.id = p.incidenteid
              join usuarios u on u.id = p.usuarioid where i.programa= " . $programaid;
               error_log("query de permisos : " .$query);   
     
                $results = DB::queryRaw($query);
    
    
                return json_encode($results);  
    
    
            }
    
      
    
    
        }
}