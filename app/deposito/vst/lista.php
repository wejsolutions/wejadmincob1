<?php require '../../../cfg/base.php'; ?>
<?php $row = $mdeposito->lista() ?>
<?php if(count($row)>0): ?>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Id</th>
					<th>Banco</th>
					<th>Num. Dep.</th>
					<th>Num. Cuenta</th>
					<th>Monto</th>
					<th>F. Dep.</th>
					<th>F. Venta</th>
					<th>F. Reg.</th>
					<th>Tienda</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): ?>
					<tr>
						<td align="center"><?php echo $r->deposito_ide ?></td>
						<td><?php echo $r->banco_descrip ?></td>
						<td align="center"><?php echo $r->deposito_numero ?></td>
						<td align="center"><?php echo $r->deposito_numerocuenta ?></td>
						<td align="center"><?php echo number_format($r->deposito_monto, 2, ',', '.') ?></td>
						<td align="center"><?php echo date('d-m-Y',strtotime($r->deposito_fechadeposito)) ?></td>
						<td align="center"><?php echo date('d-m-Y',strtotime($r->deposito_fechadiaventa)) ?></td>
						<td align="center"><?php echo date('d-m-Y',strtotime($r->deposito_fecharegistro)) ?></td>
						<td align="center"><?php echo $r->empresa_nombre ?></td>
						<td>
							<div class="btn-group">
								<button class="btn btn-success btn-xs" title="Actualizar" onclick="modal('vst-deposito-update','ide=<?php echo $r->deposito_ide ?>')">
									<i class="fa fa-edit"></i>
								</button>
								<button class="btn btn-danger btn-xs" title="Borrar" onclick="modal('vst-deposito-delete','ide=<?php echo $r->deposito_ide ?>')">
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