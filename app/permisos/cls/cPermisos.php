<?php class cPermisos extends mPermisos {
	
	public function info($sumo,$ind,$tius) {
		$row = $this->permiso($sumo,$tius);
		if(count($row)>0) {
			$estado = ($row[0]->perm_estado==1) ? 'Activo' : 'Inactivo';
			$valor = ($row[0]->perm_estado==1) ? 0 : 1;
			$check = ($row[0]->perm_estado==1) ? 'checked' : null;
		} else {
			$estado = 'Inactivo';
			$valor = 1;
			$check = null;
		}
		$rt = array('estado'=>$estado,'valor'=>$valor,'check'=>$check);
		return $rt[$ind];
	}
} ?>