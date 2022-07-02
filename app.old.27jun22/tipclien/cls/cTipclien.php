<?php class cTipclien extends mTipclien {
	
	public function setValue() {
		extract($_POST);
		if(isset($tipcli_ide) and !empty($tipcli_ide)):
			$rt = $tipcli_ide;
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