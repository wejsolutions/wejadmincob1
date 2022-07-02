<?php require '../../../cfg/base.php'; ?>
<?php $row = $mpermfich->lista(); ?>
<?php if(count($row)>0): ?>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Descripción</th>
					<th>Estado</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): ?>
					<tr>
						<td><?php echo $r->fich_descrip ?></td>
						<td><?php echo $cpermfich->info($r->fich_ide,'estado',$tius_ide) ?></td>
						<td>
							<label>
								<input title="Cambiar Estado" onclick="cambiarEstado('<?php echo $r->fich_ide ?>','<?php echo $tius_ide ?>','<?php echo $cpermfich->info($r->fich_ide,"valor",$tius_ide); ?>')" class="ace ace-switch ace-switch-6" type="checkbox" name="perm_ide"  <?php echo $cpermfich->info($r->fich_ide,'check',$tius_ide) ?>>
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
	function cambiarEstado(fich,tius,valor) {
		var datos = 'fich='+fich+'&tius='+tius+'&valor='+valor;
		$.post('prc-mpermfich-update',datos,function(data){
			load('vst-permfich-lista','tius_ide=<?php echo $tius_ide ?>','.lista2');
		})
	}
</script>