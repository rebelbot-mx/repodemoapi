<?php

trait  validarSeguimiento {


    function se_puedeCerrar_Seguimiento($id){


        $seguimiento = DB::queryFirstRow("select * from seguimiento where id = %i",$id);
        
        
        $tipoderespuesta = DB::queryFirstRow("select tipoderespuesta from valoracionintegral  where incidenteid = %i",$seguimiento['incidenteid']);
        
        $tipores = $tipoderespuesta['tipoderespuesta'];

        error_log(" Tipo de respuesta en se_puedeCerrar_Seguimiento : " .  $tipores);
        


        $s = strlen($seguimiento["status"]);
        if ($s > 20 ){

          error_log(" plan = " .$seguimiento['plan'] . "   no debe de ser 'POR CONFIRMAR' ");
          $r1 = 0;
          $r1 = $this->No_es_Valido($seguimiento['plan'],'POR CONFIRMAR');
        error_log(" valor de r1 : " . $r1);
          $r2 = 0;
          $r2 = $this->No_es_Valido($seguimiento['documentos'],'POR CONFIRMAR');

          $r3 = 0;
          $r3 = $this->No_es_Valido($seguimiento['notificaciondif'],'POR CONFIRMAR');

           /*  SI ES INVESTIGACION INTERNO O RESPUESTA INTERNA NO APLICA LA DOCUMENTACION 
           DE NOTIFCACION A LA AUTORIDAD */
           $r4 = 0;
           if ($tipores=="DENUNCIA PENAL"){
            $r4 = $this->No_es_Valido($seguimiento['notificacionautoridad'],'POR CONFIRMAR');
        }
           
         
          
        
          $r5 = 0;
          $r5 = $this->No_es_Valido($seguimiento['notificacionpfn'],'POR CONFIRMAR');
          
          
          $r6 = 0;
          $r6 = $this->No_es_Valido($seguimiento['notificaciodenunciante'],'POR CONFIRMAR');
          
          
          $r7 = 0;
          $r7 = $this->No_es_Valido($seguimiento['actavaloracion'],'POR CONFIRMAR');
          
          
          $r8 = 0;
          $r8 = $this->No_es_Valido($seguimiento['planrecuperacion'],'POR CONFIRMAR');
          
          $r9 = 0;        
           $r9=   $this->No_es_Valido($seguimiento['documentos_docto'],0);

           $r10 = 0;
           $r10= $this->No_es_Valido($seguimiento['notificaciondif_docto'],0);
           
           /*  SI ES INVESTIGACION INTERNO O RESPUESTA INTERNA NO APLICA LA DOCUMENTACION 
           DE NOTIFCACION A LA AUTORIDAD */
           $r11 = 0;
           if ($tipores=="DENUNCIA PENAL"){
             $r11= $this->No_es_Valido($seguimiento['notificacionautoridad_docto'],0);
           }
           
           $r12 = 0;
           $r12= $this->No_es_Valido($seguimiento['notificacionpfn_docto'],0);

           $r13 = 0;                                
           $r13=  $this->No_es_Valido($seguimiento['notificaciondenunciante_docto'],0);

           $r14 = 0;
           $r14=  $this->No_es_Valido($seguimiento['actavaloracion_docto'],0);

           $r15 = 0;
           $r15= $this->No_es_Valido($seguimiento['planrecuperacion_docto'],0);

           $r16 = 0;
           $r16= $this->No_es_Valido($seguimiento['plan_docto'],0);



           error_log(" protocolosos = " .$seguimiento['protocolosos'] . "   no debe de ser 'PENDIENTE' ");
  
           $r15 = 0;
           $r15= $this->No_es_Valido($seguimiento['protocolosos'],'PENDIENTE');

           $total = 0;
            
           error_log(" valor de  totla " . $total);
           error_log(" valor de  r1 " . $r1);
           error_log(" valor de  r2 " . $r2);
           error_log(" valor de  r3 " . $r3);
           error_log(" valor de  r4 " . $r4);
           error_log(" valor de  r5 " . $r5);
           error_log(" valor de  r6 " . $r6);
           error_log(" valor de  r7 " . $r7);
           error_log(" valor de  r8 " . $r8);
           error_log(" valor de  r9 " . $r9);
           error_log(" valor de  r10 " . $r10);
           error_log(" valor de  r11 " . $r11);
           error_log(" valor de  r12 " . $r12);
           error_log(" valor de  r13 " . $r13);
           error_log(" valor de  r14 " . $r14);
           error_log(" valor de  r15 " . $r15);
           $total =  $r1+ $r2 + $r3 + $r4+ $r5+ $r6 + $r7 + $r8 +$r9 + $r10 +$r11 +$r12 + $r13 +$r14 +$r15+ $r16;
           error_log(" valor de  totla " . $total);
           if($total == 0) {
               return true; // se puede validar
           }else{
               return false; // no se puede validar
           }
           

        } else{
             
            return false; //no se puede validar

        }

        
 /*
 
             'status'                      =>  filter_var($datos['status'],FILTER_SANITIZE_STRING),
            'plan'                        =>  filter_var($datos['plan'],FILTER_SANITIZE_STRING),
            'documentos'                  =>  filter_var($datos['documentos'],FILTER_SANITIZE_STRING),
            'notificaciondif'             =>  filter_var($datos['notificaciondif'],FILTER_SANITIZE_STRING),
            'notificacionautoridad'       =>  filter_var($datos['notificacionautoridad'],FILTER_SANITIZE_STRING),
            'notificacionpfn'             =>  filter_var($datos['notificacionpfn'],FILTER_SANITIZE_STRING),
            'notificaciodenunciante'      =>  filter_var($datos['notificaciodenunciante'],FILTER_SANITIZE_STRING),
            'actavaloracion'              =>  filter_var($datos['actavaloracion'],FILTER_SANITIZE_STRING),
            'planrecuperacion'            =>  filter_var($datos['planrecuperacion'],FILTER_SANITIZE_STRING),


            'documentos_docto'            =>  filter_var($datos['documentos_docto'],FILTER_SANITIZE_STRING),
            'notificaciondif_docto'       =>  filter_var($datos['notificaciondif_docto'],FILTER_SANITIZE_STRING),
            'notificacionautoridad_docto' =>  filter_var($datos['notificacionautoridad_docto'],FILTER_SANITIZE_STRING),
            'notificacionpfn_docto'       =>  filter_var($datos['notificacionpfn_docto'],FILTER_SANITIZE_STRING),
            'notificaciondenunciante_docto'=> filter_var($datos['notificaciodenunciante_docto'],FILTER_SANITIZE_STRING),
            'actavaloracion_docto'        =>  filter_var($datos['actavaloracion_docto'],FILTER_SANITIZE_STRING),
            'planrecuperacion_docto'      =>  filter_var($datos['planrecuperacion_docto'],FILTER_SANITIZE_STRING),
            'plan_docto'                  =>  filter_var($datos['plan_docto'],FILTER_SANITIZE_STRING),
            'protocolosos'                =>  filter_var($datos['protocolosos'],FILTER_SANITIZE_STRING),
            
 
 
 */



    }

    function esValido($campo, $valor){
           $res=0;
           if ($campo== $valor){
               $res = 0;

           }else {

            $res=1;
           }
           return $res;
    }

    function No_es_Valido($campo, $valor){
        $res=0;
        if ($campo== $valor){
            $res = 1;

        }else {

         $res=0;
        }
        return $res;
 }
}


/* 

Marcos ALberto CAbrera Abarca <mcabrera@rebelbot.mx>
	
15:44 (hace 0 minutos)
	
para carranza, Luis

Estimado Julio.

Describo los casos de aceptación

Escenario A.-

 1.- Login en sistema
 2.- El usuario Observa el Acuerdo de privacidad.
 3.- El usuario entra directamente al Dashboard que le corresponda vera los casos correspondientes a su programa.
    3.1 Variante El usuario podra ver todos los incidentes de todos los programas si cuenta con los permisos.
4.- El usuario  crear un nuevo incidente , si tiene el permiso.
5.- El usuario  realiza el reporte Inicial 
    5.1 .- El sistema valida que este bien requisitado el reporte
    5.2.-  El sistema guarda el reporte y envia correo a aquellos usuarios que tenga el permiso de
           recepcion de correos.
    5.3.-  El usuario es redirigido a un mensaje de notificacion, en  donde se explica al usuario que 
           su repore ha sido dado de alta.

Escenario B

1.- El usuario haciendo uso del Dashboard ingresa al apartado de Valoracion integral de un incidente,
    esto si tiene el permiso adecuado.
2.- EL usuario escribe el dictamen de la valoracion integral y dictamina si este reporte puede ser considerado 
    o no un Incidente.
3.- En caso de que el el dictamen de la valoracion integral sea  que no es un incidente , el sistema redirecciona al usuario a una 
    notificacion en donde se le explica que el reporte ha sido cerrado. 
    3.1.- El reporte ya no podra ser modificado por el usuario.
    3.2.- El sistema envia un correo a las personas con el permiso de recibir correos, en donde
          se informa la situacion.
4.- En caso de que el dictamen sea que si es un incidente , el sistema habilitara las opciones  para que el usuario 
    termina de realizar la valoracion integral
    4.1.- El usuario guarda la valoracion integral.
    4.2-  El usuario es redireccionado a una notificacion en donde se le informa que se ha realizado  la 
          valoracion integral con exito y que se ha informado a los usuarios con permiso de recibir correo.
       
Escenario C

1.-  El usuario haciendo uso del Dashboard ingresa al apartado de Seguimiento de un incidente,
    esto si tiene el permiso adecuado.
2.- El Usuario llena gradualmente el seguimiento y puede ir guardarndo el avance si tiene el permiso
    2.1- Cada vez que el usuario actualiza el seguimiento , los usuarios con permiso de recibir correo 
         recibiran una notificacion de actualizacion del seguimiento.
3.- Cuando el usuario halla cumplido todos los requisitos del seguimieto , se notificara a los usuarios
    con permiso de recibir correos y el seguimiento ya no permitira mas actualizacion.
    3.1- Los tipos de respuestas aunque indicadas, su termino no siempre coincidira con la 
         el termino del seguimiento. 

Escenario D

1.- El usuario haciendo uso del Dashboard ingresa al apartado de Cierre de un incidente esto si tiene 
    el permiso adecuado.
2.- EL sistema muestra al usuario los documentos que fueron proporcionados durante el seguimiento.
3.- el usuario realiza su dictamen final e ingresa el nombre de los testigos que participan en el 
    acta de cierre.
    3.1 El usuario realiza el cierre del incidente esto si tiene el permiso adecuado.
    3.2 El sistema valida antes del cierre que se cumplas las condiciones para proceder
    3.4 EL sistema redirecionara al usuario  a la notificacion de cierre y le enviara correo 
        a los usuarios con permiso de recibir correos.
    3.5 El sistema actualizara el registro y no permitara la edicion del mismo.

Escenario E

1.- El sistema mostrara a traves de la colorimetria establecida el estatus correcto y actual
    del registro de los incidentes.

Escenario F

1.- El usuario accedera a configuracion si tiene el permiso adecuado.
2.- El usuario puede realizar las operaciones  de Crear un registro, Modificar un registro,
    actualizar un registro y borrar un registro en los apartados de : 
    --usuarios
    --roles
    --unidades sos
    --cargos
    --parametros

Escenario G

1.-El usuario accesa al apartado de Conciencia o de Prevencion si tiene el permiso adecuado.
2.-EL usuario puede realizar las operacion de Crear , Leer, Actualizar y Borrar un registro 
   sobre  conciencia o prevencion segun sea el caso y si tiene el permiso  adecuado.


Escenario H

1.- El usuario accesa al apartado de Estadisticas si tiene el permiso adecuado.
2.- El sistema genera la informacion que el usuario solicita

Escenario I

1.- El sistema permite subir documentos PDF 
2.- EL sistema solo permite a los usuarios con el permiso adecuado  visualizar el PDF
    dentro de la plataforma 
3.- El sistema permite subir imagenes -- pendientes
4.- El sistema permite subir archivos de audio --formatos pendiente y su reproduccion
    dentro de la plataforma --pendiente
5.- EL sistema permite subir archivo de video --formatos pendientes y su reproduccion
    dentro de la plataforma --pendiente

*/