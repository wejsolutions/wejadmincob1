<?php require '../../../cfg/base.php'; 
$row = $mcobranza->listaarchivos(); 
$contareg=0; ?>
<H4 class="bolder" align="center">Lista de los ultimos 20 archivos generados</H4>
<?php if(count($row)>0): ?>
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>Id</th>
					<th>Ruta y Nombre de Archivo</th>
					<th>Fecha Nomina</th>
					<th>Registros</th>
					<th>Estatus</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($row as $r): ?>
					<?php $contareg++;
					if ($contareg==21) { break; } ?>
					<tr>
						<td align="center"><?php echo $r->archi_ide ?></td>
						<td><?php echo $r->archi_peticion_banco ?></td>
						<td><?php echo $r->archi_fecha_nomina ?></td>
						<td><?php echo $r->archi_registros_enviados ?></td>
						<td><?php echo $r->archi_estatus ?></td>
						<td align="center" valign="middle">
							<div class="btn-group">
								<?php $ruta = $r->archi_peticion_banco; ?>
								<button class="btn btn-info btn-xs" title="Ver" onclick="window.open('<?php echo $ruta; ?>');">
									<i class="fa fa-search"></i>
								</button>
								o
								<a href="<?php echo $ruta; ?>" download="<?php echo $ruta; ?>" >
									<button class="btn btn-purple btn-xs" title="Descargar">
										<i class="icon icon-download-alt"></i>
									</button>
								</a>
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
