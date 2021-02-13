<?php 
use SendGrid\Mail\From;
use SendGrid\Mail\HtmlContent;
use SendGrid\Mail\Mail;
use SendGrid\Mail\PlainTextContent;
use SendGrid\Mail\Subject;
use SendGrid\Mail\To;

require  'traitTemplateBase_nuevoIncidente.php';
require  'traitGenerarRecipietes.php';

//require_once '../../../vendor/autoload.php';
/*
MAIL_DRIVER=smtp
MAIL_HOST=smtp-relay.sendinblue.com
MAIL_PORT=587
MAIL_USERNAME=mcabrera@rebelbot.mx
MAIL_PASSWORD= W5NVd4C2GwavQDbg
MAIL_ENCRYPTION=tls
MAIL_FROM_NAME="Admin Chocolate"
MAIL_FROM_ADDRESS="mcabrera@rebelbot.mx"


$transporter = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
  ->setUsername('username@gmail.com')
  ->setPassword('password');

$mailer = Swift_Mailer::newInstance($transporter);

*/
class clsEnviarCorreo{
    use traitTemplateBase_nuevoIncidente,traitGenerarRecipietes;

    public function enviarCorreo() {

    $transporter = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
    ->setUsername('dev.marcoscabrera@gmail.com')
    ->setPassword('hva2306..');
  
  $mailer = Swift_Mailer::newInstance($transporter);

   
  // Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transporter);

// Create a message
$message = (new Swift_Message('Wonderful Subject'))
  ->setFrom(['john@doe.com' => 'John Doe'])
  ->setTo(['mcabrera@rebelbot.mx' => 'A name'])
  ->setBody('Here is the message itself')
  ;

// Send the message
$result = $mailer->send($message);

    }// ya termino 

    public function ev4($tema__del__correo,$contenido_template) {

        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("mcabrera@rebelbot.mx", "Soporte Plataforma ALDEAS SOS");
        $email->setSubject($tema__del__correo);
        $email->addTo("dev.marcoscabrera@gmail.com", "Usuario de Plataforma");
       // $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
        $email->addContent(
            "text/html", $contenido_template
        );
        $sendgrid = new \SendGrid('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');
        try {
            $response = $sendgrid->send($email);
           // print $response->statusCode() . "\n";
           // print_r($response->headers());
           // print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    
    
       }

       public function getFecha() {

       $tz = 'America/Mexico_City';
       $timestamp = time();
       $dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
       $dt->setTimestamp($timestamp); //adjust the object to correct timestamp
       $fechaDeNotificacion =  $dt->format('Y-m-d');

       return $fechaDeNotificacion;
       
       }//termina funcion


       /*
         obtenemos los usiarios con permiso de recibir correos
       */
       public function getListaDeCorreos($textoTema) {
        $tos =array();

        $usuarios = $this->listaDeCorreos();

        $numUsuarios = isset($usuarios);

        if ($numUsuarios == false){

          return 0;

        }else {
            
            foreach ($usuarios as $key => $value) {
                # code...
                try{

                    // print_r( $value );

                    $correo = $value['email'];
                    $name   = $value['nombre'];

                    error_log(" correo : " . $correo );
                    error_log(" name : " . $name );
                    error_log(" textoTema : " . $textoTema );

                    $usr = new To(

                           $correo ,
                           "usuario",
                           [
                            '-name-' => $name,
                            '-github-' => 'http://github.com/example_user1'                               
                           ],
                           $textoTema
                    );

                    //error_log("valor de usr " . $usr );

                    $tos[]= $usr;

                }catch(Exception $e){

                }
            }//termina foreach
        
        }//termina else

        return $tos;

       }//

       public function getTemplate($arg){

        $nombreTemplate = $arg['nombretemplate'];

       }

       public function enviarCorreo_version_extendida_nuevoIncidente($folio){

        $from = new From("mcabrera@rebelbot.mx", "Soporte Plataforma ALDEAS SOS");

        $textoTema = "Se ha realizado un nuevo reporte en la Plataforma ALDEAS SOS -name-";

        $tos = array();

        $tos = clsEnviarCorreo::getListaDeCorreos($textoTema);
      
        /******************** fecha e notificacion ********** */
        
         $fechaDeNotificacion =  clsEnviarCorreo::getFecha();


        


    $subject = new Subject("Aviso de Plataforma ALDEAS SOS -name-!"); // default subject
    $globalSubstitutions = [
        '-time-' => $fechaDeNotificacion
    ];
    $plainTextContent = new PlainTextContent(
        " "
    );

    //Obtenemos nuestro template 
    $tpl =  $this->template();
    $contenido = str_replace('{{folio}}',$folio,$tpl);


    $htmlContentx = new HtmlContent(   $contenido  );
   /* $htmlContent = new HtmlContent(
        "<strong>Hello -name-, your github is <a href=\"-github-\">here</a></strong> sent at -time-"
    );*/

    $email = new Mail(
        $from,
        $tos,
        $subject, // or array of subjects, these take precedence
        $plainTextContent,
        $htmlContentx,
        $globalSubstitutions
    );

    $sendgrid = new \SendGrid('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');
    try {
        $response = $sendgrid->send($email);

    } catch (Exception $e) {
        echo 'Caught exception: '.  $e->getMessage(). "\n";
    }

       } //termina funcion extendida

   public function enviarCorreo_x($arg){

        $from = new From("mcabrera@rebelbot.mx", "Soporte Plataforma ALDEAS SOS");

        $textoTema = $arg['textotema'];//"Se ha realizado un nuevo reporte en la Plataforma ALDEAS SOS ";
         
        error_log("valor de textotema: "  . $textoTema);

        $tos = array();

        $tos = clsEnviarCorreo::getListaDeCorreos($textoTema);
    
        /******************** fecha e notificacion ********** */
        
        $fechaDeNotificacion =  clsEnviarCorreo::getFecha();


        


    $subject = new Subject("Aviso de Plataforma ALDEAS SOS -name-!"); // default subject
    $globalSubstitutions = [
        '-time-' => $fechaDeNotificacion
    ];
    $plainTextContent = new PlainTextContent(
        " "
    );

    //Obtenemos nuestro template 

    $tpl =  $arg['template'];

    error_log(" tpl en enviarCorreo_x : " . $tpl);
   
    $contenido = $tpl;


    $htmlContentx = new HtmlContent(   $contenido  );
    /* $htmlContent = new HtmlContent(
        "<strong>Hello -name-, your github is <a href=\"-github-\">here</a></strong> sent at -time-"
    );*/

    $email = new Mail(
        $from,
        $tos,
        $subject, // or array of subjects, these take precedence
        $plainTextContent,
        $htmlContentx,
        $globalSubstitutions
    );

    $sendgrid = new \SendGrid('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');
    try {
        $response = $sendgrid->send($email);

    } catch (Exception $e) {
        echo 'Caught exception: '.  $e->getMessage(). "\n";
    }

       
   }
}