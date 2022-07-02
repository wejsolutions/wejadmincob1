<?php 
require '../../../cfg/base.php';
extract($_POST);
$anomes=$ano.'-'.$mes;
$row = $mproducto->kardexmensualresu($anomes); 
$rowtienda = $mtienda->poride($dealer); 
?>
<?php header('Content-type: application/vnd.ms-excel');
$nombrearchivo="Inventario_Mensual_".$mes."-".$ano;
header("Content-Disposition: attachment; filename=".$nombrearchivo.".xls");
header("Pragma: no-cache");
header("Expires: 0");?>
<?php if(count($row)>0): ?>
	<div class="table-responsive">
		<table class="table table-hover table-bordered" border="1">
			<thead>
				<tr>
					<th align="left" colspan="2">MES:</th>
					<th align="left" colspan="10"><?php echo $mes; ?></th>
				</tr>
				<tr>
					<th align="left" colspan="2">EJERCICIO GRABABLE:</th>
					<th align="left" colspan="10"><?php echo $ano; ?></th>
				</tr>
				<tr>
					<th align="left" colspan="2">RIF DEL CONTRIBUYENTE:</th>
					<th align="left" colspan="10"><?php echo $rowtienda[0]->empresa_rif; ?></th>
				</tr>
				<tr>
					<th align="left" colspan="2">NOMBRE DE LA EMPRESA:</th>
					<th align="left" colspan="10"><?php echo $rowtienda[0]->empresa_nombre; ?></th>
				</tr>
				<tr>
					<th colspan="12">MOVIMIENTO DE MERCANCIA MENSUAL</th>
				</tr>
				<tr>
					<th colspan="2">PRODUCTO</th>
					<th colspan="5">UNIDADES</th>
					<th colspan="5">BOL&Iacute;VARES</th>
				</tr>
				<tr>
					<th>Id Prod.</th>
					<th>Descripci&oacute;n</th>
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