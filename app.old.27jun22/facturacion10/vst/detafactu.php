<?php require '../../../cfg/base.php'; ?>
<?php $rowdf2 = $mfacturacion10->listadetafactura2($_SESSION['s_factura']); ?>
<?php $rowdf3 = $mfacturacion10->listadetafactura3($_SESSION['s_factura']); ?>
<?php $rowdft = $mfacturacion10->totalfactura($_SESSION['s_factura']); ?>
<?php $rowdftg = $mfacturacion10->totalfacturag($_SESSION['s_factura']); ?>
<?php 
	$subtotal1= 0;
	$montoimp1= 0;
	$monto1= 0;
?>
<?php if((count($rowdf2)>0) or (count($rowdf3)>0)): ?>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Producto</th>
					<th>Cantidad</th>
					<th>Precio</th>
					<th>Monto</th>
					<th width="17%">Opciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($rowdf2 as $rdf2): 
					if ($rdf2->produc_unidmed_abrevia!="na") { $unidad_med=$rdf2->produc_unidmed_abrevia;
      				} else { $unidad_med=""; } ?>
					<tr>
						<td><?php echo $rdf2->factdetatemp_produc .' - '.$rdf2->produc_codigo.' - '.$rdf2->produc_descrip.' - '.$rdf2->detaprod_imei.' - '.$rdf2->detaprod_serial; ?></td>
						<td align="center"><?php echo number_format($rdf2->factdetatemp_cant,2,",",".").' '.$unidad_med; ?></td>
						<td align="right"><?php echo number_format($rdf2->precio_base,2,",","."); ?></td>
						<td align="right"><?php echo number_format($rdf2->monto_base,2,",","."); ?></td>
						<td>
							<div class="btn-group">
								<button class="btn btn-success btn-xs" title="Actualizar" onclick="modal('vst-facturacion10-updatedetafac','ide=<?php echo $rdf2->factdetatemp_ide; ?>')">
									<i class="fa fa-edit"></i>
								</button>
								<button class="btn btn-danger btn-xs" title="Borrar" onclick="modal('vst-facturacion10-deletedetafac','ide=<?php echo $rdf2->factdetatemp_ide; ?>')">
									<i class="fa fa-trash"></i>
								</button>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
				<?php foreach($rowdf3 as $rdf3): 
					if ($rdf3->produc_unidmed_abrevia!="na") { $unidad_med=$rdf3->produc_unidmed_abrevia;
      				} else { $unidad_med=""; } ?>
					<tr>
						<td><?php echo $rdf3->factdetatemp_produc .' - '.$rdf2->produc_codigo.' - '.$rdf3->produc_descrip.' - '.$rdf3->detaprod_imei.' - '.$rdf3->detaprod_serial; ?></td>
						<td align="center"><?php echo number_format($rdf3->factdetatemp_cant,2,",",".").' '.$unidad_med; ?></td>
						<td align="right"><?php echo number_format($rdf3->precio_base,2,",","."); ?></td>
						<td align="right"><?php echo number_format($rdf3->monto_base,2,",","."); ?></td>
						<td>
							<div class="btn-group">
								<button class="btn btn-success btn-xs" title="Actualizar" onclick="modal('vst-facturacion10-updatedetafac','ide=<?php echo $rdf3->factdetatemp_ide; ?>')">
									<i class="fa fa-edit"></i>
								</button>
								<button class="btn btn-danger btn-xs" title="Borrar" onclick="modal('vst-facturacion10-deletedetafac','ide=<?php echo $rdf3->factdetatemp_ide; ?>')">
									<i class="fa fa-trash"></i>
								</button>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<div class="table-responsive">
		<form action="" class="cargarfactura">

			<?php $subtotal1= $rowdft[0]->SubTotal10; ?>
			<?php $subtotal2= $rowdft[0]->SubTotal10; ?>
			<?php $subtotal1= $subtotal1 + $rowdftg[0]->SubTotal10; ?>

			<?php $montoimp1= $rowdft[0]->TotalImpuesto; ?>

			<?php if ($subtotal1>2000000) { $montoimp1= $montoimp1 + $rowdftg[0]->TotalImpuesto7; } else { $montoimp1= $montoimp1 + $rowdftg[0]->TotalImpuesto9;
			} ?>
			<?php $monto1aux= number_format($subtotal1 + $montoimp1,2,".",""); ?>
			<?php $monto1= number_format($subtotal1 + $montoimp1,2,",","."); ?>
			<?php $subtotal1aux= number_format($subtotal1,2,".",""); ?>
			<?php $subtotal1= number_format($subtotal1,2,",","."); ?>
			<?php $montoimp1aux = number_format($montoimp1,2,".",""); ?>
			<?php $montoimp1 = number_format($montoimp1,2,",","."); ?>

			<table class="table table-hover table-bordered">
				<tbody>
					<tr>
						<td width="53%">
							<table align="center">
								<tr align="right">
									<th>Forma de Pago:</th><td><font size="2">Contado </font><input type="radio" name="forpag" value="0" checked></td>
									<th></th><td><font size="2"></font></td>
									<th></th><td><font size="2"></font></td>
								</tr>
								<tr align="right">
									<th>T.D.:</th><td><font size="2"><input type="number" min="0" step="0.01" class="form-control" name="tardeb" value="<?php echo $monto1aux; ?>"></font></td>
									<th>T.C.:</th><td><font size="2"><input type="number" min="0" step="0.01" class="form-control" name="tarcre" value="0"></font></td>
									<th>T.A.:</th><td><font size="2"><input type="number" min="0" step="0.01" class="form-control" name="tarali" value="0"></font></td>
								</tr>
								<tr align="right">
									<th>Transferencia:</th><td><font size="2"><input type="number" min="0" step="0.01" class="form-control" name="transf" value="0"></font></td>
									<th>Banco:</th>
									<td>
										<select class="form-control " name="bantra" id="bantra">
											<option value="1"></option>
											<?php foreach($mbanco->lista() as $p): ?>
											<option value="<?php echo $p->banco_ide ?>"><?php echo $p->banco_descrip ?></option>
											<?php endforeach; ?>
										</select>
									</td>
									<th>Ref.:</th><td><font size="2"><input type="text" class="form-control" name="numtra" value="0"></font></td>
								</tr>
							</table>
						</td>
						<td width="30%">
							<table align="right">
								<tr align="right">
									<th>Sub Total:</th><td><font size="4"> <?php echo $subtotal1; ?> </font></td>
								</tr>
								<tr align="right">
									<th>Total Impuestos (<?php if ($subtotal2>number_format(2000000,2,",",".")) { echo '7'; } else { echo '9'; }?>%):</th><td><font size="4"> <?php echo $montoimp1; ?> </font></td>
								</tr>
								<tr align="right">
									<th>Total a Pagar:</th><td><font size="4"><b> <?php echo $monto1; ?> </b></font></td>
								</tr>				
							</table>
						</td>
						<td align="center">
							<div class="btn-group">
								<button class="btn btn-primary btn-sm"><i class="fa fa-money"></i> PROCESAR FACTURA</button>
								<br><br>
								<a href="?var=<?php echo base64_encode(31) ?>">
									<font color="#ED1C24"><i class="fa fa-trash"> Cancelar Venta</i></font>
								</a>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<input type="hidden" class="form-control" name="subtotal" value="<?php echo $subtotal1aux; ?>">
			<input type="hidden" class="form-control" name="totaliva" value="<?php echo $montoimp1aux; ?>">
			<input type="hidden" class="form-control" name="total" value="<?php echo $monto1aux; ?>">
		</form>
	</div>
<?php else: ?>
	<div class="alert alert-info">No hay registros para mostrar.</div>
<?php endif; ?>	

<script>
	$(function(){
		var formulario = '.cargarfactura';
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
				$.post('prc-mfacturacion10-insertfact',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {
						alert("Factura Procesada Exitosamente")
						window.open('facturai-'+data);
						load('vst-facturacion10-admin','','#datofact');
					}
				})
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>