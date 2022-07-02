<?php class cReportes extends mReportes {
	
	public function setValue() {
		extract($_POST);
		if(isset($reportes_ide) and !empty($reportes_ide)):
			$rt = $reportes_ide;
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