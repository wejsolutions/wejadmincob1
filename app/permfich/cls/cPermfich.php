<?php class cPermfich extends mPermfich {
	
	public function info($fich,$ind,$tius) {
		$row = $this->permiso($fich,$tius);
		if(count($row)>0) {
			$estado = ($row[0]->pefi_estado==1) ? 'Activo' : 'Inactivo';
			$valor = ($row[0]->pefi_estado==1) ? 0 : 1;
			$check = ($row[0]->pefi_estado==1) ? 'checked' : null;
		} else {
			$estado = 'Inactivo';
			$valor = 1;
			$check = null;
		}
		$rt = array('estado'=>$estado,'valor'=>$valor,'check'=>$check);
		return $rt[$ind];
	}
} ?>