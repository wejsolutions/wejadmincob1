<?php require '../../../cfg/base.php'; ?>
<?php //echo "Producto ID: ". $_SESSION['s_deta_produc_ide'];?>
<form action="" class="detpro form-horizontal">

	<fieldset>
	<div class="form-actions clearfix">
		<div class="msj"></div>
		<div class="form-group">

			<label for="" class="control-label col-sm-3 bolder">IMEI:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="imei">
			</div>

			<label for="" class="control-label col-sm-3 bolder">Serial Numero:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="seri">
			</div>
		</div>
		<input type="hidden" name="produc_ide" value="<?php echo $_SESSION['s_deta_produc_ide'] ?>">
		<button class="btn btn-primary btn-sm pull-right"><span class="i fa fa-check"></span> Guardar Cambios</button>
	</div>
	</fieldset>

</form>
<script>
	$(function(){
		var formulario = '.detpro';
		$(formulario).validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				imei: {
					required: false,
				},
				seri: {
					required: false,
				}
			},

			messages: {
				imei: {
					required: 'Obligatorio',
				},
				seri: {
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
				$.post('prc-mdetaprod-insert',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {
						load('vst-detaprod-lista','','.lista');
						load('vst-detaprod-insert','','.insertar');
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