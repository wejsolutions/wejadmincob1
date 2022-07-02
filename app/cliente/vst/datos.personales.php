<?php require '../../../cfg/base.php'; 
$row = $mcliente->poride($clien_ide);
$row_fich = $mpermfich->poride(1);
?>
<div class="col-sm-12 widget-container-span ui-sortable" id="ficha-<?php echo $row_fich[0]->fich_ide ?>-link">
	<div class="widget-box revival">
		<div class="widget-header widget-hea1der-small header-color-dark">
			<h6 class="bolder"><i class="fa fa-<?php echo $row_fich[0]->fich_icono; ?>"></i> <?php echo $row_fich[0]->fich_descrip; ?></h6>
			<div class="widget-toolbar">
				<a href="#" data-action="reload" onclick="load('<?php echo $row_fich[0]->fich_url ?>','fich_ide=<?php echo $row_fich[0]->fich_ide ?>&clien_ide=<?php echo $clien_ide ?>','#ficha-<?php echo $row_fich[0]->fich_ide ?>');">
					<i class="icon-refresh"></i>
				</a>
				<a href="#" data-action="collapse">
					<i class="icon-chevron-up"></i>
				</a>						
			</div>
		</div>
		<div class="widget-body">
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
								<td><?php echo $row[0]->clien_ide.'- '.$row[0]->clien_apelli1.' '.$row[0]->clien_apelli2.', '.$row[0]->clien_nombre1.' '.$row[0]->clien_nombre2 ?></td>
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
								<th class="active text-right">Correo Electrónico:</th>
								<td colspan="3"><?php echo $row[0]->clien_correo; ?></td>
							</tr>
							<tr>
								<th class="active text-right">Contribuyente Especial:</th>
								<td colspan="3"><?php if ($row[0]->clien_contriespec==0) echo 'NO'; else echo 'SI'; ?></td>
							</tr>
						</table>
					</div>
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-primary" onclick="load('vst-cliente-update','clien_ide=<?php echo $row[0]->clien_ide ?>','.perfil')"><i class="fa fa-edit"></i> Editar Datos</button>
						<!--<button type="button" class="btn btn-purple" onclick="load('vst-cliente-','clien_ide=<?php echo $row[0]->clien_ide ?>','.perfil')"><i class="fa fa-info"></i> Ver Detalles</button>-->
						<button type="button" class="btn btn-danger" onclick="modal('vst-cliente-delete','clien_ide=<?php echo $row[0]->clien_ide ?>')"><i class="fa fa-trash"></i> Borrar</button>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="space-10"></div>
			</div>
		</div>
	</div>
</div>