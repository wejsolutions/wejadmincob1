<?php require '../../../cfg/base.php'; ?>
<?php $row = $mproducto->kardexretiro() ?>
<?php if(count($row)>0): ?>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Id K.</th>
					<th>Producto</th>
					<th>Marca</th>
					<th>Modelo</th>
					<th>Tipo</th>
					<th>Cantidad</th>
					<th>Fecha</th>
					<th>Observaciones</th>
					<th>Tienda</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): ?>
					<tr>
						<td align="center"><?php echo $r->kardex_ide ?></td>
						<td><?php echo $r->produc_descrip ?></td>
						<td><?php echo $r->produc_marca ?></td>
						<td><?php echo $r->produc_modelo ?></td>
						<td><?php if ($r->kardex_tipo==1) {echo "Compra";} elseif ($r->kardex_tipo==2) {echo "Venta";} elseif ($r->kardex_tipo==3) {echo "Devolucion de Compra";} elseif ($r->kardex_tipo==4) {echo "Devolucion de Venta";} elseif ($r->kardex_tipo==5) {echo "Retiro de Mercancia";} elseif ($r->kardex_tipo==6) {echo "Auto-Consumo de Mercancia";} elseif ($r->kardex_tipo==12) {echo "Venta N.E.";} elseif ($r->kardex_tipo==14) {echo "Devolucion de Venta N.E.";} ?></td>
						<td><?php echo $r->kardex_cantidad ?></td>
						<td><?php echo date('d-m-Y',strtotime($r->kardex_fecha)) ?></td>
						<td><?php echo $r->kardex_observacion ?></td>
						<td><?php echo $r->empresa_nombre ?></td>
						<td>
							<div class="btn-group">
								<button class="btn btn-danger btn-xs" title="Borrar" onclick="modal('vst-producto-deleteretiro','ide=<?php echo $r->kardex_ide ?>')">
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