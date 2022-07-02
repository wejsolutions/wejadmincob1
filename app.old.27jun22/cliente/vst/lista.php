<?php //require '../../../cfg/base.php'; ?>
<?php $row = $mcliente->lista() ?>
<?php if(count($row)>0): ?>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Id</th>
					<th>C.I. o R.I.F.</th>
					<th>Nombre</th>
					<th>Telefono</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): ?>
					<tr>
						<td align="center"><?php echo $r->clien_ide ?></td>
						<td><?php echo $r->clien_tipcli.'-'.$r->clien_numiden ?></td>
						<td><?php echo $r->clien_nombre1.' '.$r->clien_nombre2.' '.$r->clien_apelli1.' '.$r->clien_apelli2 ?></td>
						<td><?php echo $r->clien_telmovi ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php else: ?>
	<div class="alert alert-info">No hay registros de Clientes, Proveedores o Vendedores para mostrar.</div>
<?php endif; ?>	
<script>
	$(function(){
		$('.table').dataTable();
	})
</script>