<?php 

require 'traitBuscarProgramaDeUsuario.php';
require 'traitBuscarPermisoDeAutorizacion.php';

class clspermisosimpresion_getpermisosimpresion {
use traitBuscarProgramaDeUsuario,traitBuscarPermisoDeAutorizacion;

    public function getpermisosimpresion($id) {

        $results = DB::query("SELECT * FROM permisosimpresion where id =%i " ,$id );

        return json_encode($results);


    }

        //DEVUELVE LOS PERMISOS DE UN PROGRAMA O DE TODOS
        public function getpermisosimpresion_x_usuario($id) {


            error_log(" BANDERA ");
        
            //se recibe el id del usuario 
    
            $programaid = $this->buscar_programaId_x_idusuario($id);

            //*¿SE DEBEDE REVISAR EL PERMISO DEL USUARIO ?
            /*  Es correcto debe de revisarse para aprovechar  la misma funcion. */
            $permiso = "VISIBILIDADDEINCIDENTES";
            $visbilidadIncidentes = $this->buscarPermisoDeAutorizacion($id,$permiso);

            error_log("visibilidad  : >>>> " .  $visbilidadIncidentes );
    
            error_log(" valor de programaid : ". $programaid);
    
            //como filtrar esta informacion? 
            // no se pueden regresar todos los permisos

            /*
            --consulta simplificada--
            SELECT p.id, 
                p.usuarioid,
                u.nombre, u.programa,
                i.folio,
                p.etapa,
                p.fechapeticion,
                p.usuarioidautorizo,
                p.fechaautorizacion
       

       FROM permisosimpresion p 
                join incidente i on i.id = p.incidenteid
                join usuarios u on u.id = p.usuarioid
            */

                        /* 
             Si este usuario tiene solo la visibilidas 'propios' 
            */
             
            if ( $visbilidadIncidentes == 'PROPIOS' ){
                error_log(" propios ");


                $query ="SELECT p.id, 
                p.usuarioid,
                p.incidenteid,
                u.nombre, u.programa,
                i.folio,
                p.etapa,
                p.fechapeticion,
                p.usuarioidautorizo,
                p.respuesta,
                p.fechaautorizacion FROM permisosimpresion p 
                join incidente i on i.id = p.incidenteid
                join usuarios u on u.id = p.usuarioid 
                where u.id = " . $id  ;
                // and p.respuesta = 'PENDIENTE'";
                 error_log("query de permisos propios: " .$query);   
       
                  $results = DB::query($query);
      
      
                  return json_encode($results);  



            }else {

            if ($programaid == 0){
                $query ="SELECT p.id, 
                p.usuarioid,p.incidenteid,
                u.nombre, u.programa,
                i.folio,
                p.etapa,
                p.fechapeticion,
                p.usuarioidautorizo,
                p.fechaautorizacion FROM permisosimpresion p 
                join incidente i on i.id = p.incidenteid
                join usuarios u on u.id = p.usuarioid
                where p.respuesta = 'PENDIENTE' ";
                error_log("query de permisos : " .$query);
                $results = DB::query($query );
    
                return json_encode($results);      
            }else {
              
              $query ="SELECT p.id, 
              p.usuarioid,p.incidenteid,
              u.nombre, u.programa,
              i.folio,
              p.etapa,
              p.fechapeticion,
              p.usuarioidautorizo,
              p.fechaautorizacion FROM permisosimpresion p 
              join incidente i on i.id = p.incidenteid
              join usuarios u on u.id = p.usuarioid 
              where i.programa= " . $programaid . "  
               and p.respuesta = 'PENDIENTE'";
               error_log("query de permisos : " .$query);   
     
                $results = DB::query($query);
    
    
                return json_encode($results);  
    
    
            }

        }//termina el if principal.
    

    
        }
}