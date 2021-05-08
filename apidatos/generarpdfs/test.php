<?php 





require ('clsGenerarReporteInicial.php');



$reporte = new clsGenerarReporteInicial;
$id = 13;
$reporte->generarReporteInicial($id);