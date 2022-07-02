<?php require '../../../cfg/base.php'; ?>
<?php foreach($mnotaentre->poridenoen($ide) as $r): ?>
	<form action="" class="op2 form-horizontal">
		<?php echo $fn->modalHeader('ANULAR NOTA DE ENTREGA') ?>
		<div class="modal-body">
			<div class="alert alert-danger">¿Realmente desea ANULAR la nota de entrega seleccionada?</div>
			<div class="msj"></div>
			<div class="form-group">
				<label for="" class="control-label col-sm-3 bolder">Nota de Entrega:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="des1" value="<?php echo $r->noen_ide_tienda ?>" disabled>
				</div>
				<label for="" class="control-label col-sm-3 bolder">Cliente:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="des2" value="<?php echo $r->clien_tipcli.'-'.$r->clien_numiden.' '.$r->clien_nombre1.' '.$r->clien_nombre2.' '.$r->clien_apelli1.' '.$r->clien_apelli2 ?>" disabled>
				</div>
				<label for="" class="control-label col-sm-3 bolder">Fecha:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="des3" value="<?php echo date('d-m-Y',strtotime($r->noen_fecha)) ?>" disabled>
				</div>
				<label for="" class="control-label col-sm-3 bolder">Monto Total:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="des4" value="<?php echo number_format($r->noen_total_general,2,",",".") ?>" disabled>
				</div>
			</div>
		</div>
		<?php echo $fn->modalFooter(1) ?>
		<input type="hidden" class="form-control" name="ide" value="<?php echo $r->noen_ide ?>">
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
				$.post('prc-mnotaentre-anularnoen',$(formulario).serialize(),function(data){
						load('vst-notaentre-listanotaentre','','.lista');
						alert('Nota de Entrega ANULADA correctamente');
						cerrarmodal();
				})
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>