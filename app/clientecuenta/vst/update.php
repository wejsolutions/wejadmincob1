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
					<input type="text" class="form-control" onpaste="myFunction()" pattern="[0-9]+" placeholder="Número de Cuenta 20 Dígitos" name="cta" minlength="20" maxlength="20" required  value="<?php echo $r->ctecue_cuenta ?>" onkeypress="return solonumeros(event)"> 
				</div>
			</div>
		</div>
		<?php echo $fn->modalFooter(1) ?>
		<input type="hidden" class="form-control" name="ide" value="<?php echo $r->ctecue_ide ?>">
	<!-- 	<input type="text" class="form-control" name="clien_ide2" value="<?php //echo $r->ctecue_clien_ide ?>"> -->
	</form>
<?php endforeach; ?>

<!-- Valida Cuenta de Cliente solo numeros -->
<script type="text/javascript">
	function solonumeros(e){
		key=e.keyCode || e.which;
		teclado=String.fromCharCode(key);
		numero="0123456789";
		especiales="8-37-38-46";
		teclado_especial = false;
		for (var i in especiales){
			if(key==especiales[i])
			{
				teclado_especial=true;
			}
		}
		if(numero.indexOf(teclado)==-1 && !teclado_especial){
			return false;
		}

	}

function myFunction() {
	return false;
}

</script>

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