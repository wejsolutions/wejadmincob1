<?php class cTienda extends mTienda {
	
	public function setValue() {
		extract($_POST);
		if(isset($impuesto_ide) and !empty($impuesto_ide)):
			$rt = $impuesto_ide;
		elseif(isset($des) and !empty($des)):
			$rt = $des;
		else:
			$rt = null;
		endif;
		return $rt;
	}

	public function disabled() {
		$disabled = (isset($_POST['disabled']) and $_POST['disabled']==1) ? 'disabled' : null;
		return $disabled;
	}
} ?>