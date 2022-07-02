<!-- 
codigo      cod
clien_ide   cli
fecha   	fec
monto    	mto
cuotas   	cuo
frecue		fre
cantidad 	can
tienda		tie  -->
<?php require '../../../cfg/base.php'; 
//extract($_POST);

//echo $clien_ide;
echo $clien_ide=6;
?>
<form action="" class="">
	<div class="form-group">
		<label for="" class="label control-label col-sm-12 bolder">Datos del Contrato 16 jun:</label>

	</div>
</form>



<div class="alert alert-info">
	<i class="fa fa-exclamation-triangle fa-3x pull-left red"></i> Por favor rellene el siguiente formulario para agregar contrato.
</div>
<form action="" class="datos_contrato">
	<div class="msj-produc" id="errores"></div>
	<!-- Datos del producto ############### -->
	<fieldset><legend>Datos de Contrato</legend>	


		<input type="text" name="clien_ide" class="form-control" value="<?php echo $clien_ide; ?>">

		<div class="form-group col-sm-3">

			<label for="" class="label control-label col-sm-12 bolder">Codigo del Contrato:</label>
			<div class="col-sm-12">
				<input type="text" name="cod" class="form-control" value="C0005">
			</div>
		</div>
		<div class="form-group col-sm-3">

			<label for="" class="label control-label col-sm-12 bolder">Fecha del Contrato:</label>
			<div class="col-sm-12">
				<div class="input-group">
					<input type="text" name="fec" id="fec" class="fecha form-control" data-date-format="yyyy-mm-dd" value="2017-07-01">
					<span class="input-group-addon">
						<i class="icon-calendar bigger-110"></i>
					</span>
				</div>
			</div>
		</div>

		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Monto:</label>
			<div class="col-sm-12">
				<input type="text" name="mto" class="form-control" value="5000">
			</div>
		</div>
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Número de Cuotas:</label>
			<div class="col-sm-12">
				<input type="number" min=0 name="cuo" class="form-control" value ="6">
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Saldo</label>
			<div class="col-sm-12">
				<input type="number" min=0 name="sdo" class="form-control" value="5000">
			</div>
		</div>
		
		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Frecuencia de Cuotas:</label>
			<div class="col-sm-10" id="ser">
				<select class="form-control chosen" name="fre" id="fre">
					<option value="1">Semanal</option>
					<option value="2">Quincenal</option>
					<option value="3">Mensual</option>
				</select>
			</div>
		</div>

		<div class="form-group col-sm-3">
			<label for="" class="label control-label col-sm-12 bolder">Cantidad de Artículos:</label>
			<div class="col-sm-12">
				<input type="number" min=0 name="can" class="form-control" value="5000">
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
		var formulario = '.datos_contrato';
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
					} else {
						alerta('.msj-produc','danger',data);

					}
				})
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>
<script>
	$(function(){
		var tag_input = $('#input_buscarcompania');
		if(! ( /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase())) ) {
			tag_input.tag(
			  {
				placeholder:tag_input.attr('placeholder'),
				//enable typeahead by specifying the source array
				source: [<?php foreach($mproducto->lista() as $r): ?> "<?php echo $r->produc_ide.' - '.$r->produc_descrip.$r->produc_existe.' - '.$r->produc_costo.' '.$r->produc_precio1.' '.$r->produc_precio2.' '.$r->produc_precio3; ?>", <?php endforeach; ?>]
			  }
			);
		}
		else {
			//display a textarea for old IE, because it doesn't support this plugin or another one I tried!
			tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
			//$('#form-field-tags').autosize({append: "\n"});
		}
	});
</script>