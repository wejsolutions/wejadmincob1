<?php require '../../../cfg/base.php'; ?>
<?php $row = $minformes->lista($paci_ide) ?>
<?php if(count($row)>0): ?>
	<div class="table-responsive">
		<div class="table-header">Informes</div>
		<table class="table table-bordered table-hover table-striped">
			<thead>
				<tr>
					<th>Fecha</th>
					<th>Descripción</th>
					<th>Opción</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): ?>
					<tr>
						<td><?php echo date('d-m-Y',strtotime($r->info_fecha)) ?></td>
						<td><?php echo substr($r->info_descrip, 0, 40) ?>...</td>
						<td>
							<button class="btn btn-xs btn-success" onclick="load('vst-informes-update','fich_ide=<?php echo $fich_ide ?>&paci_ide=<?php echo $paci_ide ?>&info_ide=<?php echo $r->info_ide ?>','.informes-operation')">
								<i class="fa fa-edit"></i>
							</button>
							<button class="btn btn-xs btn-danger" onclick="borrarInforme('ide=<?php echo $r->info_ide ?>')">
								<i class="fa fa-trash"></i>
							</button>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php else: ?>
	<div class="alert alert-info">No hay informes registrados</div>
<?php endif; ?>

<script>
	function borrarInforme(ide) {
		if(confirm('¿Borrar el informe seleccionado?')==true) {
			$.post('prc-minformes-delete',ide,function(){
				load('vst-informes-historico','fich_ide=<?php echo $fich_ide ?>&paci_ide=<?php echo $paci_ide ?>','.historico-informes');
			})
		}
	}
</script>