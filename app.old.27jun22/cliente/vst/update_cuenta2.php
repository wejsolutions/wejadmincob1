<?php require '../../../cfg/base.php'; 
var_dump($ide);

 //var_dump($ide);
$row_cuentas=$mcliente->cuentas($ide);?>

<?php foreach($row_cuentas as $r): ?>
	<form action="" class="fcuenta_cliente form-horizontal">
		<?php echo $fn->modalHeader('Editar Cuenta del Cliente.....') ?>
		<div class="modal-body">
			<div class="msj"></div>
			<div class="form-group">
				<label for="" class="control-label col-sm-3 bolder">Cuenta:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="cta" value="<?php echo $r->cuenta ?>">
				</div>
			</div>
		</div>
		<?php echo $fn->modalFooter(1) ?>
		<input type="text" class="form-control" name="ide" value="<?php echo $r->ide ?>">
	</form>
<?php endforeach; ?>
<script>
	$(function(){
		var formulario = '.fcuenta_cliente';
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
				$.post('prc-mcliente-update_cuenta',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {
						load('vst-cliente-cliente.cuenta','','.cuentas');
						alerta('.msj','success','Registro modificado correctamente');
					} else {
						alerta('.msj','danger',data)
					}
				})
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>