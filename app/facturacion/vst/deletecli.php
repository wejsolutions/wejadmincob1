<?php require '../../../cfg/base.php'; 
echo $fn->modalWidth('80%');
$row = $mcliente->poride($clien_ide);
?>
<form action="" class="op-delete-cliente">
	<?php echo $fn->modalHeader('Borrar cliente') ?>
	<div class="modal-body">
		<div class="alert alert-info">¿Realmente desea borrar el cliente seleccionado?<br><small><strong>Nota:</strong> Ésta operación eliminará todo los registros creados para el cliente</small></div>
		<div class="msj4"></div>
		<div class="table-responsive">
			<table class="table table-bordered">
				<tr>
					<th class="active text-right">Número de Identificación:</th>
					<td><?php echo $row[0]->clien_tipcli.'-'.$row[0]->clien_numiden ?></td>
					<th class="active text-right">Apellidos y Nombres:</th>
					<td><?php echo $row[0]->clien_apelli1.' '.$row[0]->clien_apelli2.', '.$row[0]->clien_nombre1.' '.$row[0]->clien_nombre2 ?></td>
				</tr>
				<tr>
					<th class="active text-right">Fecha de Nacimiento:</th>
					<td><?php echo date('d-m-Y',strtotime($row[0]->clien_fecnaci)); ?> (<?php echo $ccliente->edad($row[0]->clien_fecnaci); ?>)</td>
				</tr>
				<tr>
					<th class="active text-right">Teléfono Móvil:</th>
					<td><?php echo $row[0]->clien_telmovi ?></td>
				</tr>
				<tr>
					<th class="active text-right">Dirección de Habitación:</th>
					<td><?php echo $row[0]->clien_direcci ?></td>
				</tr>
			</table>
		</div>
	</div>
	<?php echo $fn->modalFooter(1) ?>
	<input type="hidden" name="ide" value="<?php echo $row[0]->clien_ide ?>">
</form>
<script>
	$(function(){
		var formulario = '.op-delete-cliente';
		$(formulario).validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				
			},

			messages: {
				
			},

			invalidHandler: function (event, validator) { //display error alert on form submit   
				$('.alert-danger', $(formulario)).show();
			},

			highlight: function (e) {
				$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
			},

			success: function (e) {
				$(e).closest('.form-group').removeClass('has-error').addClass('has-info');
				$(e).remove();
			},

			submitHandler: function (form) {
				if(confirm('Confirme nuevamente la decisión de eliminar un cliente')==true) {
					$.post('prc-mcliente-delete',$(formulario).serialize(),function(data){
						if(data==1) {
							alert('El cliente fue eliminado satisfactoriamente')
							location.reload();
						} else {
							alerta('.msj4','danger',data)
						}
					})
				}
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>