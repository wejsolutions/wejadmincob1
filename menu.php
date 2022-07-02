<!-- PARA INICIAR EL CHAT EN MENU-->
<style type="text/css">
	.chatgloss {
		display: none !important;
	}
	.chatear:hover .chatgloss {
		display: block !important;
	}
</style>
<li class="light-green">
	<a href="inicio">
		<i class="fa fa-home fa-lg"></i> 
		<span class="hidden-480">Inicio</span>
	</a>
</li>
<!-- FIN PARA EL CHAT-->
<?php foreach($musuarios->modulos($s_tius_ide) as $m): ?>
	<li class="light-green">
		<a class="dropdown-toggle" href="#" data-toggle="dropdown">
			<i class="fa fa-<?php echo $m->modu_icono; ?> fa-lg"></i> 
			<?php echo $m->modu_descrip ?>
			<i class="icon-caret-down"></i>
		</a>
		<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
			<?php foreach($musuarios->submodulos($s_tius_ide,$m->modu_ide) as $s): ?>
				<li>
					<a href="?var=<?php echo base64_encode($s->sumo_ide) ?>">
						<i class="fa fa-<?php echo $s->sumo_icono; ?>"></i>
						<span class="hidden-480"><?php echo $s->sumo_descrip ?></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</li>
<?php endforeach; ?>
<!-- Configuración de usuario -->
<li class="light-green chatear">
	<a href="" data-toggle="dropdown" class="dropdown-toggle">
		<i class="icon-comments-alt"></i> Chat
		<span class="icon-caret-down icon-only smaller-90"></span>
	</a>
	<ul class="chatgloss user-menu pull-left dropdown-purple dropdown-menu dropdown-caret dropdown-close">
		
	</ul>
</li>
<li class="light-green">
	<a class="dropdown-toggle" href="#" data-toggle="dropdown">
		<img class="nav-user-photo" alt="" src="<?php echo $cusuarios->picture($s_clien_ide).'?'.rand(1,1000) ?>">
		<span class="user-info">
			<small>Hola,</small>
			<?php echo $s_clien_nombre1 ?>
		</span>
		<i class="icon-caret-down"></i>		
	</a>
	<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
		<!--<li>
			<a href="#">
				<i class="icon-cog"></i>
					Configuración
			</a>
		</li>-->
		<li>
			<a href="?gvar=1">
				<i class="icon-user"></i>
				Perfil
			</a>
		</li>
		<li class="divider"></li>
		<li>
			<a href="logout">
				<i class="icon-off"></i>
				Salir
			</a>
		</li>
	</ul>
</li>
<!-- Session Inactiva 1 Hora = 3600 Seg-->
<script> $.idle(3600, function() {window.location.href = "tiempo.php"; }); </script>