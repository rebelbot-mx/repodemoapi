<?php



trait trait_variableGrafica3{


   function generarVariable(
$lista_de_programas,
$data_ia,
$data_ic,
$data_ip
        ){

   $variable=<<<EOT
{
type: 'bar',
data: {
labels: [
[ $lista_de_programas ]
],
datasets: [
{label: 'Incidentes abiertos',
data:  [ $data_ia ] ,
backgroundColor: [
'rgba(255,0 ,0,.5)', 
'rgba(255,0 ,0,.5)',
'rgba(255,0 ,0,.5)',
'rgba(255,0 ,0,.5)',
'rgba(255,0 ,0,.5)',
'rgba(255,0 ,0,.5)',
'rgba(255,0 ,0,.5)',
'rgba(255,0 ,0,.5)'
],
borderColor: [
'#36495d',
'#36495d',
'#36495d',
'#36495d',
'#36495d',
'#36495d',
'#36495d',
'#36495d',
],
borderWidth: 3
},
{ 
label: 'Incidentes Cerrados',
data: [ $data_ic ],
backgroundColor: [
'rgba(0, 255,85,.5)',
'rgba(0, 255,85,.5)',
'rgba(0, 255,85,.5)',
'rgba(0, 255,85,.5)',
'rgba(0, 255,85,.5)',
'rgba(0, 255,85,.5)',
'rgba(0, 255,85,.5)',
'rgba(0, 255,85,.5)'
],
borderColor: [
'#47b784',
'#47b784',
'#47b784',
'#47b784',
'#47b784',
'#47b784',
'#47b784',
'#47b784',
],
borderWidth: 3
},
{
label: 'Incidentes Pendientes',
data: [ $data_ip ],
backgroundColor: [
'#FFFF00', 
'#FFFF00',
'#FFFF00',
'#FFFF00',
'#FFFF00',
'#FFFF00',
'#FFFF00',
'#FFFF00'
],
borderColor: [
'#FFFF00',
'#FFFF00',
'#FFFF00',
'#FFFF00',
'#FFFF00',
'#FFFF00',
'#FFFF00',
'#FFFF00',
],
borderWidth: 3
}
]
},
options: {
responsive: true,
lineTension: 1,
scales: {
yAxes: [{
ticks: {
beginAtZero: true,
padding: 25,
}
}]
}
}
}
EOT;

  return json_encode($variable); 


   }



}