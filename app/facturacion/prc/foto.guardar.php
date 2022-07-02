<?php 
$ruta = '../../../img/fotos/'.$_GET['clien_ide'].'.jpeg';
if(move_uploaded_file($_FILES['webcam']['tmp_name'], $ruta)) {
	echo "Foto agregada correctamente.";
} else {
	echo 1;
}
?>