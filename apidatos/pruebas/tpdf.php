<?php
  $file = 'https://apialdeasproteccioninfantil2.azurewebsites.net/uploads/medidasintegrales/2639b73f65094a925b7c29f2af79a6f8269ecd9a.pdf';
  $filename = 'filename.pdf';
  header('Content-type: application/pdf');
  header('Content-Disposition: inline; filename="' . $filename . '"');
  header('Content-Transfer-Encoding: binary');
  header('Accept-Ranges: bytes');
  @readfile($file);
?>