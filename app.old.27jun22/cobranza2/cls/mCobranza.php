<?php class mCobranza {

	function __clone() {}
	function __construct() {}

	public function listaarchivos() {
		$sql = "SELECT * FROM tbl_archivos ORDER BY archi_ide DESC";
		return Enlace::sql($sql,'',3,'');
	}

	public function poridearchivos($ide) {
		$sql = "SELECT * FROM tbl_archivos WHERE archi_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listaforarc() {
		$sql = "SELECT * FROM tbl_formato_archivo ORDER BY forarc_ide DESC";
		return Enlace::sql($sql,'',3,'');
	}

	public function porideforarc($ide) {
		$sql = "SELECT * FROM tbl_formato_archivo WHERE forarc_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function listaregcob() {
		if ($_SESSION['s_usua_tienda']==4) {
			$sql = "SELECT * FROM tbl_registro_cobranza ORDER BY regcob_ide DESC";
		} else {
			$sql = "SELECT * FROM tbl_registro_cobranza WHERE regcob_tienda=".$_SESSION['s_usua_tienda']." ORDER BY regcob_ide";
		}
		return Enlace::sql($sql,'',3,'');
	}

	public function porideregcob($ide) {
		$sql = "SELECT * FROM tbl_registro_cobranza WHERE regcob_ide=?";
		$datos = array($ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function insertregcob($contr, $cuent, $monto, $nombr, $cedul, $obser, $estat) {
		$sql = "SELECT sf_regcob(?,?,?,?,?,?,?,?,?,?,?) AS res";
		extract($_POST); $datos = array(0,$contr,$cuent,$monto,$nombr,$cedul,$obser,$estat,$_SESSION['s_usua_tienda'],1,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

	function ArchiCobranzaInsert($cliente,$nombre,$descripcion,$banco,$temp) {
		require '../../../cfg/conexion.php';
		$destino = '../../../app/cobranza/vst/ArchivosDeRespuesta/';
		$nom = str_replace(' ', '', $nombre);
		if(move_uploaded_file($temp, $destino.$nom)) {
			$lineas = file('../vst/ArchivosDeRespuesta/'.$nom);
			foreach($this->porideforarc($banco) as $r):
				if($r->forarc_delimita=="F" || $r->forarc_delimita=="f") { // IF de delimitador Fijo
					// PROCEDIMIENTO POR TAMAÑO FIJO DE COLUMNA
					$conta=0;
					$numlinea=0;
					$poscue = explode(",",$r->forarc_pos_cue);
					$posmon = explode(",",$r->forarc_pos_mon);
					$posnom = explode(",",$r->forarc_pos_nom);
					$posced = explode(",",$r->forarc_pos_ced);
					$posobs = explode(",",$r->forarc_pos_obs);
					$contr = '';
					foreach ($lineas as $linea_num => $linea) { // Inicio ciclo Foreach de Lineas del Archivo
						$numlinea++;
						if ($numlinea>$r->forarc_omi_lin) { // IF de omision de lineas
							$conta++;
							if (trim(substr($linea,0,4))=="0175") { // IF de lineas de cuentas
								$cuent = trim(substr($linea,$poscue[0],$poscue[1])); 
								$monto = floatval(str_replace(",",".",str_replace(".","",trim(substr($linea,$posmon[0],$posmon[1])))));
								$nombr = trim(substr($linea,$posnom[0],$posnom[1]));
								$cedul = trim(substr($linea,$posced[0],$posced[1]));
								$obser = iconv("UTF-8", "ASCII//IGNORE",str_replace("'", "",trim(substr($linea,$posobs[0],$posobs[1]))));
								if (strlen(trim($obser))==0) { $estat = 0; }
								else { $estat = 1; }
								$result = $this->insertregcob($contr, $cuent, $monto, $nombr, $cedul, $obser, $estat);
							} else {
								if ($contr=='' && strrpos($linea, "CONTROL")) {
									$poscontro = strrpos($linea, "CONTROL") + 12;
									$posfecnom = strrpos($linea, "FECHA NOMINA") - $poscontro;
									$contr = trim(substr($linea,$poscontro,$posfecnom));
								}
							}// FIN IF de lineas de cuentas
						} // FIN IF de omision de lineas
					} // Fin ciclo Foreach de Lineas del Archivo
				} // FIN IF de delimitador Fijo
			endforeach;
			/*$sql = "INSERT INTO [dbo].[tbl_archivos] (archi_cliente, archi_ruta, archi_descripcion, archi_drogueria) VALUES ('".$cliente."', '".$nom."', '".$descripcion."', '".$banco."')";
			$result = sqlsrv_query($con,$sql);*/
			if ($result) {
				$res=1;
			} else {
				$res= "Fallo la inserción del archivo. ";
			}
			return $res;
		}
	}

	function traerArchiAnaliIde($ide) {
		$sql = "SELECT * from tbl_archivos where archi_ide=?";
		$res = $this->con->prepare($sql);
		$res->bindParam(1,$ide);
		$res->execute();
		return $res->fetchAll(PDO::FETCH_OBJ);
	}

	function ArchiAnaliDelete($archi_ide) {
		require '../../../cfg/conexion.php';
		$sql = "DELETE FROM tbl_archivos WHERE archi_ide=".$archi_ide;
		$result = sqlsrv_query($con,$sql);
		if ($result) {
			$res=1;
		} else {
			$res= "Fallo la eliminación del archivo. ";
		}
		return $res;
	}

} ?>