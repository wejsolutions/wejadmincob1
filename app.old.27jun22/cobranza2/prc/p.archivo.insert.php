<?php 
//require '../../../cfg/base.php';
require '../../../cfg/config.php';
require '../../../cfg/funciones.php';

$archivos = array(
        'cobranza'=>array('mCobranza','cCobranza')
    );
# Instanciación de clases
$fn = new Funciones();
foreach($archivos as $ind=>$val) {
    foreach($val as $file) {
        require '../../../app/'.$ind.'/cls/'.$file.'.php';
        $ins = strtolower($file);
        $$ins = new $file();
    }
}

extract($_POST);
if(isset($_FILES['file'])){
	$fechahora = date("Ymd His");
	$fechahoralegi = substr($fechahora,6,2).'-'.substr($fechahora,4,2).'-'.substr($fechahora,0,4).' a las '.substr($fechahora,9,2).':'.substr($fechahora,11,2).':'.substr($fechahora,13,2);
    $nombre = $fechahora.$_FILES['file']['name'];
    $temp   = $_FILES['file']['tmp_name'];
    $cliente = 1;
    $archidestino = 'BancoBicen_'.$fechahora.'.txt';
    $archidestino=str_replace(' ', '', $archidestino);
    $banco = 1;
    $res = $mcobranza->ArchiCobranzaInsert($cliente,$archidestino,'Cobranza Bicentenario',$banco,$temp);
}
?>