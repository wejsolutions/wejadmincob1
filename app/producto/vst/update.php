<?php require '../../../cfg/base.php'; ?>
<?php foreach($mproducto->poride1($produc_ide) as $r): ?>
	<form action="" class="op2-pac well">
		<div class="msj-pac"></div>
		<fieldset><legend>Datos del Producto o Servicio</legend>	
			<div class="form-group col-sm-3">
				<label for="" class="label control-label col-sm-12 bolder">Código:</label>
				<div class="col-sm-12">
					<input type="text" name="cod" class="form-control" value="<?php echo $r->produc_codigo ?>">
				</div>
			</div>
			<div class="form-group col-sm-3">
				<label for="" class="label control-label col-sm-12 bolder">Descripción del Producto o Servicio:</label>
				<div class="col-sm-12">
					<input type="text" name="des" class="form-control" value="<?php echo $r->produc_descrip ?>">
				</div>
			</div>
			<div class="form-group col-sm-3">
				<label for="" class="label control-label col-sm-12 bolder">Existencia:</label>
				<div class="col-sm-12">
					<input type="text" name="exi" class="form-control" value="<?php echo $r->produc_existen ?>">
				</div>
			</div>
			<div class="form-group col-sm-3">
				<label for="" class="label control-label col-sm-12 bolder">Unidad de Medida: </label>
				<div class="col-sm-10" id="unidmed">
					<select class="form-control chosen" title="Unidad de Medida" name="unm" id="unm" onchange="load('vst-unidmed-select','unidmed_ide='+this.value,'#ideunidmed');">
						<option value=""></option>
						<?php foreach($munidmed->lista() as $p): ?>
							<option value="<?php echo $p->unidmed_ide ?>" <?php echo $fn->select($p->unidmed_ide,$r->produc_unidmed) ?>><?php echo $p->unidmed_descrip ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<div class="clearfix"></div>

			<div class="form-group col-sm-3">
				<label for="" class="label control-label col-sm-12 bolder">Marca: </label>
				<div class="col-sm-10" id="marca">
					<select class="form-control chosen" title="Marca" name="mar" id="mar" onchange="load('vst-marca-select','marca_ide='+this.value,'#idemar');">
						<option value=""></option>
						<?php foreach($mmarca->lista() as $p): ?>
							<option value="<?php echo $p->marca_ide ?>" <?php echo $fn->select($p->marca_ide,$r->produc_marca) ?>><?php echo $p->marca_descrip ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="form-group col-sm-3">
				<label for="" class="label control-label col-sm-12 bolder">Costo:</label>
				<div class="col-sm-12">
					<input type="text" name="cos" class="form-control" value="<?php echo $r->produc_costo ?>">
				</div>
			</div>
			<div class="form-group col-sm-3">
				<label for="" class="label control-label col-sm-12 bolder">Precio de Venta 1:</label>
				<div class="col-sm-12">
					<input type="text" name="pre1" class="form-control" value="<?php echo $r->produc_precio1 ?>">
				</div>
			</div>
			<div class="form-group col-sm-3">
				<label for="" class="label control-label col-sm-12 bolder">Precio de Venta 2:</label>
				<div class="col-sm-12">
					<input type="text" name="pre2" class="form-control" value="<?php echo $r->produc_precio2 ?>">
				</div>
			</div>
			
			<div class="clearfix"></div>

			<div class="form-group col-sm-3">
				<label for="" class="label control-label col-sm-12 bolder">Impuesto:</label>
				<div class="col-sm-10" id="impuesto">
					<select class="form-control chosen" title="Impuesto" name="imp" id="imp" onchange="load('vst-impuesto-select','impuesto_ide='+this.value,'#ideimp');">
						<option value=""></option>
						<?php foreach($mimpuesto->lista() as $p): ?>
							<option value="<?php echo $p->impuesto_ide ?>" <?php echo $fn->select($p->impuesto_ide,$r->produc_impuesto) ?>><?php echo $p->impuesto_porcent ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="form-group col-sm-3">
				<label for="" class="label control-label col-sm-12 bolder">¿Es Servicio?:</label>
				<div class="col-sm-10" id="servicio">
					<select class="form-control chosen" name="ser" id="ser">
						<option <?php if ($r->produc_servicio==0) echo 'selected="true"'; ?> value="0">No</option>
						<option <?php if ($r->produc_servicio==1) echo 'selected="true"'; ?> value="1">Si</option>
					</select>
				</div>
			</div>
			<div class="form-group col-sm-3">
				<label for="" class="label control-label col-sm-12 bolder">Aplica para la tienda:</label>
				<div class="col-sm-10" id="servicio">
					<select class="form-control chosen" title="Agregar" name="tie" id="tie" onchange="load('vst-tienda-select','empresa_ide='+this.value,'#idetie');">
						<option value=""></option>
						<?php foreach($mtienda->lista() as $p): ?>
							<option value="<?php echo $p->empresa_ide ?>" <?php echo $fn->select($p->empresa_ide,$r->produc_tienda) ?>><?php echo $p->empresa_nombre ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="form-group col-sm-3">
				<label for="" class="label control-label col-sm-12 bolder">Existencia Minima:</label>
				<div class="col-sm-12">
					<input type="text" name="sto" class="form-control" value="<?php echo $r->produc_stock ?>">
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="form-actions">
				<div class="btn-group pull-right">
					<button class="btn btn-primary btn-sm"><span class="i fa fa-check"></span> Guardar Cambios</button>
					<button type="button" class="btn btn-danger btn-sm pull-right" onclick="load('vst-producto-datos.producto','produc_ide=<?php echo $produc_ide ?>','.perfil')"><span class="i fa fa-times"></span> Cancelar</button>
				</div>
			</div>

		</fieldset>
		<input type="hidden" name="ide" value="<?php echo $r->produc_ide ?>">
	</form>
<?php endforeach; ?>
<script>
	$(function(){
		$('.chosen').chosen();
		$('.fecha').datepicker({format:'dd-mm-yyyy',endDate:'-18y'});
	})
</script>

<script>
	$(function(){
		var formulario = '.op2-pac';
		$(formulario).validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				cod: {
					required: true,
				},
				des: {
					required: true,
				},
				exi: {
					required: true,
					number: true,
				},
				cos: {
					required: true,
					number: true,
				},
				pre1: {
					required: true,
					number: true,
				},
				pre2: {
					required: true,
					number: true,
				},
/*				pre3: {
					required: true,
					number: true,
				},
				pre4: {
					required: true,
				},
				col: {
					required: true,
				},
				tal: {
					required: true,
				},
				med: {
					required: true,
				}
*/
			},

			messages: {
				cod: {
					required: 'Obligatorio',
					},
				des: {
					required: 'Obligatorio',
					},
				exi: {
					required: 'Obligatorio',
					},
				cos: {
					required: 'Obligatorio',
					},
				pre1: {
					required: 'Obligatorio',
					},
				pre2: {
					required: 'Obligatorio',
					},
/*				pre3: {
					required: 'Obligatorio',
					},
				pre4: {
					required: 'Obligatorio',
					},
				col: {
					required: 'Obligatorio',
					},
				tal: {
					required: 'Obligatorio',
					},

				med: {
					required: 'Obligatorio',
				}
*/
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
				$.post('prc-cproducto-cupdate',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {
						alert('Cambios guardados correctamente');
						load('vst-producto-datos.producto','produc_ide=<?php echo $produc_ide ?>','.perfil');
					} else {
						alerta('.msj-pac','danger',data)
					}
				})
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>