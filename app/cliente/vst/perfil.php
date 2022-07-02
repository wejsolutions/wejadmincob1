<?php require '../../../cfg/base.php'; 
$row = $mcliente->poride($clien_ide);
$row_permisos = $mpermfich->lista_fichas_permitidas($s_tius_ide);
//print_r($row_permisos);
?>
<div class="btn-group navegacion-cliente-fijo">
	<a class="btn btn-link tooltip-error ficha-search" href="#"  data-rel="tooltip" data-original-title="Buscar" data-placement="bottom">
		<i class="fa fa-search fa-2x"></i>
	</a>
	<?php foreach($row_permisos as $rp): ?>
		<a class="btn btn-link tooltip-error ficha-open" href="#ancla-<?php echo $rp->fich_ide; ?>" info="#ficha-<?php echo $rp->fich_ide; ?>"  data-rel="tooltip" data-original-title="<?php echo $rp->fich_descrip ?>" data-placement="bottom">
			<i class="fa fa-<?php echo $rp->fich_icono; ?> fa-2x"></i>
		</a>
	<?php endforeach; ?>
</div>

<?php foreach($row_permisos as $rp): ?>
	<div id="ficha-<?php echo $rp->fich_ide; ?>"></div><div class="clearfix"></div>
	<div id="ancla-<?php echo $rp->fich_ide; ?>"></div>
<?php endforeach; ?>
<script>
	<?php foreach($row_permisos as $rp): ?>
		load('<?php echo $rp->fich_url; ?>','clien_ide=<?php echo $clien_ide ?>&fich_ide=<?php echo $rp->fich_ide ?>','#ficha-<?php echo $rp->fich_ide; ?>');
	<?php endforeach; ?>
	
	$(function(){
		$('[data-rel=tooltip]').tooltip();
		$('.navegacion-cliente-fijo>.ficha-open').on('click',function(){
			var capa = $(this).attr('info');
			$('.widget-box').addClass('collapsed');
			$(capa+' [data-action=collapse]').click();
		})
		$('.ficha-search').on('click',function(){
			$('.widget-box').addClass('collapsed');
		})
	})
</script>