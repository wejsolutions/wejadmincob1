<?php class cContrato extends mContrato {
	
	public function setValue() {
		extract($_POST);
		if(isset($contrato_ide) and !empty($contrato_ide)):
			$rt = $contrato_ide;
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