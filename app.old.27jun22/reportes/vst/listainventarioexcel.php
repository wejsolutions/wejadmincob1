<?php require '../../../cfg/base.php'; ?>
<?php $row = $mproducto->listapro(); ?>
<?php header('Content-type: application/vnd.ms-excel');
$nombrearchivo="Inventario_al_".date('d-m-Y');
$titulo="Inventario de productos al: ".date('d-m-Y');
header("Content-Disposition: attachment; filename=".$nombrearchivo.".xls");
header("Pragma: no-cache");
header("Expires: 0");?>
<?php if(count($row)>0): ?>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<tr>
				<th colspan="6"><h1><?php echo $titulo; ?></h1></th>
			</tr>
			<tr>
				<th colspan="6"></th>
			</tr>
			<thead>
				<tr>
					<th>Id</th>
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