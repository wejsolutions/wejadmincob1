<?php require '../../../cfg/base.php'; ?>
<?php foreach($mdetaprod->poride($ide) as $r): ?>
	<form action="" class="op2 form-horizontal">
		<?php echo $fn->modalHeader('Editar Elemento') ?>
		<div class="modal-body">
			<div class="msjupdate"></div>
			<div class="form-group">
				<label for="" class="control-label col-sm-3 bolder">Serial Numero:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="imei" value="<?php echo $r->detaprod_imei ?>">
				</div>
			</div>
		</div>
		<?php echo $fn->modalFooter(1) ?>
		<input type="hidden" class="form-control" name="ide" value="<?php echo $r->detaprod_ide ?>">
	</form>
<?php endforeach; ?>
<script>
	$(function(){
		var formulario = '.op2';
		$(formulario).validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				imei: {
					required: false,
				}
			},

			messages: {
				imei: {
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
				$.post('prc-mdetaprod-update',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {
						load('vst-detaprod-lista','','.lista');
						alerta('.msjupdate','success','Registro modificado correctamente');
					} else {
						alerta('.msjupdate','danger',data)
					}
				})
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>