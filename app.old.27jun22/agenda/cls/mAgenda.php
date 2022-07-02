<?php class mAgenda {

	public function __clone() {}
	public function __construct() {
		$this->musuarios = new mUsuarios();
	}

	public function listaTiusAgenda($tius,$tius2) {
		$sql = "SELECT * FROM vw_usuarios WHERE tius_ide=? or tius_ide=?";
		$datos = array($tius,$tius2);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function insert() {
		extract($_POST);
		if($trat==''){$trat=0;}
		$sql = "CALL sp_citas(?,?,?,?,?,?,?,?,?,?,?)";
		$datos = array(0,$medico,$paci_ide,$inicio,$fin,$obs,$eti,date('Y-m-d',strtotime($inicio)),$trat,1,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,1,'','');
	}

	public function lista($medico) {
		$sql = "SELECT * FROM vw_citas WHERE cita_medico=?";
		$dat = array($medico);
		return Enlace::sql($sql,$dat,3,'');
	}

	public function listaFecha($fecha) {
		$sql = "SELECT * FROM vw_citas WHERE cita_fecreal=?";
		$dat = array($fecha);
		return Enlace::sql($sql,$dat,3,'');
	}

	public function poride($cita_ide) {
		$sql = "SELECT * FROM vw_citas WHERE cita_ide=?";
		$dat = array($cita_ide);
		return Enlace::sql($sql,$dat,3,'');
	}

	public function update() {
		extract($_POST);
		$sql = "CALL sp_citas(?,?,?,?,?,?,?,?,?,?,?)";
		$datos = array($cita_ide,0,0,$inicio,$fin,0,0,date('Y-m-d',strtotime($inicio)),0,2,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,1,'','');
	}

	public function delete() {
		extract($_POST);
		$sql = "CALL sp_citas(?,?,?,?,?,?,?,?,?,?,?)";
		$datos = array($cita_ide,0,0,0,0,0,0,'0000-00-00',0,3,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,1,'','');
	}

} ?>