<?php class cAgenda extends mAgenda {
		
	public function selectMedicosAgenda($tius,$paci) {
		if($tius==1) :
			$rt = $this->listaTiusAgenda(3,6);
		elseif($tius==3) :
			$rt = $this->musuarios->poride($paci);
		elseif($tius==5) :
			$rt = $this->musuarios->listaTius(3,6);
		else:
			$rt = null;
		endif;
		return $rt;
	}

	public function cargaAgendaAuto($tius,$medico) {
		if($tius==3 or $tius==1) {
			$rt = 'load("vst-agenda-calendario","medico='.$medico.'","#calendario")';
		} else {
			$rt = null;
		}
		return $rt;
	}

	public function gotoCalendar() {
		if(isset($_POST['inicio'])) {
			extract($_POST);
			$dia = date('d',strtotime($inicio));
			$mes = date('m',strtotime($inicio))-1;
			$ano = date('Y',strtotime($inicio));
		} else {
			$dia = date('d');
			$mes = date('m')-1;
			$ano = date('Y');
		}
		$rt = array('dia'=>$dia,'mes'=>$mes,'ano'=>$ano);
		return $rt;
	}

	public function cupdate() {
		extract($_POST);
		if(date('Y-m-d',strtotime($inicio))<date('Y-m-d')) {
			$rt = 'No puede mover una cita a una fecha inferior a la actual';
		} else {
			$rt = $this->update();
		}
		return $rt;
	}
	
} ?>