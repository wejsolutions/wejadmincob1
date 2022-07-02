<?php class cModelo extends mModelo {
	
	public function setValue() {
		extract($_POST);
		if(isset($modelo_ide) and !empty($modelo_ide)):
			$rt = $modelo_ide;
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