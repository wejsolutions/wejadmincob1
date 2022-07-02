<?php require '../../../cfg/base.php'; ?>
<?php $row = $mtipousua->lista(); ?>
<?php if(count($row)>0): ?>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Código</th>
					<th>Descripción</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): ?>
					<tr>
						<td><?php printf('%05d',$r->tius_ide) ?></td>
						<td><?php echo $r->tius_descrip ?></td>
						<td>
							<div class="btn-group">
								<button class="btn btn-success btn-xs" title="Actualizar" onclick="modal('vst-tipousua-update','ide=<?php echo $r->tius_ide ?>')">
									<i class="fa fa-edit"></i>
								</button>
								<button class="btn btn-danger btn-xs" title="Borrar" onclick="modal('vst-tipousua-delete','ide=<?php echo $r->tius_ide ?>')">
									<i class="fa fa-trash"></i>
								</button>
								<button class="btn btn-purple btn-xs" title="Permisos" onclick="modal('vst-permisos-admin','tius_ide=<?php echo $r->tius_ide ?>')">
									<i class="fa fa-key"></i>
								</button>
								<button class="btn btn-pink btn-xs" title="Permisos Fichas" onclick="modal('vst-permfich-admin','tius_ide=<?php echo $r->tius_ide ?>')">
									<i class="fa fa-key"></i>
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