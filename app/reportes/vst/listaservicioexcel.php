<?php require '../../../cfg/base.php'; ?>
<?php $row = $mproducto->listaser(); ?>
<?php header('Content-type: application/vnd.ms-excel');
$nombrearchivo="Servicios_al_".date('d-m-Y');
$titulo="Lista de Servicios al: ".date('d-m-Y');
header("Content-Disposition: attachment; filename=".$nombrearchivo.".xls");
header("Pragma: no-cache");
header("Expires: 0");?>
<?php if(count($row)>0): ?>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<tr>
				<th colspan="11"><h1><?php echo $titulo; ?></h1></th>
			</tr>
			<tr>
				<th colspan="11"></th>
			</tr>
			<thead>
				<tr>
					<th>Id</th>
					<th>Descripcion</th>
					<th>Existencia</th>
					<th>Costo</th>
					<th>Precio 1</th>
					<th>Precio 2</th>
					<th>Precio 3</th>
					<th>Precio 4</th>
					<th>Marca</th>
					<th>Modelo</th>
					<th>Tienda</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): ?>
					<tr>
						<td align="center"><?php echo $r->produc_ide ?></td>
						<td><?php echo $r->produc_descrip ?></td>
						<td><?php echo $r->produc_existen ?></td>
						<td><?php echo $r->produc_costo ?></td>
						<td><?php echo $r->produc_precio1 ?></td>
						<td><?php echo $r->produc_precio2 ?></td>
						<td><?php echo $r->produc_precio3 ?></td>
						<td><?php echo $r->produc_precio4 ?></td>
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