<?php


class clsSubirArchivos {

    public function subirArchivo(){

//header('Content-Type: text/plain; charset=utf-8');


try {
   
    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    error_log("en subirarchivos");
    if (

      //  error_log("en subiraerchiuvo");

        !isset($_FILES['upfile']['error']) ||
        is_array($_FILES['upfile']['error'])

       
    ) {
        //throw new RuntimeException('Invalid parameters.');
        error_log("en subirarchivos, parametros invalidos");
    }

    // Check $_FILES['upfile']['error'] value.
    switch ($_FILES['upfile']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            //throw new RuntimeException('No file sent.');
            error_log("en subirarchivos, no se envio ningun archivo");
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            //throw new RuntimeException('Exceeded filesize limit.');
            error_log("en subirarchivos se excedio el tamaño limite del archivo");
        default:
            //throw new RuntimeException('Unknown errors.');
            error_log("en subirarchivos , errores desconocidos");
    }

    // You should also check filesize here.
    if ($_FILES['upfile']['size'] > 1000000) {
        throw new RuntimeException('Exceeded filesize limit.');
    }

    // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
    // Check MIME Type by yourself.
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
        $finfo->file($_FILES['upfile']['tmp_name']),
        array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
        ),
        true
    )) {
        throw new RuntimeException('Invalid file format.');
    }

    // You should name it uniquely.
    // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
    // On this example, obtain safe unique name from its binary data.
    if (!move_uploaded_file(
        $_FILES['upfile']['tmp_name'],
        sprintf('./uploads/%s.%s',
            sha1_file($_FILES['upfile']['tmp_name']),
            $ext
        )
    )) {
        throw new RuntimeException('Failed to move uploaded file.');
    }

    return 'File is uploaded successfully.';

} catch (RuntimeException $e) {

    return $e->getMessage();

}
    }//termina funcion
/**
 * Moves the uploaded file to the upload directory and assigns it a unique name
 * to avoid overwriting an existing uploaded file.
 *
 * @param string $directory The directory to which the file is moved
 * @param UploadedFileInterface $uploadedFile The file uploaded file to move
 *
 * @return string The filename of moved file
 */
function moveUploadedFile()
{ 

    require 'clsArchivosUtils.php';

    $archivo =new clsArchivosUtils;

    error_log(" dentro de moveUploadedFile ");

    
    
    //error_log(" valor de extension " . $extension);

    // see http://php.net/manual/en/function.random-bytes.php
    //$basename = bin2hex(random_bytes(8));

    //error_log(" valor de basename " . $basename);

    //$filename = sprintf('%s.%0.8s', $basename, $extension);

    //error_log(" valor de filename " . $filename);
    //print_r($_FILES);
    //print_r($_POST);
    $directory = $_POST['directorio'];

    $incidenteId = $_POST['incidenteId'];


    error_log(" valor de directory " . $directory);
    //////////////////////////////////////////////

    $datosDeLNombre =$_FILES['file']['name'];

    error_log(">>>>> valor de FILES['file']['name']" . $_FILES['file']['tmp_name']);

    $ext = explode( ".",$datosDeLNombre) ;

    $extension = $ext[1];

   /*---------------------------------------------------------------------*/
    // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
    // Check MIME Type by yourself.
    // https://www.php.net/manual/es/function.mime-content-type.php
    
   /* $finfo = new finfo(FILEINFO_MIME_TYPE);
    if (false === $ext = array_search(
        $finfo->file($_FILES['file']['tmp_name']),
        array(
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'pdf' => 'application/pdf'
        ),
        true
    )) {
        throw new RuntimeException('Invalid file format.');
    }*/


   // $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
   $diractual =  getcwd();

   $directorioParaSubirArchivos = $diractual .  $directory;

   error_log("  getcwd : " .  $diractual );
    

   $filename =  sha1_file($_FILES['file']['tmp_name']);

   if (!move_uploaded_file(
    $_FILES['file']['tmp_name'],
    sprintf( $diractual .  $directory  .'/%s.%s',
             $filename,
             $extension)
   )) {
       //throw new RuntimeException('Failed to move uploaded file.');
   }

  /*---------------------------------------------------------------------*/
    $nombreArchivo = $filename .'.'.$extension;
    /*************************************************/
    // guardamos en la base de datos

    $datos=[

        'incidenteId' => $incidenteId,
        'nombreOriginal' => $_FILES['file']['name'],
       
        'ext'            => $extension,

        'nombreinterno'  =>  $nombreArchivo ,
        'directorio'     => $directory

    ];

   

    /********************************************** */
    $idRegistro =   $archivo->crearRegistro( $datos);
    $respuesta = ['nombreArchivo'=>$nombreArchivo, 'idRegistro' => $idRegistro];

    
    return json_encode($respuesta);
}

}//termina clase


/*
Fatal error: Uncaught Error: 
Class 'finfo' not found in /home/aisosmx/api.aldeasinfantiles.mx/apialdeas/apidatos/subirarchivos/clsSubirArchivos.php:129
 Stack trace: #0 /home/aisosmx/api.aldeasinfantiles.mx/apialdeas/index.php(143): 
 clsSubirArchivos->moveUploadedFile() 
 #1 /home/aisosmx/api.aldeasinfantiles.mx/apialdeas/vendor/slim/slim/Slim/Handlers/Strategies/RequestResponse.php(43):
  {closure}(Object(Slim\Psr7\Request),
   Object(Slim\Psr7\Response), Array)
    #2 /home/aisosmx/api.aldeasinfantiles.mx/apialdeas/vendor/slim/slim/Slim/Routing/Route.php(381): Slim\Handlers\Strategies\RequestResponse->__invoke(Object(Closure), Object(Slim\Psr7\Request), Object(Slim\Psr7\Response), Array) #3 /home/aisosmx/api.aldeasinfantiles.mx/apialdeas/vendor/slim/slim/Slim/MiddlewareDispatcher.php(81): Slim\Routing\Route->handle(Object(Slim\Psr7\Request)) #4 /home/aisosmx/api.aldeasinfantiles.mx/apialdeas/vendor/slim/slim/Slim/MiddlewareDispatcher.php(81): Slim\MiddlewareDispatcher->handle(Object(Slim\Psr7\Request)) #5 /home/aisosmx/api.aldeasinf in /home/aisosmx/api.aldeasinfantiles.mx/apialdeas/apidatos/subirarchivos/clsSubirArchivos.php on line 129


 */
?>