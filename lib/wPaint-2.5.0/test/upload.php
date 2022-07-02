<?php

$image = imagecreatefrompng($_POST['image']);
#$id = uniqid();
$id = $_GET['paci_ide'].'_'.$_GET['marca'];
imagealphablending($image, false);
imagesavealpha($image, true);
imagepng($image, 'uploads/wPaint-' . $id . '.png');

// return image path
echo '{"img": "/test/uploads/wPaint-' . $id . '.png"}';
