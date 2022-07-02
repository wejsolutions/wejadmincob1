<?php require '../../../cfg/base.php'; ?>
<?php $row = $mauditoria->lista() ?>
<?php if(count($row)>0): ?>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Fecha y Hora</th>
					<th>Usuario</th>
					<th>Nombre</th>
					<th>Operacion</th>
					<th>Registro</th>
					<th>Tabla</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): ?>
					<tr>
						<td align="center"><?php echo date('d-m-Y H:i',strtotime($r->audi_fechora)) ?></td>
						<td><?php echo $r->usua_login ?></td>
						<td><?php echo $r->clien_nombre1.' '.$r->clien_nombre2.' '.$r->clien_apelli1.' '.$r->clien_apelli2 ?>
						</td>
						<td align="left"><?php echo $r->ope_descrip ?></td>
						<td align="center"><?php echo $r->audi_registr ?></td>
						<td align="left"><?php echo $r->audi_tabla ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php else: ?>
	<div class="alert alert-info">No hay registros de auditoria para mostrar.</div>
<?php endif; ?>	
<script>
	$(function(){
		$('.table').dataTable();
	})
</script>