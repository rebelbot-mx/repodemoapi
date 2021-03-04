<?php 


trait traitGenerarPassword {


    function generarPassword(){
      
        $esValido = false;
        $passValido = '';

        while ($esValido == false) {
            # obtenemos una contraseña.
            $pass =  $this->randomPassword();

            #verificamos que la contraseña no este
            #repitida
            $count = DB::queryFirstField("SELECT COUNT(*) FROM permisosimpresion WHERE password = %s", $pass);
            
            //si el resultado es cero significa que la contraseña no existe en la tabl 
            // y cambiamos el valor de la variable para salir del ciclo , al mismo tiempo
            //asignamos el password validado a la variable que la funcion regresara.
            if ($count == 0 ) {
                $esValido = true;
                $passValido = $pass;
            }


        }// termina while

        // regresamos un password que no exista en la tabla
        return $passValido;

    } // termina funcion.


    function randomPassword() {
        /*
        * Generamos de forma aleatoria una contraseña alfanumerica random
        */
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //declarar $pass como un array
        $alphaLength = strlen($alphabet) - 1; //poner la longitua -1 en caceh
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //convirte  el array en cadena
    }



}