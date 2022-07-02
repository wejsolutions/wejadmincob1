<?php require '../../../cfg/base.php'; ?>
<?php extract($_POST); ?>
<?php
  $row = $mcompra->listacompraverificadeta($ide);
?>
<div class="btn-group">
	<button class="btn btn-success btn-xs" title="Generar PDF" onclick="window.open('facturacompra-'+<?php echo $ide ?>)">
		<i class="fa fa-print"></i> Generar PDF
	</button>
</div>
<?php if(count($row)>0): ?>
	<div class="table-responsive">
		<table class="table3 table-hover table-bordered"  width="100%">
			<thead>
				<tr>
					<th width="30%">Descripcion</th>
					<th width="20%">Marca</th>
					<th width="20%">Modelo</th>
					<th width="30%">IMEI o Serial Numero</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): ?>
					<tr>
						<td><?php echo $r->produc_descrip ?></td>
						<td><?php echo $r->produc_marca ?></td>
						<td><?php echo $r->produc_modelo ?></td>
						<td><?php echo $r->detaprod_imei ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php else: ?>
	<div class="alert alert-info">No hay registro de detalle de compra para mostrar.</div>
<?php endif; ?>	
<script>
	$(function(){
		$('.table3').dataTable();
	})
</script>