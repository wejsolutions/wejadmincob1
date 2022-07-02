<?php
ini_set('display_errors', '0');
session_start();
error_reporting(0);
require '../../../cfg/conexion_chat.php';
if(!isset($_SESSION['s_clien_ide'])) {
	echo '<script>location.reload()</script>';
}

//Conexion y sql
$res=new conectar;
//$sql = "SELECT * FROM selectusuariosactivoschat where usuario_chat=1 and pers_cedrif != '".strtoupper($_SESSION['cedula'])."'";
$sql = "SELECT * FROM vw_usuarios WHERE usua_clien IS NOT null AND usua_visible=1";
$usuario=$res->sentencia($sql);
//print_r($usuario);
?>
<link type="text/css" rel="stylesheet" media="all" href="lib/chat/css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="lib/chat/css/screen.css" />
<!-- Chat -->

<?php if(count($usuario)>0) { ?>  
	<?php while($chat = mysql_fetch_array($usuario)) { ?>
		<?php $nomb = explode(" ",$chat['usua_login']); ?>					
		<li>
			<a href="javascript:void(0)" onclick="javascript:chatWith('<?php echo $chat["usua_login"]; //$listausu->pers_cedrif; ?>')">
				<i class="fa fa-user green"></i>
				<span class="menu-text"><small><?php echo $nomb[0].'-('.$chat['usua_login'].')'; ?></small></span>
			</a>
		</li>
	<?php } ?>
<?php } else { ?>
	<li>
		<a href="">
			<span class="menu-text">No hay Usuarios en Linea</span>
		</a>
	</li>
<?php } ?>
<!--<div class="divider"></div>
<li>
	<a href="">
		<span class="menu-text" onclick="javascript:popup('app/chat/vistas/chat.ventana.php',1000,350)"><i class="fa fa-expand"></i> Expandir</span>
	</a>
</li>-->
<script type="text/javascript">
	function popup(url,ancho,alto) {
		var posicion_x; 
		var posicion_y; 
		posicion_x=(screen.width/2)-(ancho/2); 
		posicion_y=(screen.height/2)-(alto/2); 
		window.open(url, "", "width="+ancho+",height="+alto+",menubar=0,toolbar=0,directories=0,scrollbars=no,resizable=no,left="+posicion_x+",top="+posicion_y+"");
	}
</script> 

