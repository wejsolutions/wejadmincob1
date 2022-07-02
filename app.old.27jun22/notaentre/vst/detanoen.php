<?php require '../../../cfg/base.php'; ?>
<?php $rowdf2 = $mnotaentre->listadetanotaentre2($_SESSION['s_notaentre']); ?>
<?php $rowdf3 = $mnotaentre->listadetanotaentre3($_SESSION['s_notaentre']); ?>
<?php $rowdft = $mnotaentre->totalnotaentre($_SESSION['s_notaentre']); ?>
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
				<?php foreach($rowdf2 as $rdf2): ?>
					<tr>
						<td><?php echo $rdf2->noendetatemp_produc .' - '.$rdf2->produc_descrip.' - '.$rdf2->detaprod_imei.' - '.$rdf2->detaprod_serial; ?></td>
						<td align="center"><?php echo number_format($rdf2->noendetatemp_cant,2,",","."); ?></td>
						<td align="right"><?php echo number_format($rdf2->noendetatemp_precio,2,",","."); ?></td>
						<td align="right"><?php echo number_format($rdf2->noendetatemp_monto,2,",","."); ?></td>
						<td>
							<div class="btn-group">
								<button class="btn btn-success btn-xs" title="Actualizar" onclick="modal('vst-notaentre-updatedetanoen','ide=<?php echo $rdf2->noendetatemp_ide; ?>')">
									<i class="fa fa-edit"></i>
								</button>
								<button class="btn btn-danger btn-xs" title="Borrar" onclick="modal('vst-notaentre-deletedetanoen','ide=<?php echo $rdf2->noendetatemp_ide; ?>')">
									<i class="fa fa-trash"></i>
								</button>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
				<?php foreach($rowdf3 as $rdf3): ?>
					<tr>
						<td><?php echo $rdf3->noendetatemp_produc .' - '.$rdf3->produc_descrip.' - '.$rdf3->detaprod_imei.' - '.$rdf3->detaprod_serial; ?></td>
						<td align="center"><?php echo number_format($rdf3->noendetatemp_cant,2,",","."); ?></td>
						<td align="right"><?php echo number_format($rdf3->noendetatemp_precio,2,",","."); ?></td>
						<td align="right"><?php echo number_format($rdf3->noendetatemp_monto,2,",","."); ?></td>
						<td>
							<div class="btn-group">
								<button class="btn btn-success btn-xs" title="Actualizar" onclick="modal('vst-notaentre-updatedetanoen','ide=<?php echo $rdf3->noendetatemp_ide; ?>')">
									<i class="fa fa-edit"></i>
								</button>
								<button class="btn btn-danger btn-xs" title="Borrar" onclick="modal('vst-notaentre-deletedetanoen','ide=<?php echo $rdf3->noendetatemp_ide; ?>')">
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
		<form action="" class="cargarnotaentre">
			<table class="table table-hover table-bordered">
				<tbody>
					<tr>
						<td width="53%">
							<table align="center">
								<tr align="right">
									<th>Forma de Pago:</th><td><font size="2">Contado </font><input type="radio" name="forpag" value="0" checked></td>
									<th></th><td><font size="2">Credito </font><input type="radio" name="forpag" value="1"></td>
									<th></th><td><font size="2"></font></td>
								</tr>
								<tr align="right">
									<th>Efectivo:</th><td><font size="2"><input type="number" min="0" step="any" class="form-control" name="efecti" value="<?php echo number_format($rowdft[0]->Total,2,".",""); ?>"></font></td>
									<th></th><td><font size="2"></font></td>
									<th></th><td><font size="2"></font></td>
								</tr>
								<tr align="right">
									<th>T.D.:</th><td><font size="2"><input type="number" min="0" step="any" class="form-control" name="tardeb" value="0"></font></td>
									<th>T.C.:</th><td><font size="2"><input type="number" min="0" step="any" class="form-control" name="tarcre" value="0"></font></td>
									<th>T.A.:</th><td><font size="2"><input type="number" min="0" step="any" class="form-control" name="tarali" value="0"></font></td>
								</tr>
								<tr align="right">
									<th>Cheque:</th><td><font size="2"><input type="number" min="0" step="any" class="form-control" name="cheque" value="0"></font></td>
									<th>Banco:</th>
									<td>
										<select class="form-control " name="banche" id="banche">
											<option value="1"></option>
											<?php foreach($mbanco->lista() as $p): ?>
											<option value="<?php echo $p->banco_ide ?>"><?php echo $p->banco_descrip ?></option>
											<?php endforeach; ?>
										</select>
									</td>
									<th>Numero:</th><td><font size="2"><input type="text" class="form-control" name="numche" value="0"></font></td>
								</tr>
								<tr align="right">
									<th>Transferencia:</th><td><font size="2"><input type="number" min="0" step="any" class="form-control" name="transf" value="0"></font></td>
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
									<th>Sub Total:</th><td><font size="4"><?php echo number_format($rowdft[0]->SubTotal,2,",","."); ?></font></td>
								</tr>
								<tr align="right">
									<th>Total Impuestos:</th><td><font size="4"><?php echo number_format($rowdft[0]->TotalImpuesto,2,",","."); ?></font></td>
								</tr>
								<tr align="right">
									<th>Total a Pagar:</th><td><font size="4"><b><?php echo number_format($rowdft[0]->Total,2,",","."); ?></b></font></td>
								</tr>				
							</table>
						</td>
						<td align="center">
							<div class="btn-group">
								<button class="btn btn-primary btn-sm"><i class="fa fa-money"></i> PROCESAR NOTA DE ENTREGA</button>
								<br><br>
								<a href="?var=<?php echo base64_encode(11) ?>">
									<font color="#ED1C24"><i class="fa fa-trash"> Cancelar Venta</i></font>
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
		$('.fecha').datepicker({format:'dd-mm-yyyy',endDate:'-18y'});
	})
</script>

<script>
	$(function(){
		var formulario = '.cargarnotaentre';
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
				$.post('prc-mnotaentre-insertnoen',$(formulario).serialize(),function(data){
					if(!isNaN(data)) {
						alert("Nota de Entrega Procesada Exitosamente")
						load('vst-notaentre-admin','','#datonoen');
					}
				})
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>