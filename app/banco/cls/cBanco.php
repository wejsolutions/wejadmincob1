<?php class cBanco extends mBanco {
	
	public function setValue() {
		extract($_POST);
		if(isset($banco_ide) and !empty($banco_ide)):
			$rt = $banco_ide;
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