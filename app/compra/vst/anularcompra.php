<?php require '../../../cfg/base.php'; ?>
<?php foreach($mcompra->poridefact($ide) as $r): ?>
	<form action="" class="op2 form-horizontal">
		<?php echo $fn->modalHeader('ANULAR COMPRA') ?>
		<div class="modal-body">
			<div class="alert alert-danger">¿Realmente desea ANULAR la compra seleccionada?</div>
			<div class="msj"></div>
			<div class="form-group">
				<label for="" class="control-label col-sm-3 bolder">Compra:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="des" value="<?php echo $r->fact_ide ?>" disabled>
				</div>
			</div>
		</div>
		<?php echo $fn->modalFooter(1) ?>
		<input type="hidden" class="form-control" name="ide" value="<?php echo $r->fact_ide ?>">
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
				$.post('prc-mcompra-anularfact',$(formulario).serialize(),function(data){
						load('vst-compra-listacompra','','.lista');
						alert('Compra ANULADA correctamente');
						cerrarmodal();
				})
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>