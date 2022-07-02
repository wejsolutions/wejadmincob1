<?php require '../../../cfg/base.php'; 
echo $fn->modalWidth('80%');
$row = $mproducto->poride($produc_ide);
?>
<form action="" class="op-delete-producto">
	<?php echo $fn->modalHeader('Borrar producto') ?>
	<div class="modal-body">
		<div class="alert alert-danger">¿Realmente desea borrar el producto seleccionado?<br><small><strong>Nota:</strong> Ésta operación eliminará todo los registros creados para el producto</small></div>
		<div class="msj4"></div>
		<div class="table-responsive">
			<table class="table table-bordered">
				<tr>
					<th class="active text-right">Código:</th>
					<td><?php echo $row[0]->produc_codigo ?></td>
					<th class="active text-right">Descripción:</th>
					<td><?php echo $row[0]->produc_descrip ?></td>
				</tr>
				<tr>
					<th class="active text-right">Marca:</th>
					<td><?php echo $row[0]->produc_marca; ?></td>
					<th class="active text-right">Existencia:</th>
					<td><?php echo $row[0]->produc_existen ?></td>
				</tr>
				<tr>
					<th class="active text-right">¿Es Servicio?:</th>
					<td><?php if ($row[0]->produc_servicio==0) echo 'No'; ?>
						<?php if ($row[0]->produc_servicio==1) echo 'Si'; ?></td>
					<th class="active text-right">Tienda:</th>
					<td><?php echo $row[0]->empresa_nombre ?></td>
				</tr>
			</table>
		</div>
	</div>
	<?php echo $fn->modalFooter(1) ?>
	<input type="hidden" name="ide" value="<?php echo $row[0]->produc_ide ?>">
</form>
<script>
	$(function(){
		var formulario = '.op-delete-producto';
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
				if(confirm('Confirme nuevamente la decisión de eliminar un producto')==true) {
					$.post('prc-mproducto-delete',$(formulario).serialize(),function(data){
						if(data==1) {
							alert('El producto fue eliminado satisfactoriamente')
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