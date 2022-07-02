<?php class cClientecuenta extends mClientecuenta {
	
	public function setValue() {
		extract($_POST);
		if(isset($ctecue_clien_ide) and !empty($ctecue_clien_ide)):
			$rt = $ctecue_clien_ide;
		elseif(isset($ctecue_cuenta) and !empty($ctecue_cuenta)):
			$rt = $ctecue_cuenta;
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