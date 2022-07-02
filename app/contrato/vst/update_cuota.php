<?php require '../../../cfg/base.php'; ?>

<?php foreach($mcontrato->cuota_poride($ide) as $r): ?>
	<form action="" class="op2 form-horizontal">
		<?php echo $fn->modalHeader('Editar Cuota') ?>
		<div class="modal-body">
			<div class="msj"></div>

			<div class="form-group">
				<label for="" class="control-label col-sm-3 bolder">Monto:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="mto" value="<?php echo $r->cuota_monto?>">
				</div>
			</div>

			<div class="form-group">
				<label for="" class="control-label col-sm-3 bolder">Cantidad de Fracciones:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="can" value="<?php echo $r->cuota_cant_fracc; ?>">
				</div>
			</div>


		</div>
		<?php echo $fn->modalFooter(1) ?>
		<input type="hidden" class="form-control" name="ide" value="<?php echo $r->cuota_ide ?>">
		<input type="text" class="form-control" name="contrato_ide" value="<?php echo $contrato_ide ?>">
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
				mot: {
					required: true,
				}
			},

			messages: {
				mto: {
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
				$.post('prc-mcontrato-cuotaupdate',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {

						modal('vst-contrato-listaCuotas','contrato_ide=<?php echo $contrato_ide ?>?>')
						//load('vst-contrato-listaCuotas','','.lista');
						//alerta('.msj','success','Cuota modificado correctamente');
						alert("Cuota actualizada");
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