<?php 
# Admitir errores del sistema
error_reporting(E_ALL);
ini_set('display_error', '1');
ini_set("memory_limit","-1");
# Comprobar existencia de un usuario
if(!isset($_SESSION)) { session_start(); }
# Horario local
date_default_timezone_set('America/Caracas');
# Extracción de variables enviadas
extract($_POST);
extract($_GET);
extract($_SESSION);
?>