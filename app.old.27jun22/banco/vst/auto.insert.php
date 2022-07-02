<?php require '../../../cfg/base.php'; ?>
<form action="" class="op1 form-horizontal">
	<?php echo $fn->modalHeader('Agregar Identificador') ?>
	<div class="modal-body">
		<div class="msj"></div>
		<div class="form-group">
			<label for="" class="control-label col-sm-3 bolder">Banco:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="des" value="<?php echo $des ?>">
			</div>
		</div>
	</div>
	<?php echo $fn->modalFooter(1) ?>
	<input type="hidden" name="pais" value="<?php echo $pais_ide ?>">
</form>
<script>
	$(function(){
		var formulario = '.op1';
		$(formulario).validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				des: {
					required: true,
				}
			},

			messages: {
				des: {
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
				$.post('prc-mnacional-insert',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {
						var direccion = '<?php echo (isset($direccion)) ? $direccion : "" ?>';
						if (direccion=='') {
							load('vst-nacional-select','pais_ide=<?php echo $pais_ide ?>&des='+data.trim(),'#naciona');
						} else {
							load('vst-nacional-select_1','pais_ide=<?php echo $pais_ide ?>&des='+data.trim(),'#naciona-acom');
						}
						cerrarmodal();
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