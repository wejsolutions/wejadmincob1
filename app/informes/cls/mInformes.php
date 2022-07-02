<?php class mInformes {

	function __clone() {}
	function __construct() {}

	public function lista($paci) {
		$sql = "SELECT * FROM tbl_informes WHERE info_paci=? AND info_borrado=0 ORDER BY info_fecha DESC";
		return Enlace::sql($sql,array($paci),3,'');
	}

	public function poride($ide) {
		$sql = "SELECT * FROM tbl_informes WHERE info_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function crearImagen($imagen) {
		$i1 = explode('<img src="', $imagen);
		if(count($i1)>0) {
			$unimos2 = $i1[0].'';
			for($x=1;$x<count($i1);$x++) {
				$i3 = explode('">',$i1[$x]);
				#print_r($i3);
				$re = str_replace(' ', '+', $i3[0]);
				$unimos = $re.'" style="">';
				for($y=1;$y<count($i3);$y++) {
					if ($y==count($i3)-1) {
						$unimos .= $i3[$y];
					} else {
						$unimos .= $i3[$y].'">';
					}
				}
				$unimos2 .= ' <img src="'.$unimos;
			}
			$rt1 = $unimos2;
			$rt = str_replace('aspersonsignalascii', '&', $unimos2);
		} else {
			$rt = null;
		}
		return $rt;
	}

	public function insert() {
		$sql = "CALL sp_informes(?,?,?,?,?)";
		extract($_POST); 
		$news = $this->crearImagen($texto);
		$datos = array(0,$paci,$news,1,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,1,'');
	}

	public function update() {
		$sql = "CALL sp_informes(?,?,?,?,?)";
		extract($_POST); 
		$news = $this->crearImagen($texto);
		$datos = array($ide,0,$news,2,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,1,'');
	}

	public function delete() {
		$sql = "CALL sp_informes(?,?,?,?,?)";
		extract($_POST); 
		$datos = array($ide,0,0,3,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,1,'');
	}

} ?>