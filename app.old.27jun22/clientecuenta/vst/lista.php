<?php require '../../../cfg/base.php'; 
extract($_POST);
$row=$mclientecuenta->cuentas_por_clien_ide($clien_ide);?>
<?php //var_dump($_POST) ?>

		<div class="btn-group pull-right">
				<button class="btn btn-inverse" onclick="modal('vst-clientecuenta-insert','clien_ide=<?php echo $clien_ide ?>')">
					<i class="fa fa-plus"></i>
					Agregar Cuenta Bancaria...
				</button>
		</div>
<?php if(count($row)>0): ?>
	<div class="table-responsive">





		<table class="table_cliente_cuentas_update table-hover table-bordered" width="50%">
			<thead>
				<tr>
					<th>Id</th>
					<th>Cuenta</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): ?>
					<tr>
						<td align="center"><?php echo $r->ctecue_ide ?></td>
						<td><?php echo $r->ctecue_cuenta ?></td>
						<td>
							<div class="btn-group">
								<button class="btn btn-success btn-xs" title="Actualizar" onclick="modal('vst-clientecuenta-update','ide=<?php echo $r->ctecue_ide ?>&clien_ide2=<?php echo $r->ctecue_clien_ide ?>')">
									<i class="fa fa-edit"></i>
								</button>
								<button class="btn btn-danger btn-xs" title="Borrar" onclick="modal('vst-clientecuenta-delete','ide=<?php echo $r->ctecue_ide ?>')">
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
		$('.table_cliente_cuentas_update').dataTable();
	})
</script>