<?php require '../../../cfg/base.php'; ?>
<?php $row = $munidmed->poride($unidmed_ide); ?>
<?php $var = $cunidmed->setValue() ?>
<select name="mar" id="mar" class="chosen">
	<?php if(!empty($pais_ide)>0): ?>
		<option value=""></option>
		<?php foreach($row as $r): ?>
			<option value="<?php echo $r->unidmed_ide ?>" <?php echo $fn->select($r->unidmed_ide,$var) ?>><?php echo $r->unidmed_descrip ?></option>
		<?php endforeach; ?>
		<script>
			$('#unidmedadd').prop('disabled','');
		</script>
	<?php else: ?>
		<option value="">Indique País</option>
		<script>
			$('#unidmedadd').prop('disabled','disabled');
		</script>
	<?php endif; ?>
</select>
<script>
	$(function(){
		$('.chosen').chosen();
	})
</script>