<?php require '../../../cfg/base.php'; 
extract($_POST);
$row = $mcontrato->listaporcliente($clien_ide); ?>

<div>
<label for="" class="label control-label col-sm-12 bolder">Contratos del Cliente</label>	
</div>
<?php if(count($row)>0): ?>
<div>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th align="center">Código</th>
					<th align="center">Fecha</th>
					<th>Monto</th>
					<th>Cuotas</th>
					<th>Saldo</th>
					<th align="center">Opcion</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): ?>
					<tr>
						<td align="right" ><?php echo $r->contrato_codigo ?></td>
						<td align="right" ><?php echo $r->contrato_fecha ?></td>
						<td align="right" ><?php echo $r->contrato_monto ?></td>
						<td align="right" ><?php echo $r->contrato_cuotas ?></td>
						<td align="right" ><?php echo $r->contrato_saldo ?></td>
						<td>
							<div class="btn-group">
								<button class="btn btn-success btn-xs" title="Actualizar" onclick="modal('vst-banco-update','ide=<?php echo $r->banco_ide ?>')">
									<i class="fa fa-edit"></i>
								</button>
								<button class="btn btn-danger btn-xs" title="Borrar" onclick="modal('vst-banco-delete','ide=<?php echo $r->banco_ide ?>')">
									<i class="fa fa-trash"></i>
								</button>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php else: ?>
	<div class="alert alert-info">No hay registros para mostrar.</div>
<?php endif; ?>	
</div>
<script>
	$(function(){
		$('.table').dataTable();
	})
</script>