<?php 
require '../../../cfg/base.php'; 
$row_fich = $mpermfich->poride(3);
?>
<div class="col-sm-12 widget-container-span ui-sortable" id="ficha-<?php echo $row_fich[0]->fich_ide ?>-link">
	<div class="widget-box revival">
       <div class="widget-header widget-hea1der-small header-color-dark">
			<h6 class="bolder"><i class="fa fa-<?php echo $row_fich[0]->fich_icono; ?>"></i> <?php echo $row_fich[0]->fich_descrip; ?></h6>
			<div class="widget-toolbar">
				<a href="#" data-action="reload" onclick="load('<?php echo $row_fich[0]->fich_url ?>','fich_ide=<?php echo $row_fich[0]->fich_ide ?>&produc_ide=<?php echo $produc_ide ?>','#ficha-<?php echo $row_fich[0]->fich_ide ?>');">
					<i class="icon-refresh"></i>
				</a>
				<a href="#" data-action="collapse">
					<i class="icon-chevron-up"></i>
				</a>						
			</div>
		</div>

			<div class="insertar"></div>
			<div class="clearfix"></div>
			<div class="space-6"></div>
			<div class="lista"></div>
			<script>
				load('vst-detaprod-insert','','.insertar');
				load('vst-detaprod-lista','','.lista');
			</script>
	</div>
</div>
