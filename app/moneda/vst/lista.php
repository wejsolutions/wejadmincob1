<?php require '../../../cfg/base.php'; 
$row = $mmoneda->lista();
if(count($row)>0): ?>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Id</th>
					<th>Descripción Moneda</th>
					<th>Moneda</th>
					<th>Operación</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): 
					if ($r->moneda_operacion==0) {
						$monope = "Multiplicación";
					} elseif ($r->moneda_operacion==1) {
						$monope = "División";
					} ?>
					<tr>
						<td align="center"><?php echo $r->moneda_ide ?></td>
						<td><?php echo $r->moneda_descrip ?></td>
						<td><?php echo $r->moneda_abreviada ?></td>
						<td><?php echo $monope ?></td>
						<td>
							<div class="btn-group">
								<button class="btn btn-danger btn-xs" title="Borrar" onclick="modal('vst-moneda-delete','ide=<?php echo $r->moneda_ide ?>')">
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