<?php require '../../../cfg/base.php'; ?>
<?php $row = $mmarca->poride($marca_ide); ?>
<?php $var = $cmarca->setValue() ?>
<select name="mar" id="mar" class="chosen">
	<?php if(!empty($pais_ide)>0): ?>
		<option value=""></option>
		<?php foreach($row as $r): ?>
			<option value="<?php echo $r->marca_ide ?>" <?php echo $fn->select($r->marca_ide,$var) ?>><?php echo $r->marca_descrip ?></option>
		<?php endforeach; ?>
		<script>
			$('#marcaadd').prop('disabled','');
		</script>
	<?php else: ?>
		<option value="">Indique País</option>
		<script>
			$('#marcaadd').prop('disabled','disabled');
		</script>
	<?php endif; ?>
</select>
<script>
	$(function(){
		$('.chosen').chosen();
	})
</script>