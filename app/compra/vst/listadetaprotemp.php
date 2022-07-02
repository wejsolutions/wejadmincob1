<?php require '../../../cfg/base.php'; ?>
<?php $row = $mdetaprod->listadetaprotemp() ?>
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
								<button class="btn btn-danger btn-xs" title="Borrar" onclick="borrar_detpro('ide=<?php echo $r->detaprod_ide ?>')">
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
	function borrar_detpro(ide) {
		if(confirm('¿Borrar el registro seleccionado?')==true) {
			$.post('prc-mdetaprod-deletetemp',ide,function(){
				load('vst-compra-listadetaprotemp','','.listadptemp');
			})
		}
	}
</script>
<script>
	$(function(){
		$('.table1').dataTable();
	})
</script>