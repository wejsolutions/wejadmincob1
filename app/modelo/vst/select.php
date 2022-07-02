<?php require '../../../cfg/base.php'; ?>
<?php $row = $mmodelo->poride($modelo_ide); ?>
<?php $var = $cmodelo->setValue() ?>
<select name="mar" id="mar" class="chosen">
	<?php if(!empty($pais_ide)>0): ?>
		<option value=""></option>
		<?php foreach($row as $r): ?>
			<option value="<?php echo $r->modelo_ide ?>" <?php echo $fn->select($r->modelo_ide,$var) ?>><?php echo $r->modelo_descrip ?></option>
		<?php endforeach; ?>
		<script>
			$('#modeloadd').prop('disabled','');
		</script>
	<?php else: ?>
		<option value="">Indique País</option>
		<script>
			$('#modeloadd').prop('disabled','disabled');
		</script>
	<?php endif; ?>
</select>
<script>
	$(function(){
		$('.chosen').chosen();
	})
</script>