<?php require '../../../cfg/base.php'; ?>
<?php $rowdf2 = $mcompra->listadetacompra2_temp($_SESSION['s_compra']); ?>
<?php $rowdf3 = $mcompra->listadetacompra3_temp($_SESSION['s_compra']); ?>
<?php $rowdft = $mcompra->totalcompra_temp($_SESSION['s_compra']); ?>
<?php if((count($rowdf2)>0) or (count($rowdf3)>0)): ?>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Producto</th>
					<th>Cantidad</th>
					<th>Costo</th>
					<th>Monto</th>
					<th width="17%">Opciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($rowdf2 as $rdf2): ?>
					<tr>
						<td><?php echo $rdf2->compradeta_produc .' - '.$rdf2->produc_codigo.' - '.$rdf2->produc_descrip; ?></td>
						<td align="center"><?php echo number_format($rdf2->compradeta_cant,2,",","."); ?></td>
						<td align="right"><?php echo number_format($rdf2->compradeta_costo,2,",","."); ?></td>
						<td align="right"><?php echo number_format($rdf2->compradeta_monto,2,",","."); ?></td>
						<td>
							<div class="btn-group">
								<button class="btn btn-success btn-xs" title="Actualizar" onclick="modal('vst-compra-updatedetafac','ide=<?php echo $rdf2->compradeta_ide; ?>')">
									<i class="fa fa-edit"></i>
								</button>
								<button class="btn btn-danger btn-xs" title="Borrar" onclick="modal('vst-compra-deletedetafac','ide=<?php echo $rdf2->compradeta_ide; ?>')">
									<i class="fa fa-trash"></i>
								</button>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
				<?php foreach($rowdf3 as $rdf3): ?>
					<tr>
						<td><?php echo $rdf3->compradeta_produc .' - '.$rdf3->produc_codigo.' - '.$rdf3->produc_descrip.' - '.$rdf3->detaprod_imei.' - '.$rdf3->detaprod_serial; ?></td>
						<td align="center"><?php echo number_format($rdf3->compradeta_cant,2,",","."); ?></td>
						<td align="right"><?php echo number_format($rdf3->compradeta_costo,2,",","."); ?></td>
						<td align="right"><?php echo number_format($rdf3->compradeta_monto,2,",","."); ?></td>
						<td>
							<div class="btn-group">
								<button class="btn btn-success btn-xs" title="Actualizar" onclick="modal('vst-compra-updatedetafac','ide=<?php echo $rdf3->compradeta_ide; ?>')">
									<i class="fa fa-edit"></i>
								</button>
								<button class="btn btn-danger btn-xs" title="Borrar" onclick="modal('vst-compra-deletedetafac','ide=<?php echo $rdf3->compradeta_ide; ?>')">
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
		<form action="" class="cargarcompra">
			<table class="table table-hover table-bordered">
				<tbody>
					<tr>
						<td width="53%">
							<table align="center">
								<tr align="right">
									<th>Factura Compra No.:</th><td><font size="2"><input type="text" class="form-control" name="factcomp"></font></td>
									<th></th><td><font size="2"></font></td>
									<th></th><td><font size="2"></font></td>
								</tr>
								<tr align="right">
									<th>Nota de Entrega No.:</th><td><font size="2"><input type="text" class="form-control" name="noencomp"></font></td>
									<th></th><td><font size="2"></font></td>
									<th></th><td><font size="2"></font></td>
								</tr>
								<tr align="right">
									<th>Fecha de Compra:</th><td><font size="2"><input type="text" class="form-control fecha" name="fechcomp"></font></td>
									<th></th><td><font size="2"></font></td>
									<th></th><td><font size="2"></font></td>
								</tr>
							</table>
						</td>
						<td width="30%">
							<table align="right">
								<tr align="right">
									<th>Sub Total:</th><td><font size="4"><?php echo number_format($rowdft[0]->SubTotal,2,",","."); ?></font></td>
								</tr>
								<tr align="right">
									<th>Total Impuestos:</th><td><font size="4"><?php echo number_format($rowdft[0]->TotalImpuesto,2,",","."); ?></font></td>
								</tr>
								<tr align="right">
									<th>Total a Pagar:</th><td><font size="4"><b><?php echo number_format($rowdft[0]->Total,2,",","."); ?></b></font></td>
								</tr>				
							</table>
						<td align="center">
							<div class="btn-group">
								<button class="btn btn-primary btn-sm"><i class="fa fa-money"></i> PROCESAR COMPRA</button>
								<br><br>
								<a href="?var=<?php echo base64_encode(4) ?>">
									<font color="#ED1C24"><i class="fa fa-trash"> Cancelar Compra</i></font>
								</a>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<input type="hidden" class="form-control" name="subtotal" value="<?php echo number_format($rowdft[0]->SubTotal,2,".",""); ?>">
			<input type="hidden" class="form-control" name="totaliva" value="<?php echo number_format($rowdft[0]->TotalImpuesto,2,".",""); ?>">
			<input type="hidden" class="form-control" name="total" value="<?php echo number_format($rowdft[0]->Total,2,".",""); ?>">
		</form>
	</div>
<?php else: ?>
	<div class="alert alert-info">No hay registros para mostrar.</div>
<?php endif; ?>	

<script>
	$(function(){
		$('.chosen').chosen();
		$('.fecha').datepicker({format:'dd-mm-yyyy',endDate:'0d'});
	})
</script>

<script>
	$(function(){
		var formulario = '.cargarcompra';
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
				$.post('prc-mcompra-insertcompradefinitiva',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {
						alert("Compra Procesada Exitosamente")
						load('vst-compra-admin','','#datocompra');
					}
				})
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>