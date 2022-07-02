<?php class cUnidmed extends mUnidmed {
	
	public function setValue() {
		extract($_POST);
		if(isset($unidmed_ide) and !empty($unidmed_ide)):
			$rt = $unidmed_ide;
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