<?php require '../../../cfg/base.php'; ?>
<?php $row = $mtipclien->poride($tipcli_ide); ?>
<?php $var = $ctipclien->setValue() ?>
<select name="tipcli" id="tipcli" class="chosen">
	<?php if(!empty($tipcli_ide)>0): ?>
		<option value=""></option>
		<?php foreach($row as $r): ?>
			<option value="<?php echo $r->tipcli_ide ?>" <?php echo $fn->select($r->tipcli_ide,$var) ?>><?php echo $r->tipcli_descrip ?></option>
		<?php endforeach; ?>
	<?php else: ?>
		<option value="">Indique Tipo de Cliente</option>
		<script>
			$('#nacionaladd').prop('disabled','disabled');
		</script>
	<?php endif; ?>
</select>
<script>
	$(function(){
		$('.chosen').chosen();
	})
</script>