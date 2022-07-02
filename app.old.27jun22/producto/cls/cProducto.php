<?php class cProducto extends mProducto {
	
	public function buscar() {
		extract($_POST);
		$expd_produc = explode(' - ',$produc);
		$produc_ide = $expd_produc[0];
		$row = $this->poride($produc_ide);
		if(count($row)>0) {
			$rt = $row[0]->produc_ide;
		} else {
			$rt='no';
		}
		return $rt;
	}

	public function buscarfactu() {
		extract($_POST);
		$_SESSION['s_produc']=0;
		$_SESSION['s_detpro']=0;
		$expd_produc = explode(' - ',$produc);
		$produc_ide = $expd_produc[0];
		if (empty($expd_produc[8])) { $detaprod_ide = 0 ;}
		else {$detaprod_ide = $expd_produc[8];}
//		$detaprod_ide = $expd_produc[7];
		$_SESSION['s_produc']=$produc_ide;
		$_SESSION['s_detpro']=$detaprod_ide;
		if ($detaprod_ide == "") {
			$row = $this->poride($produc_ide);
		} else {
			$row = $this->poride2($detaprod_ide);
		}

		if(count($row)>0) {
			if ($detaprod_ide == "") {
				$rt = $row[0]->produc_ide;
			} else {
				$rt = $row[0]->detaprod_ide;
			}
		} else {
			$rt='no';
		}
		return $rt;
	}

	public function buscarcompra() {
		extract($_POST);
		$_SESSION['s_produc']=0;
		$expd_produc = explode(' - ',$produc);
		$produc_ide = $expd_produc[0];
		if (empty($expd_produc[7])) { $detaprod_ide = 0 ;}
		else {$detaprod_ide = $expd_produc[7];}
//		$detaprod_ide = $expd_produc[7];
		$_SESSION['s_produc']=$produc_ide;
		$row = $this->poride($produc_ide);

		if(count($row)>0) {
			$rt = $row[0]->produc_ide;
		} else {
			$rt='no';
		}
		return $rt;
	}

	public function cinsert() {
		extract($_POST);
		$a = Funciones::vacio($des,'La descripción es obligatoria');
		//$b = Funciones::vacio($exi,'Debe indicar cantidad o existencia');
		$b = 1;
		$a1 = ($a==1) ? 1 : $msj[] = $a;
		$b1 = ($b==1) ? 1 : $msj[] = $b;
		if($a1==1 and $b1==1) {
			$rt = $this->insert();
		} else {
			$rt = null;
			foreach($msj as $m) {
				$rt = $rt.$m.'<br>';
			}
		}
		return $rt;
	}

	public function cupdate() {
		extract($_POST);
		$a = Funciones::vacio($des,'La descripción es obligatoria');
		$b = Funciones::vacio($exi,'Debe indicar cantidad o existencia');
		$a1 = ($a==1) ? 1 : $msj[] = $a;
		$b1 = ($b==1) ? 1 : $msj[] = $b;
		if($a1==1 and $b1==1) {
			$rt = $this->update();
		} else {
			$rt = null;
			foreach($msj as $m) {
				$rt = $rt.$m.'<br>';
			}
		}
		return $rt;
	}


	public function picture($produc_ide) {
		if(file_exists('../../../img/productos/'.$produc_ide.'.jpg')) {
			$rt = 'img/productos/'.$produc_ide.'.jpg';
		} else {
			$rt = 'img/productos/m.png';
		}
		return $rt;
	}

	public function cinsertRapido() {
		extract($_POST);
		$a = Funciones::vacio($tipcli,'La descripción es obligatoria');
		$a1 = ($a==1) ? 1 : $msj[] = $a;
			if($a1==1) {
			$rt = $this->insertRapido();
		} else {
			$rt = null;
			foreach($msj as $m) {
				$rt = $rt.$m.'<br>';
			}
		}
		return $rt;
	}

} ?>