<?php require '../../../cfg/base.php'; 
extract($_POST);

/*se busca la Cantidad de contratros del cliente*/
$row=$mcontrato->porclien_ide($clien_ide);
$consecutivo=0;
foreach($row as $r): 
	$consecutivo=$r->contrato_consecutivo;
endforeach;

		if ($consecutivo==0) {
			var_dump($consecutivo);
			$consecutivo=1;
		} else {
			$consecutivo=$consecutivo+1;
		} 
$siguiente=strval($consecutivo);
$proximo_contrato="C00000".$siguiente;

/*Para cuentas del cliente*/

/*$row_cuentas=$mcliente->cuentas($clien_ide);*/

/******************************************/
?>
<div class="">
	<label for="" class="label control-label col-sm-12 bolder">Datos del Contrato</label>
</div>

<div class="alert alert-info">
	<i class="fa fa-exclamation-triangle fa-3x pull-left red"></i> Por favor rellene el siguiente formulario para agregar contrato.
</div>
<form action="" class="datoscontrato">
	<div class="msj-errores" id="errores_contrato"></div>
	<!-- Datos del producto ############### -->
	<fieldset><legend>Datos de Contrato</legend>	

		<input type="hidden" name="clien_ide" class="form-control" value="<?php echo $clien_ide; ?>"> 
		<input type="text" name="consec"    class="form-control" value="<?php echo $consecutivo; ?>"> 

		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Código del Contrato:</label>
			<div class="col-sm-12">
				<input type="text" name="cod" class="form-control" value="<?php echo $proximo_contrato;?>">
			</div>
		</div>
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Fecha del Contrato:</label>
			<div class="col-sm-12">
				<div class="input-group">
					<input type="text" name="fec" id="fec" class="fecha form-control" data-date-format="yyyy-mm-dd" value="">
					<span class="input-group-addon">
						<i class="icon-calendar bigger-110"></i>
					</span>
				</div>
			</div>
		</div>
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Fecha Inicio de Cobro:</label>
			<div class="col-sm-12">
				<div class="input-group">
					<input type="text" name="fec_ini_cob" id="fec_ini_cob" class="fecha form-control" data-date-format="yyyy-mm-dd" value="">
					<span class="input-group-addon">
						<i class="icon-calendar bigger-110"></i>
					</span>
				</div>
			</div>
		</div>
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Monto Contrato</label>
			<div class="col-sm-12">
				<input type="text" name="mto" class="form-control" value="">
			</div>
		</div>
		<div class="clearfix"></div>


		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Número de Cuotas:</label>
			<div class="col-sm-12">
				<input type="number" min="0" name="cuo" class="form-control" value ="">
			</div>
		</div>
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Saldo</label>
			<div class="col-sm-12">
				<input type="number" min="0" name="sdo" class="form-control" value="">
			</div>
		</div>
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Frecuencia de Cuotas:</label>
			<div class="col-sm-10" id="ser">
				<select class="form-control chosen" name="fre" id="fre">
					<option value="1">Dias</option>
					<option value="2">Semanal</option>
					<option value="3">Quincenal</option>
					<option value="4">Mensual</option>
				</select>
			</div>
		</div>
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Cobrar cada cuantos Dias:</label>
			<div class="col-sm-12">
				<input type="number" min="0" name="dias" class="form-control" value ="">
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Cantidad de Artículos:</label>
			<div class="col-sm-12">
				<input type="number" min="0" name="can" class="form-control" value="">
			</div>
		</div>
		<div class="form-group col-sm-6">
			<label for="" class="label control-label col-sm-12 bolder">Descripción de Artículos:</label>
			<div class="col-sm-12">
				<input type="text"  name="des_art" class="form-control" value="">
			</div>
		</div>

		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Banco</label>
			<div class="col-sm-10" id="cuenta_ide">
				<select class="form-control chosen" title="cuenta Bancaria" name="cuenta_ide" id="cuenta_ide" >
					<option value=""></option>
					<?php foreach($mclientecuenta->cuentas_por_clien_ide($clien_ide) as $p): ?>
						<option value="<?php echo $p->ctecue_ide ?>"><?php echo $p->ctecue_cuenta ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Aplica para la tienda:</label>
			<div class="col-sm-10" id="tienda">
				<select class="form-control chosen" title="Tienda" name="tie" id="tie">
					<option value=""></option>
					<?php foreach($mtienda->lista() as $t): ?>
						<option value="<?php echo $t->empresa_ide; ?>"><?php echo $t->empresa_nombre; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<!-- Botón de acción ###########-->
		<div class="clearfix"></div>
		<div class="form-actions clearfix">
			<button class="btn btn-primary btn-sm pull-right"><span class="i fa fa-check"></span> Guardar Contrato</button>
		</div>
	</fieldset>
</form>
<script>
	$(function(){
		$('.chosen').chosen();

		$( ".fecha" ).datepicker({
			autoclose:true
	    }).next().on(ace.click_event, function(){
			 $(this).prev().focus();
		});

	})
</script>

<script>
	$(function(){
		var formulario = '.datoscontrato';
		$(formulario).validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				fec: {
					required: true,
				},
				can: {
					required: true,
				},
				mto: {
					required: true,
				},
				cuo: {
					required: true,
				},
				fre: {
					required: true,
				}
			},

			messages: {
				fec: {
					required: 'Obligatorio',
					},
				can: {
					required: 'Obligatorio',
					},
				mto: {
					required: 'Obligatorio',
					},
				cuo: {
					required: 'Obligatorio',
					},
				fre: {
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
				$.post('prc-mcontrato-insert',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {
						alert('Contrato registrado exitosamente');
/*						load('vst-contrato-listaContratos','clien_ide='+data.trim(),'.listaContratos');*/
						load('vst-contrato-listaContratos','clien_ide=<?php echo $clien_ide; ?>','.listaContratos');
					} else {
						alerta('.msj_errores','danger',data);

					}
				})
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>