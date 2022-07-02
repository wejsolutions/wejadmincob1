<?php require '../../../cfg/base.php'; ?>
<?php
extract($_POST);
//echo $buscaractivo;
//echo $fact;
$rowpr = $mproducto->listapro();
if ($buscaractivo==0) {
	$rowp = $mproducto->poride($_SESSION['s_produc']);
	$rowcd = $mcompra->contardeta($_SESSION['s_produc']);
}
//if ($buscaractivo==0 and $_SESSION['s_detpro']=="") $rowp = $mproducto->poride($_SESSION['s_produc']);
//if ($buscaractivo==0 and $_SESSION['s_detpro']!="") $rowp = $mproducto->poride2($_SESSION['s_detpro']);
//echo "Producto: ".$_SESSION['s_produc']." Detalle producto: ".$_SESSION['s_detpro'];
?>
<form action="" class="cargarproduc">
	<div class="form-group">
		<label for="" class="label control-label col-sm-12 bolder">Buscar Producto para cargar a la factura de compra:</label>
		<div class="col-sm-12">
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<th class="active text-right" width="10%">Producto:</th>
						<td width="45%">
							<?php if ($buscaractivo==1) { $_SESSION['s_compra']=$fact;?>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="buscarproducto" name="produc">
							</div>
							<div class="col-sm-3">
								<button class="btn btn-primary btn-sm"><i class="fa fa-sign-out"></i></button>
								<button type="button" onclick="location.reload()" class="btn btn-success btn-sm"><i class="fa fa-refresh"></i></button>
							</div>
							<?php } else {?>
							<div class="col-sm-12">
								<input type="text" readonly="true" class="form-control" value="<?php echo $rowp[0]->produc_descrip; ?>">
								<input type="hidden" class="form-control" name="idep" value="<?php echo $rowp[0]->produc_ide; ?>">
							</div>
							<?php } ?>
						</td>
						<?php if ($buscaractivo==0) {?>
						<th class="active text-right" width="10%">Cant.:</th>
						<td width="10%">
							<input type="number" name="cant" min="0" class="form-control">
						</td>
						<th class="active text-right" width="10%">Costo:</th>
						<td width="15%">
							<div class="col-sm-9">
								<input type="number" name="costo" min="0" class="form-control">
							</div>
							<div class="col-sm-1">
								<button class="btn btn-primary btn-sm"><i class="fa fa-download"></i></button>
							</div>
						</td>
						<?php }?>
					</tr>
				</table>
			</div>
		</div>
	</div>
</form>
<div class="clearfix"></div>
<div class="space-10"></div>
<div class="detafactu"></div>
<script>
	load('vst-compra-detafactu','','.detafactu');
</script>
<script>
	$(function(){
		var tag_input = $('#buscarproducto');
		if(! ( /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase())) ) {
			tag_input.tag(
			  {
				placeholder:tag_input.attr('placeholder'),
				//enable typeahead by specifying the source array
				source: [<?php foreach($rowpr as $rpr): ?> "<?php echo $rpr->produc_ide.' - '.$rpr->produc_codigo.' - '.$rpr->produc_descrip.' - '.$rpr->produc_marca.' - '.$rpr->produc_modelo.' - '.$rpr->produc_color.' - '.$rpr->empresa_nombre2; ?>", <?php endforeach; ?>]
			  }
			);
		}
		else {
			//display a textarea for old IE, because it doesn't support this plugin or another one I tried!
			tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
			//$('#form-field-tags').autosize({append: "\n"});
		}

		var formulario = '.cargarproduc';
		$(formulario).validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			rules: {
				produc: {
					required: true,
				}
			},

			messages: {
				produc: {
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
				<?php if ($buscaractivo==1) { ?>
				$.post('prc-cproducto-buscarcompra',$(formulario).serialize(),function(data){
					if(data.trim()=='no') {
						alert('Producto no registrado, por favor verifique los datos');
						load('vst-compra-adminproduc','buscaractivo=1&fact=<?php echo $_SESSION['s_compra']; ?>','.compra');
					} else {
						load('vst-compra-adminproduc','produc_ide='+data.trim()+'&buscaractivo=0','.compra');
						load('vst-compra-detafactu','','.detafactu');
					}
				})
				<?php } else {?>
				$.post('prc-mcompra-insertcompradeta_temp',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {
						<?php $_SESSION['s_cantcarg']=0; ?>
						if (<?php echo $rowp[0]->produc_serializado ?>>0){ modal('vst-compra-insertdeta','idepro=<?php echo $rowp[0]->produc_ide ?>'); }
						load('vst-compra-adminproduc','buscaractivo=1&fact=<?php echo $s_compra; ?>','.compra');
						load('vst-compra-detafactu','','.detafactu');
					} else {
						alerta('.msj','danger',data)
					}
				})
				<?php }?>
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>