<?php 
require '../../../cfg/base.php';
extract($_POST);
$anomes=$ano.'-'.$mes;
$row = $mproducto->kardexmensualresu($anomes); 
$rowtienda = $mtienda->poride($dealer); 
?>
<?php if(count($row)>0): ?>
	<div class="btn-group">
		<button class="btn btn-success btn-xs" title="Generar EXCEL" onclick="window.open('app/reportes/vst/librodeinventariomensualexcel.php?mes=<?php echo $mes ?>&ano=<?php echo $ano ?>&dealer=<?php echo $dealer ?>')">
			<i class="fa fa-file-excel-o"></i> Generar EXCEL
		</button>
	</div>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th colspan="2">Mes:</th>
					<th colspan="10"><?php echo $mes; ?></th>
				</tr>
				<tr>
					<th colspan="2">Ejercicio Grabable:</th>
					<th colspan="10"><?php echo $ano; ?></th>
				</tr>
				<tr>
					<th colspan="2">RIF del Contribuyente:</th>
					<th colspan="10"><?php echo $rowtienda[0]->empresa_rif; ?></th>
				</tr>
				<tr>
					<th colspan="2">Nombre de la Empresa:</th>
					<th colspan="10"><?php echo $rowtienda[0]->empresa_nombre; ?></th>
				</tr>
				<tr>
					<th colspan="2">Producto</th>
					<th colspan="5">Unidades</th>
					<th colspan="5">Bolívares</th>
				</tr>
				<tr>
					<th>Id Prod.</th>
					<th>Descripción</th>
					<th>Existencia</th>
					<th>Compra</th>
					<th>Venta</th>
					<th>Retiro</th>
					<th>AutoConsumo</th>
					<th>Existencia</th>
					<th>Compra</th>
					<th>Venta</th>
					<th>Retiro</th>
					<th>AutoConsumo</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): ?>
					<tr>
						<td align="center"><?php echo $r->produc_ide ?></td>
						<?php 
							$row0 = $mproducto->kardexmensualporproducto($anomes,$r->produc_ide);
							$row1 = $mproducto->kardexmensual($anomes,$r->produc_ide,1);
							$row2 = $mproducto->kardexmensual($anomes,$r->produc_ide,2);
							$row5 = $mproducto->kardexmensual($anomes,$r->produc_ide,5);
							$row6 = $mproducto->kardexmensual($anomes,$r->produc_ide,6);
							$rowp = $mproducto->preciounitarioventa1($anomes,$r->produc_ide);
							if (count($rowp)>0) {
								$preciofinal=$rowp[0]->precio_venta_unitario;
							} else {
								$rowpro = $mproducto->poride($r->produc_ide);
								$preciofinal=$rowpro[0]->produc_precio1/(1+($rowpro[0]->produc_impuesto/100));
							}
						?>
						<td><?php echo $r->produc_descrip ?></td>
						<td><?php echo number_format($row0[0]->kardex_existen_ant, 2, ',', '.') ?></td>
						<td><?php if (count($row1)>0) {echo number_format($row1[0]->sum_cant, 2, ',', '.');} else {echo "0,00";} ?></td>
						<td><?php if (count($row2)>0) {echo number_format($row2[0]->sum_cant, 2, ',', '.');} else {echo "0,00";} ?></td>
						<td><?php if (count($row5)>0) {echo number_format($row5[0]->sum_cant, 2, ',', '.');} else {echo "0,00";} ?></td>
						<td><?php if (count($row6)>0) {echo number_format($row6[0]->sum_cant, 2, ',', '.');} else {echo "0,00";} ?></td>
						<td><?php echo number_format($row0[0]->kardex_existen_ant*$preciofinal, 2, ',', '.') ?></td>
						<td><?php if (count($row1)>0) {echo number_format($row1[0]->sum_cant*$preciofinal, 2, ',', '.');} else {echo "0,00";} ?></td>
						<td><?php if (count($row2)>0) {echo number_format($row2[0]->sum_cant*$preciofinal, 2, ',', '.');} else {echo "0,00";} ?></td>
						<td><?php if (count($row5)>0) {echo number_format($row5[0]->sum_cant*$preciofinal, 2, ',', '.');} else {echo "0,00";} ?></td>
						<td><?php if (count($row6)>0) {echo number_format($row6[0]->sum_cant*$preciofinal, 2, ',', '.');} else {echo "0,00";} ?></td>
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