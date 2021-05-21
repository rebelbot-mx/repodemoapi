<?php 

trait traitGenerarRecipietes {

    function listaDeCorreos(){

        //1.- buscar los roles que tienen el permiso de  RECIBIRCORREOS
        //2.-buscar los usuarios con esos roles 
        //3. obtner sus datos 

        $roles = DB::queryRaw("SELECT * FROM `usuarios` WHERE rol in (select id from roles where RECIBECORREOS ='SI')");



        return $roles;    
    


    }

    function listaDeCorreos_depurada(){

        //1.- buscar los roles que tienen el permiso de  RECIBIRCORREOS
        //2.-buscar los usuarios con esos roles 
        //3. obtner sus datos 

       


        $usuarios = DB::queryRaw("SELECT * FROM `usuarios` WHERE rol in (select id from roles where RECIBECORREOS ='SI')");
       

        $tos =array();

        foreach ($usuarios as $key => $value) {
            # code...
            try{

                // print_r( $value );

                $correo = $value['email'];
                $name   = $value['nombre'];

                error_log(" correo : " . $correo );
                error_log(" name : " . $name );


                $usr["correo"] = $correo ;
                $usr["name"]   = $name ;




              

                //error_log("valor de usr " . $usr );

                $tos[]= $usr;

            }catch(Exception $e){

            }
        }//termina foreach
    


    return $tos;


    }


}