<?php class cDeposito extends mDeposito {
	
	public function setValue() {
		extract($_POST);
		if(isset($deposito_ide) and !empty($deposito_ide)):
			$rt = $deposito_ide;
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