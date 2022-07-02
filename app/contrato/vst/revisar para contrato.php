	<div class="form-group col-sm-2">
			<label for="" class="label control-label col-sm-12 bolder">Moneda</label>
			<div class="col-sm-12" id="mone">
				<select class="form-control chosen" title="Moneda" name="mone" id="mone" >
					<option value=""></option>
					<?php foreach($mmoneda->lista() as $m): ?>
						<option value="<?php echo $m->moneda_ide ?>">
							<?php echo $m->moneda_ide.'-'. $m->moneda_abreviada ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>