<?php
 $row = $mproducto->listapro();
?>
<?php if(count($row)>0): ?>
	<div class="btn-group">
		<button class="btn btn-success btn-xs" title="Generar EXCEL" onclick="window.open('app/reportes/vst/listainventarioexcel.php')">
			<i class="fa fa-file-excel-o"></i> Generar EXCEL
		</button>
	</div>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Id</th>
					<th>Código</th>
					<th>Descripcion</th>
					<th>Existencia</th>
					<th>Marca</th>
					<th>Modelo</th>
					<th>Tienda</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): ?>
					<tr>
						<td align="center"><?php echo $r->produc_ide ?></td>
						<td><?php echo $r->produc_codigo ?></td>
						<td><?php echo $r->produc_descrip ?></td>
						<td><?php echo $r->produc_existen ?></td>
						<td><?php echo $r->produc_marca ?></td>
						<td><?php echo $r->produc_modelo ?></td>
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