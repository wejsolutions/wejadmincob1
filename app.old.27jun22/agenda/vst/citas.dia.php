<?php 
$row = $magenda->listaFecha(date('Y-m-d'));
?>
<div class="table-responsive">
	<div class="table-header">Citas del día: <?php echo date('d-m-Y'); ?></div>
	<?php if(count($row)>0): ?>
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Cédula</th>
					<th>Apellidos y Nombres</th>
					<th>Entrada</th>
					<th>Salida</th>
					<th>Correo</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): ?>
					<tr>
						<td><?php echo $r->naci_descrip ?>-<?php echo $r->paci_numiden ?></td>
						<td><?php echo $r->paci_apelli1 ?> <?php echo $r->paci_apelli2 ?>, <?php echo $r->paci_nombre1 ?> <?php echo $r->paci_nombre2 ?></td>
						<td><?php echo date('d-m-Y h:i a', strtotime($r->cita_inicio)) ?></td>
						<td><?php echo date('d-m-Y h:i a', strtotime($r->cita_fin)) ?></td>
						<td><?php echo $r->paci_correo ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else: ?>
		<div class="alert alert-info">No hay citas cargadas para la fecha</div>
	<?php endif; ?>
</div>