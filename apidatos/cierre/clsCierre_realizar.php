<?php 

class clsCierre_realizar { 
 
    public function getcierre($datos){ 

        $cierre = DB::update('incidente',
         [
             'textocierre' => $datos['textocierre'],
             'estado' => 'cerrado',
             'coloretapatres'=>'green',
             'coloretapacuatro'=>'green'
         ],"id=%i",$datos['id'] );

         $data = array('msg' => 'ok');
   
         return json_encode($data);

    }

}
