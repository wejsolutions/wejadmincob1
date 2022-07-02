<?php class mFracciones {

	function __clone() {}
	function __construct() {}

	//Busca las fracciones por ide de la cuota
	// Para verificar si en la tabla fraccion ya existen registro de una cuota 
	public function porcuota_ide($cuota_ide) {
		$sql = "SELECT * FROM tbl_fraccion WHERE fracci_cuota_ide=?";
		$datos = array($cuota_ide);
		return Enlace::sql($sql,$datos,3,'');
	}

    public function getCuotasPorCobrar($f_ini,$f_fin) {		
		$sql ="SELECT * FROM  vw_cuotasxcobrar 
		left join vw_contratoPorCliente 
		on 
		vw_cuotasxcobrar.cuota_cnt_ide = vw_contratoPorCliente.contrato_ide
		where
		cuota_fecha >='$f_ini'  AND cuota_fecha <='$f_fin' ";

		return Enlace::sql($sql,'',3,'');
	}

	public function getCedulaContrato($contrato_ide){
		$sql = "SELECT * FROM vw_contratoPorCliente WHERE contrato_ide = ?" ;
		$datos = array($contrato_ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	/* Busca Numero de cuenta asociado en el contrato del cliente */
	/* Parametro */

	public function getCuentaContrato($contrato_ide){
		$sql = "SELECT cuenta FROM vw_contrato  WHERE contrato_ide = ?" ;
		$datos = array($contrato_ide);
		return Enlace::sql($sql,$datos,3,'');
	}

	public function insertFraccion($cuo, $cta, $ced, $mto,$estatus) {
		$sql = "SELECT sf_fraccion(?,?,?,?,?,?,?,?,?) AS res";
		extract($_POST); $datos = array($cuo,$cta,$ced,$mto,$estatus,0,0,0,1);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function lista() { // lista fraccion 
		$sql = "SELECT 
				fracci_cuota_ide  AS cuota,
				fracci_cuenta_cli AS cuenta, 
				fracci_cedula_cli AS cedula, 
				fracci_montos     AS monto,
				fracci_estatus    AS estatus
				FROM tbl_fraccion  ";
		return Enlace::sql($sql,'',3,'');
	}

	public function insertarchivo($apb,$afn,$are,$aba,$arb,$acr,$afnr,$arc,$arf,$ast,$tas) {
		$sql = "SELECT sf_archivos(?,?,?,?,?,?,?,?,?,?,?,?,?,?) AS res";
		$datos = array(0,"$apb","$afn",$are,$aba,"$arb","$acr","$afnr",$arc,$arf,$ast,$tas,$_SESSION['s_usua_tienda'],1,$_SESSION['s_clien_ide']);
		return Enlace::sql($sql,$datos,4,'res');
	}

	public function listacuenta() {
		$sql = "SELECT * FROM vw_empresa_cuenta WHERE empcue_borrado=0 ORDER BY empcue_banco_ide, empcue_ide";
		return Enlace::sql($sql,'',3,'');
	}

	public function listafracciondis($ban,$mon) {
		if ($ban>0) {
			$sql = "SELECT * FROM vw_cuota_fracciones WHERE fracci_estatus = 0 AND contrato_moneda_ide = $mon AND ctecue_banco_ide = $ban ORDER BY fracci_ide";
		} else {
			$sql = "SELECT * FROM vw_cuota_fracciones WHERE fracci_estatus = 0 ORDER BY fracci_ide";
		}
		return Enlace::sql($sql,'',3,'');
	}

	public function creararchivo() {
		extract($_POST); 
		$parametros = explode(" | ", $cuenta);
		$paramoneda = explode(" | ", $moneda);
		$ban = trim($parametros[3]);
		$tas = trim($paramoneda[0]);
		$val = trim($paramoneda[1]);
		$ope = trim($paramoneda[2]);
		$mon = trim($paramoneda[3]);
		$fraban = $this->listafracciondis($ban,$mon);

		//$ruta = "C:\ArchivosParaBancos\\";
		$ruta = "archivosbanco/";
		if (count($fraban)>0) {
			$contareg=0;
			$acumonto=0;
			foreach($fraban as $t):
				$contareg++;
				if ($ope==0) { $auxmontostr = $t->fracci_montos*$val; }
				elseif ($ope==1) {
					if ($val<>0) { $auxmontostr = $t->fracci_montos/$val; }
					else { $auxmontostr = 0; }
				}
				$auxmontostr = round($auxmontostr,2);
				$acumonto = $acumonto + $auxmontostr;
			endforeach;

			if (!file_exists($ruta)) { mkdir($ruta, 0777, true); }
			$contador=0;
			$nomarchi=$ruta."Cobranza_".$parametros[0]."_".date('YmdHis').".txt";
			$menserror = "No se puede crear el archivo";
			$archi=fopen($nomarchi,"w+") or die($menserror);
			$fechanom=str_replace("-", "", $f_pro);
			$montototstr = sprintf('%017s',str_replace(".", "", number_format($acumonto,2,".","")));
			$totreg = sprintf('%04s',$contareg);
			$contenido=$parametros[2].$fechanom.$montototstr.$totreg."\n";
			fwrite($archi,$contenido);

			foreach($fraban as $f):
				$contador++;
				if ($contador==1) { $ideprireg = $f->fracci_ide; }
				if ($ope==0) { $montostr = $f->fracci_montos*$val; }
				elseif ($ope==1) {
					if ($val<>0) { $montostr = $f->fracci_montos/$val; }
					else { $montostr = 0; }
				}
				$montostr = str_replace(".", "", number_format(round($montostr,2),2,".",""));
				$montostr = sprintf('%012s',$montostr);
				$contenido=$parametros[1].$montostr.$f->fracci_cuenta_cli.sprintf('%010s',$f->fracci_cedula_cli)."00000100\n";
				fwrite($archi,$contenido);
				$ideultreg = $f->fracci_ide;
			endforeach;
			fclose($archi);
			if ($contador==$contareg) {
				$res = 1;
				// tasa de valor moneda
				$ide_archi = $this->insertarchivo($nomarchi,$f_pro,$contador,$parametros[3],'','','2022-01-01',0,0,0,$tas);
				$sqlf = "SELECT sf_fraccion(?,?,?,?,?,?,?,?,?) AS res";
				$datosf = array(0,0,0,0,2,$ideprireg,$ideultreg,$ide_archi,2);
				Enlace::sql($sqlf,$datosf,4,'res');
			} else {
				$res = "Error la cantidad de registros no coincide";
			}
		} else { $res = "Error NO hay registros de fracciones para este banco en esa moneda"; }
		return $res;
	}
	
} // fin de la clase mFracciones