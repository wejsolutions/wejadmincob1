<?php 
require '../../../cfg/base.php';
if(isset($_POST['archivo'])){
    $ruta = '../../../app/varios/vst/ArchivosDeAnalizador/'.$_POST['archivo'];
	unlink($ruta);
    $res = $mvarios->ArchiAnaliDelete($_POST['archi_ide']);
}
?>