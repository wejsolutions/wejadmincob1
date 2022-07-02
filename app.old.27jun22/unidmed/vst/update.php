<?php require '../../../cfg/base.php'; ?>
<?php foreach($munidmed->poride($ide) as $r): ?>
	<form action="" class="op2 form-horizontal">
		<?php echo $fn->modalHeader('Editar Unidad de Medida') ?>
		<div class="modal-body">
			<div class="msj"></div>
			<div class="form-group">
				<label for="" class="control-label col-sm-3 bolder">Abreviatura:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="abv" value="<?php echo $r->unidmed_abrevia ?>">
				</div>
				<label for="" class="control-label col-sm-3 bolder">Medida:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="des" value="<?php echo $r->unidmed_descrip ?>">
				</div>
			</div>
		</div>
		<?php echo $fn->modalFooter(1) ?>
		<input type="hidden" class="form-control" name="ide" value="<?php echo $r->unidmed_ide ?>">
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
				$.post('prc-munidmed-update',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {
						load('vst-unidmed-lista','','.lista');
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