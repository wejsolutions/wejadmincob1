<?php require '../../../cfg/base.php'; ?>
<?php $row = $mdetaprod->lista() ?>
<?php if(count($row)>0): ?>
	<div class="table-responsive">
		<table class="table1 table-hover table-bordered"  width="100%">
			<thead>
				<tr HEIGHT="40">
					<th width="10%">Id</th>
					<th width="80%">IMEI o Serial Numero</th>
					<th width="10%">Opciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): ?>
					<tr HEIGHT="40">
						<td align="center"><?php echo $r->detaprod_ide ?></td>
						<td><?php echo $r->detaprod_imei ?></td>
						<td align="center">
							<div class="btn-group">
								<button class="btn btn-success btn-xs" title="Actualizar" onclick="modal('vst-detaprod-update','ide=<?php echo $r->detaprod_ide ?>')">
									<i class="fa fa-edit"></i>
								</button>
								<button class="btn btn-danger btn-xs" title="Borrar" onclick="modal('vst-detaprod-delete','ide=<?php echo $r->detaprod_ide ?>')">
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
	<div class="alert alert-info">No hay seriales para mostrar de este producto.</div>
<?php endif; ?>	
<script>
	$(function(){
		$('.table1').dataTable();
	})
</script>