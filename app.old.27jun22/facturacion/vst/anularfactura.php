<?php require '../../../cfg/base.php'; ?>
<?php foreach($mfacturacion->poridefact($ide) as $r): ?>
	<form action="" class="op2 form-horizontal">
		<?php echo $fn->modalHeader('ANULAR FACTURA') ?>
		<div class="modal-body">
			<div class="alert alert-danger">¿Realmente desea ANULAR la factura seleccionada?</div>
			<div class="msj"></div>
			<div class="form-group">
				<label for="" class="control-label col-sm-3 bolder">Factura:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="des1" value="<?php echo $r->fact_ide_tienda ?>" disabled>
				</div>
				<label for="" class="control-label col-sm-3 bolder">Cliente:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="des2" value="<?php echo $r->clien_tipcli.'-'.$r->clien_numiden.' '.$r->clien_nombre1.' '.$r->clien_nombre2.' '.$r->clien_apelli1.' '.$r->clien_apelli2 ?>" disabled>
				</div>
				<label for="" class="control-label col-sm-3 bolder">Fecha:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="des3" value="<?php echo date('d-m-Y',strtotime($r->fact_fecha)) ?>" disabled>
				</div>
				<label for="" class="control-label col-sm-3 bolder">Monto Total:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="des4" value="<?php echo number_format($r->fact_total_general,2,",",".") ?>" disabled>
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
				$.post('prc-mfacturacion-anularfact',$(formulario).serialize(),function(data){
						load('vst-facturacion-listafactura','','.lista');
						alert('Factura ANULADA correctamente');
						cerrarmodal();
				})
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>