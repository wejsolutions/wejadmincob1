<?php 
require 'cfg/base.php';
$clase = $_GET['clase'];
$metodo = $_GET['metodo'];
echo $$clase->$metodo();
?>