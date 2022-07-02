<?php require '../../../cfg/base.php'; ?>
<?php $row = $mnacional->porpais($pais_ide); ?>
<?php $var = $cnacional->setValue() ?>
<?php $disabled =  $cnacional->disabled(); ?>
<select <?php echo $disabled ?> name="nac_acom" id="nac_acom" class="chosen">
	<?php if(!empty($pais_ide)>0): ?>
		<option value=""></option>
		<?php foreach($row as $r): ?>
			<option value="<?php echo $r->naci_ide ?>" <?php echo $fn->select($r->naci_ide,$var) ?>><?php echo $r->naci_descrip ?></option>
		<?php endforeach; ?>
		<script>
			$('#nacionaladd-acom').prop('disabled','');
		</script>
	<?php else: ?>
		<option value="">Indique País</option>
		<script>
			$('#nacionaladd-acom').prop('disabled','disabled');
		</script>
	<?php endif; ?>
</select>
<script>
	$(function(){
		$('.chosen').chosen();
	})
</script>