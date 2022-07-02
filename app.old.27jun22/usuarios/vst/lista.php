<?php require '../../../cfg/base.php'; ?>
<?php $row = $musuarios->lista(); ?>
<?php if(count($row)>0): ?>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Cédula</th>
					<th>Apellidos y Nombres</th>
					<th>Usuario</th>
					<th>Tipo</th>
					<th>Estatus</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): ?>
					<tr>
						<td><?php echo $r->clien_tipcli.$r->clien_numiden ?></td>
						<td><?php echo $r->clien_apelli1 ?> <?php echo $r->clien_apelli2 ?>, <?php echo $r->clien_nombre1 ?> <?php echo $r->clien_nombre2 ?></td>
						<td><?php echo $r->usua_login ?></td>
						<td><?php echo $r->usua_estado ?></td>
						<td><?php echo $r->tius_descrip ?></td>
						<td>
							<div class="btn-group">
								<button class="btn btn-success btn-xs" title="Actualizar" onclick="load('vst-usuarios-update','clien_ide=<?php echo $r->clien_ide ?>','.lista');">
									<i class="fa fa-edit"></i>
								</button>
								<button class="btn btn-danger btn-xs" title="Borrar" onclick="modal('vst-usuarios-delete','clien_ide=<?php echo $r->clien_ide ?>')">
									<i class="fa fa-trash"></i>
								</button>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody
		</table>
	</div>
<?php else: ?>
	<div class="alert alert-info">No hay registros para mostrar.</div>
<?php endif; ?>	