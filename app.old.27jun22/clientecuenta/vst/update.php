<?php require '../../../cfg/base.php'; 
?>
<?php foreach($mclientecuenta->cuentas_poride($ide) as $r): ?>
	<form action=""  class="opCuentaBanco form-horizontal">
		<?php echo $fn->modalHeader('Editar Numero de Cuenta del Banco') ?>
		<div class="modal-body">
			<div class="msj_modal"></div>
			<div class="form-group">
				<label for="" class="control-label col-sm-3 bolder">Cuenta:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="cta" value="<?php echo $r->ctecue_cuenta ?>">
				</div>
			</div>
		</div>
		<?php echo $fn->modalFooter(1) ?>
		<input type="hidden" class="form-control" name="ide" value="<?php echo $r->ctecue_ide ?>">
	<!-- 	<input type="text" class="form-control" name="clien_ide2" value="<?php //echo $r->ctecue_clien_ide ?>"> -->
	</form>
<?php endforeach; ?>
<script>
	$(function(){
		var formulario = '.opCuentaBanco';
		$(formulario).validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				cta: {
					required: true,
				}
			},

			messages: {
				cta: {
					required: 'Obligatorio',
				}
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
				var f_clien_ide = $('#clien_ide2').val();

				$.post('prc-mclientecuenta-update_cuenta',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {

						load('vst-clientecuenta-lista','clien_ide=<?php echo $r->ctecue_clien_ide ?>','.cuentas');
						alert('Numero de cuenta modificado exitosamente.');

						alerta('.msj_modal','success','Registro modificado correctamente');
					} else {
						alerta('.msj_modal','danger',data)
					}
				})
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>