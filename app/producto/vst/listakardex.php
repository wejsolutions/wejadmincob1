<?php $row = $mproducto->kardex() ?>
<?php if(count($row)>0): ?>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Id K.</th>
					<th>Código</th>
					<th>Producto</th>
					<th>Marca</th>
					<th>Modelo</th>
					<th>Exis. Prev.</th>
					<th>Tipo</th>
					<th>Cantidad</th>
					<th>Exis. Post.</th>
					<th>Fecha</th>
					<th>Factura</th>
					<th>Id Fact.</th>
					<th>Tienda</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): ?>
					<tr>
						<td align="center"><?php echo $r->kardex_ide ?></td>
						<td><?php echo $r->produc_codigo ?></td>
						<td><?php echo $r->produc_descrip ?></td>
						<td><?php echo $r->produc_marca ?></td>
						<td><?php echo $r->produc_modelo ?></td>
						<td><?php echo $r->kardex_existen_ant ?></td>
						<td><?php if ($r->kardex_tipo==1) {echo "Compra";} elseif ($r->kardex_tipo==2) {echo "Venta";} elseif ($r->kardex_tipo==3) {echo "Devolucion de Compra";} elseif ($r->kardex_tipo==4) {echo "Devolucion de Venta";} elseif ($r->kardex_tipo==5) {echo "Retiro de Mercancia";} elseif ($r->kardex_tipo==6) {echo "Auto-Consumo de Mercancia";} elseif ($r->kardex_tipo==12) {echo "Venta N.E.";} elseif ($r->kardex_tipo==14) {echo "Devolucion de Venta N.E.";} elseif ($r->kardex_tipo==15) {echo "Devolución  Retiro Merc.";} elseif ($r->kardex_tipo==16) {echo "Devolución Auto-Consumo Merc.";}?></td>
						<td><?php echo $r->kardex_cantidad ?></td>
						<td><?php echo $r->kardex_existen_pos ?></td>
						<td><?php echo date('d-m-Y',strtotime($r->kardex_fecha)) ?></td>
						<td><?php echo $r->kardex_factura_num ?></td>
						<td><?php echo $r->kardex_factura ?></td>
						<td><?php echo $r->empresa_nombre ?></td>
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