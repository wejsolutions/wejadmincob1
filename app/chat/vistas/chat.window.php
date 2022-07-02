<?php
ini_set('display_errors', '0');
session_start();
error_reporting(0);
require '../../../cfg/conexion_chat.php';
if(!isset($_SESSION['s_clien_ide'])) {
    echo '<script>location.reload()</script>';
}
//print_r($_SESSION);
//Conexion y sql
$res=new conectar;
//$sql = "SELECT * FROM selectusuariosactivoschat where usuario_chat=1 and pers_cedrif != '".strtoupper($_SESSION['cedula'])."'";
$sql = "SELECT * FROM vw_usuarios WHERE usua_clien IS NOT null AND usua_visible=1";
$usuario=$res->sentencia($sql);
//print_r($usuario);
?>

<!-- Chat -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        
        <link rel="shortcut icon" href="img/favicon.png" />
        <meta name="Sistema de historias medicas" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link type="text/css" rel="stylesheet" media="all" href="../../../lib/chat/css/chat.css" />
        <link type="text/css" rel="stylesheet" media="all" href="../../../lib/chat/css/screen.css" />
    </head>
    <body>	
    		<div class="col-xs-3">
	    		<div class="sidebar" id="sidebar">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>
		    		<ul class="nav nav-list">
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
					<div class="divider"></div>
					<li>
						<a href="">
							<span class="menu-text" onclick="window.close()"><i class="fa fa-times"></i> Cerrar</span>
						</a>
					</li>
		    		</ul>  
		    	</div>
		 </div>
    </body>
</html>