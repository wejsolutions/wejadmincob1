<?php require '../../../cfg/base.php'; ?>
<?php $row = $mpermisos->lista() ?>
<?php if(count($row)>0): ?>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Módulo</th>
					<th>Submódulo</th>
					<th>Estado</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): ?>
					<tr>
						<td><?php echo $r->modu_descrip ?></td>
						<td><?php echo $r->sumo_descrip ?></td>
						<td><?php echo $cpermisos->info($r->sumo_ide,'estado',$tius_ide) ?></td>
						<td>
							<label>
								<input title="Cambiar Estado" onclick="cambiarEstado('<?php echo $r->sumo_ide ?>','<?php echo $tius_ide ?>','<?php echo $cpermisos->info($r->sumo_ide,"valor",$tius_ide); ?>')" class="ace ace-switch ace-switch-6" type="checkbox" name="perm_ide"  <?php echo $cpermisos->info($r->sumo_ide,'check',$tius_ide) ?>>
								<span class="lbl"></span>
							</label>
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
	function cambiarEstado(sumo,tius,valor) {
		var datos = 'sumo='+sumo+'&tius='+tius+'&valor='+valor;
		$.post('prc-mpermisos-update',datos,function(data){
			load('vst-permisos-lista','tius_ide=<?php echo $tius_ide ?>','.lista2');
		})
	}
</script>