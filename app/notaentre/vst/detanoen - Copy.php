<?php require '../../../cfg/base.php'; ?>
<?php $rowdf = $mnotaentre->listadetanotaentre($_SESSION['s_notaentre']); ?>
<?php $rowdft = $mnotaentre->totalnotaentre($_SESSION['s_notaentre']); ?>
<?php if(count($rowdf)>0): ?>
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
				<?php foreach($rowdf as $rdf): ?>
					<tr>
						<td><?php echo $rdf->noendetatemp_produc .' - '.$rdf->produc_descrip; ?></td>
						<td align="center"><?php echo number_format($rdf->noendetatemp_cant,2,",","."); ?></td>
						<td align="right"><?php echo number_format($rdf->noendetatemp_precio,2,",","."); ?></td>
						<td align="right"><?php echo number_format($rdf->noendetatemp_monto,2,",","."); ?></td>
						<td>
							<div class="btn-group">
								<button class="btn btn-success btn-xs" title="Actualizar" onclick="modal('vst-notaentre-updatedetanoen','ide=<?php echo $rdf->noendetatemp_ide; ?>')">
									<i class="fa fa-edit"></i>
								</button>
								<button class="btn btn-danger btn-xs" title="Borrar" onclick="modal('vst-notaentre-deletedetanoen','ide=<?php echo $rdf->noendetatemp_ide; ?>')">
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
						<td width="83%">
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
								<button class="btn btn-primary btn-sm"><i class="fa fa-money"></i> PROCESAR NOTA DE ENTREGA</button>
								<br><br>
								<button class="btn btn-danger btn-xs" title="Cancelar Venta" onclick="load('vst-notaentre-admin','0','0')">
									<i class="fa fa-trash"> Cancelar Venta</i>
								</button>
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
						load('vst-notaentre-admin','','');
						if(confirm('Nota de Entrega procesada correctamente.\n¿Desea generar nueva nota de entrega?')==true) {
							load('vst-notaentre-admin','','');
						}
					}
				})
			},
			invalidHandler: function (form) {
			}
		});
	})
</script>