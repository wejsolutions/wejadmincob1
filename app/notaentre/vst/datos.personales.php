<?php require '../../../cfg/base.php'; ?>
<?php
$row = $mnotaentre->poridecli($clien_ide);
$_SESSION['s_cliente_noen']=$row[0]->clien_ide;
//$row_fich = $mpermfich->poride(1);
?>
			<div class="widget-main">
				<div class="col-sm-2">
					<span class="profile-picture">
						<img id="avatar" class="editable img-responsive editable-click editable-empty" alt="" src="<?php echo $ccliente->picture($clien_ide).'?'.rand(1,1000) ?>" onclick="modal('vst-cliente-foto.cargar','clien_ide=<?php echo $row[0]->clien_ide ?>')">
					</span>
				</div>
				<div class="col-sm-10">
					<div class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<th class="active text-right">Número de Identificación:</th>
								<td><?php echo $row[0]->clien_tipcli.'-'.$row[0]->clien_numiden ?></td>
								<th class="active text-right">Apellidos y Nombres:</th>
								<td><?php echo $row[0]->clien_apelli1.' '.$row[0]->clien_apelli2.', '.$row[0]->clien_nombre1.' '.$row[0]->clien_nombre2 ?></td>
							</tr>
							<tr>
								<th class="active text-right">Fecha de Nacimiento:</th>
								<td><?php echo date('d-m-Y',strtotime($row[0]->clien_fecnaci)); ?> (<?php echo $ccliente->edad($row[0]->clien_fecnaci); ?>)</td>
								<th class="active text-right">Teléfono Móvil:</th>
								<td><?php echo $row[0]->clien_telmovi ?></td>
							</tr>
							<tr>
								<th class="active text-right">Dirección de Habitación:</th>
								<td colspan="3"><?php echo $row[0]->clien_direcci ?></td>
							</tr>
							<tr>
								<th class="active text-right">Correo Electronico:</th>
								<td colspan="3"><?php echo $row[0]->clien_correo; ?></td>
							</tr>
							<tr>
								<th class="active text-right">Contribuyente Especial:</th>
								<td colspan="3"><?php if ($row[0]->clien_contriespec==0) echo 'NO'; else echo 'SI'; ?>
									<div class="btn-group pull-right">
										<button type="button" class="btn btn-primary" onclick="load('vst-notaentre-updatecli','clien_ide=<?php echo $row[0]->clien_ide ?>','.perfil')"><i class="fa fa-edit"></i> Modificar Cliente</button>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="space-2"></div>
			</div>