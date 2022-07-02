<?php require '../../../cfg/base.php'; ?>
<?php extract($_POST); ?>
<?php $row = $mfracciones->getCuotasPorCobrar($f_ini,$f_fin); 


?>
<div>
<label for="" class="label control-label col-sm-12 bolder">Cuotas por cobrar</label>	
</div>
<?php if(count($row)>0): ?>
<div>
<form action="" class="" method="POST">
	<input type="hidden" name="f_ini" class="form-control" value="<?php echo $f_ini; ?>">
	<input type="hidden" name="f_fin" class="form-control" value="<?php echo $f_fin; ?>">

	<div class="table-responsive">
		<table class="tableFraccion table-hover table-bordered" width="100%">
			<thead>
				<tr>
					<th align="center">Cédula</th>
					<th align="center">Nombre</th>
					<th align="center">Apellido</th>
					<th>Código contrato</th>
					<th>Fecha cuota</th>
					<th>Monto cuota</th>
					<th>Cantidad de Fracciones</th>
					<th>Monto por Fracción</th>
					<th align="center">Opcion</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): ?>
					<tr> 
						<?php 
						$mtoporfraccion=0;
						if ($r->cuota_cant_fracc>0)
							$mtoporfraccion=($r->cuota_monto/$r->cuota_cant_fracc);  
						?>
						<td align="right" ><?php echo $r->Cedula ?></td>
						<td align="right" ><?php echo $r->Nombre ?></td>
						<td align="right" ><?php echo $r->Apellido ?></td>
						<td align="right" ><?php echo $r->Codigo ?></td>
						<td align="right" ><?php echo $r->cuota_fecha ?></td>
						<td align="right" ><?php echo $r->cuota_monto ?></td>
					<td align="right" ><?php echo $r->cuota_cant_fracc ?></td>
					<td align="right" ><?php echo round($mtoporfraccion,2) ?></td>

						<td>
							<div class="btn-group">
								<button class="btn btn-success btn-xs" title="Fraccionar" onclick="modal('vst-fracciones-fraccionar','ide=<?php echo $r->banco_ide ?>&f_ini=<?php echo $f_ini; ?>&contrato_ide=<?php echo $r->Codigo ?>')"> <!-- Verificar el pase de f-fin por post -->
									<i class="fa fa-edit"></i>


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
</form>
</div>

<div class="clearfix"></div>
		<div class="col-sm-3">
			<button class="btn btn-primary btn-sm" onclick="load('vst-fracciones-fraccionar','f_ini=<?php echo $f_ini?>&f_fin=<?php echo $f_fin?>','.fracciones');">
				<i class="fa fa-search"></i> Cargar Fracciones
			</button>
			<button type="button" onclick="location.reload()" class="btn btn-success btn-sm"><i class="fa fa-refresh"></i></button>
		</div>
<div class="fracciones"></div>
<script>
	$(function(){
		$('.tableFraccion').dataTable();
	})
</script>

<!-- 'f_ini='+f_ini+'&f_fin='+f_fin' -->