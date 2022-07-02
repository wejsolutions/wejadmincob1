<?php class cMoneda extends mMoneda {
	
	public function setValue() {
		extract($_POST);
		if(isset($moneda_ide) and !empty($moneda_ide)):
			$rt = $moneda_ide;
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