<?php require 'cfg/base.php'; ?>
<?php $cusuarios->redirectLogin(); ?>
<?php $rowt=$mtienda->poride($_SESSION['s_usua_tienda']); 
/*echo '<pre>';
var_dump($_SESSION['s_usua_tienda']);
echo '</pre>';*/
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>WEJ Solutions</title>
		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
		<?php require 'css/ace.php'; ?>
		<?php require 'js/ace.php'; ?>	
	</head>

	<body>
		<div class="bootbox modal fade in" role="dialog" id="modal"  tabindex="-1" aria-hidden="false">
			<div class="modal-dialog">
				<div class="modal-content"></div>
			</div>
		</div>	
		<div id="navbar" class="navbar navbar-default" style="background:#64930D">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>
			
			<div class="col-sm-12" style="background:#006400">
				<div class="clearfix"></div>
				<div class="space-4"></div>
				<img src="img/logo.png" align="" class="pull-left" height="125 px">	
				<h1 class="pull-left" style="padding-left:30px">
					<span class="white"><?php echo "SOFTWARE" ?></span>
					<span class="white"><?php echo "ADMINISTRATIVO" ?></span>
					<div class="space-12"></div>
					<span class="white"><?php echo $rowt[0]->empresa_nombre ?></span>
					<span class="white"><?php echo "RIF: ".$rowt[0]->empresa_rif ?></span>
				</h1>
				<img src="img/<?php echo $rowt[0]->empresa_logo ?>" align="" class="pull-right" height="125 px">	
				<div class="clearfix"></div>
				<div class="space-4"></div>
			</div>

			<div id="navbar-container" class="navbar-container">
				<div class="navbar-header pull-left">
					<!--<a class="navbar-brand" href="inicio"><small><i class="icon-leaf"></i> Cirugía Plástica</small></a>-->
				</div>
			        <div class="navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav"><?php require 'menu.php'; ?></ul>
				</div>
			</div>
		</div>
		<div id="main-container" class="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>
			<div class="main-container-inner">
				<div class="page-content">
					<?php require 'contenido.php'; ?>
				</div>
			</div>
			<a id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse" href="#">
				<i class="icon-double-angle-up icon-only bigger-110"></i>
			</a>
		</div>
	</body>
</html>