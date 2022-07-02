<?php require '../../../cfg/base.php'; ?>
<?php $row = $mbanco->poride($banco_ide); ?>
<?php $var = $cbanco->setValue() ?>
<select name="mar" id="mar" class="chosen">
	<?php if(!empty($pais_ide)>0): ?>
		<option value=""></option>
		<?php foreach($row as $r): ?>
			<option value="<?php echo $r->banco_ide ?>" <?php echo $fn->select($r->banco_ide,$var) ?>><?php echo $r->banco_descrip ?></option>
		<?php endforeach; ?>
		<script>
			$('#bancoadd').prop('disabled','');
		</script>
	<?php else: ?>
		<option value="">Indique País</option>
		<script>
			$('#bancoadd').prop('disabled','disabled');
		</script>
	<?php endif; ?>
</select>
<script>
	$(function(){
		$('.chosen').chosen();
	})
</script>