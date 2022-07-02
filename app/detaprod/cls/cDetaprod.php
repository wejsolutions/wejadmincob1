<?php class cdetaprod extends mdetaprod {
	
	public function setValue() {
		extract($_POST);
		if(isset($detaprod_ide) and !empty($detaprod_ide)):
			$rt = $detaprod_ide;
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