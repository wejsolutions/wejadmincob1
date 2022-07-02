<?php require '../../../cfg/base.php'; ?>
<?php $row = $mimpuesto->poride($impuesto_ide); ?>
<?php $var = $cimpuesto->setValue() ?>
<select name="mar" id="mar" class="chosen">
	<?php if(!empty($pais_ide)>0): ?>
		<option value=""></option>
		<?php foreach($row as $r): ?>
			<option value="<?php echo $r->impuesto_ide ?>" <?php echo $fn->select($r->impuesto_ide,$var) ?>><?php echo $r->impuesto_descrip ?></option>
		<?php endforeach; ?>
		<script>
			$('#impuestoadd').prop('disabled','');
		</script>
	<?php else: ?>
		<option value="">Indique País</option>
		<script>
			$('#impuestoadd').prop('disabled','disabled');
		</script>
	<?php endif; ?>
</select>
<script>
	$(function(){
		$('.chosen').chosen();
	})
</script>