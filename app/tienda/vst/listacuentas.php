<?php require '../../../cfg/base.php'; ?>
<?php $row = $mtienda->listacuentas() ?>
<?php if(count($row)>0): ?>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>R.I.F.</th>
					<th>Nombre de la Razón Social</th>
					<th>Banco</th>
					<th>Cuenta</th>
					<th>Codigo</th>
					<th>Titular</th>
					<th>Email</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): ?>
					<tr>
						<td><?php echo $r->empresa_rif; ?></td>
						<td><?php echo $r->empresa_nombre; ?></td>
						<td><?php echo $r->banco_descrip ?></td>
						<td><?php echo $r->empcue_cuenta ?></td>
						<td><?php echo $r->empcue_codigo ?></td>
						<td><?php echo $r->empcue_nombre ?></td>
						<td><?php echo $r->empcue_email ?></td>
						<td>
							<div class="btn-group">
								<button class="btn btn-success btn-xs" title="Actualizar" onclick="modal('vst-tienda-updatecuentas','ide=<?php echo $r->empcue_ide ?>')">
									<i class="fa fa-edit"></i>
								</button>
								<button class="btn btn-danger btn-xs" title="Borrar" onclick="modal('vst-tienda-deletecuentas','ide=<?php echo $r->empcue_ide ?>')">
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
<script>
	$(function(){
		$('.table').dataTable();
	})
</script>