<?php require '../../../cfg/base.php'; ?>
<form action="" class="op1 form-horizontal">
	<?php echo $fn->modalHeader('Agregar Unidad de Medida') ?>
	<div class="modal-body">
		<div class="msj"></div>
		<div class="form-group">

			<label for="" class="control-label col-sm-3 bolder">Abreviatura:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="abv">
			</div>

			<label for="" class="control-label col-sm-3 bolder">Medida:</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="des">
			</div>
		</div>
	</div>
	<?php echo $fn->modalFooter(1) ?>
</form>
<script>
	$(function(){
		var formulario = '.op1';
		$(formulario).validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				abv: {
					required: true,
				},
				des: {
					required: true,
				}
			},

			messages: {
				abv: {
					required: 'Obligatorio',
				},
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
				$.post('prc-munidmed-insert',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {
						load('vst-unidmed-lista','','.lista');
						if(confirm('Registro agregado correctamente.\n¿Desea agregar otro registro?')==true) {
							$(formulario).each(function(){ this.reset() })
						} else {
							cerrarmodal();
						}
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