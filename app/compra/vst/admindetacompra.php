<?php require '../../../cfg/base.php'; ?>
<?php extract($_POST); ?>
<?php echo $fn->modalHeader('Detalle de Factura de Compra'); ?>
	<div class="modal-body">
		<div class="encabezado"></div>
		<div class="clearfix"></div>
		<div class="space-6"></div>
		<div class="contenido"></div>
	</div>
<script>
	load('vst-compra-datos.facturacompra','ide=<?php echo $ide; ?>','.encabezado');
	load('vst-compra-listacompraverificadeta','ide=<?php echo $ide; ?>','.contenido');
</script>