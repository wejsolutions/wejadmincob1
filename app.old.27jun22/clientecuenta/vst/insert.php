<?php require '../../../cfg/base.php'; 
extract($_POST);
//var_dump($clien_ide);
?>
<form action="" class="opCuentaBancaria form-horizontal">
	<?php echo $fn->modalHeader('Agregar Cuenta Bancaria') ?>
	<div class="modal-body">
		<div class="msjcuentaBancaria"></div>
		<div class="form-group">
			<label for="" class="label control-label col-sm-3 bolder">Cuenta:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="cta">
			</div>
			<input type="hidden" class="form-control" name="clien_ide" value="<?php echo $clien_ide ?>">			
		</div>
		<div class="form-group">
			<label for="" class="label control-label col-sm-3 bolder">Banco</label>
			<div class="col-sm-9" id="banco_ide">
				<select class="form-control chosen" title="Banco" name="banco_ide" id="banco_ide">
					<option value=""></option>
					<?php foreach($mbanco->lista() as $p): ?>
						<option value="<?php echo $p->banco_ide ?>"><?php echo $p->banco_descrip ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
	</div>
	<?php echo $fn->modalFooter(1) ?>
</form>
<script>
	$(function(){
		var formulario = '.opCuentaBancaria';
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
				$.post('prc-mclientecuenta-insert',$(formulario).serialize(),function(data){
					alert(data);
					if(!isNaN(data)) {
						load('vst-clientecuenta-lista','clien_ide='+data,'.cuentas');

						if(confirm('Registro agregado correctamente.\n¿Desea agregar otro registro?')==true) {
							$(formulario).each(function(){ this.reset() })
						} else {
							cerrarmodal();
						}
					} else {
						alerta('.msjcuentaBancaria','danger',data)
					}
				})
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>