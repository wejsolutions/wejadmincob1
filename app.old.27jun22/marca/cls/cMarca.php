<?php class cMarca extends mMarca {
	
	public function setValue() {
		extract($_POST);
		if(isset($marca_ide) and !empty($marca_ide)):
			$rt = $marca_ide;
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