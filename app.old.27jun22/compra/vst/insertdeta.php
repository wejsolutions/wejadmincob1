<?php require '../../../cfg/base.php'; ?>
<div class="insertdeta">
<?php //echo "Producto ID: ". $_SESSION['s_idepro']." y Cantidad= ". $_SESSION['s_cantcarg']." de ".$_SESSION['s_cant'];?>

<form action="" class="detpro form-horizontal">
	<?php echo $fn->modalHeader('Carga Masiva de IMEI o Serial') ?>
	<fieldset>
		<div class="modal-body">
			<div class="form-actions clearfix">
				<div class="msjinsdet"></div>
				<div class="form-group">
					<label for="" class="control-label col-sm-3 bolder">IMEI o Serial Numero:</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" name="imei">
					</div>
				</div>
				<input type="hidden" name="seri" value="">
				<input type="hidden" name="produc_ide" value="<?php echo $_SESSION['s_idepro'] ?>">
			</div>
		</div>
	</fieldset>
	<?php echo $fn->modalFooter(1) ?>
</form>
</div>
<div class="listadptemp"></div>
<script>
	load('vst-compra-listadetaprotemp','','.listadptemp');
</script>
<script>
var contador=0;
function sumar(){
contador++;
}

	$(function(){
		var formulario = '.detpro';
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
				$.post('prc-mdetaprod-insertdfc_temp',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {
						$(formulario).each(function(){ this.reset() });
						sumar();
						alerta('.msjinsdet','success','Registro exitoso, elemento: '+contador+'<?php echo "/".$_SESSION["s_cant"]; ?>');
						load('vst-compra-listadetaprotemp','','.listadptemp');
						if(contador==<?php echo $_SESSION["s_cant"]; ?>) {cerrarmodal();}
					} else {
						alerta('.msjinsdet','danger',data)
					}
				})
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>