<?php require '../../../cfg/base.php'; ?>
<?php $nivel = $mtipousua->poride($tius_ide) ?>
<?php echo $fn->modalHeader('Editar permisos de Ficha: '.$nivel[0]->tius_descrip) ?>
<div class="modal-body">
	<div class="lista2"></div>
</div>
<?php echo $fn->modalFooter(2); ?>
<script>
	load('vst-permfich-lista','tius_ide=<?php echo $tius_ide ?>','.lista2');
</script>