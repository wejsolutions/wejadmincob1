<?php 
# Configura la ruta de acceso de los archivos al sistema
$ruta_acceso_archivos = (file_exists('cfg/config.php')) ? '' : '../../../';
# Llama a las librerías principales
require $ruta_acceso_archivos.'cfg/config.php';
require $ruta_acceso_archivos.'cfg/conexion.php';
require $ruta_acceso_archivos.'cfg/funciones.php';
# Reune todos los archivos y carpetas dentro de app
$archivos = array(
		'usuarios'=>array('mUsuarios','cUsuarios'),
		'tipclien'=>array('mTipclien','cTipclien'),
		'tipousua'=>array('mTipousua','cTipousua'),
		'permisos'=>array('mPermisos','cPermisos'),
		'cliente'=>array('mCliente','cCliente'),
		'agenda'=>array('mAgenda','cAgenda'),
		'permfich'=>array('mPermfich','cPermfich'),
		'impuesto'=>array('mImpuesto','cImpuesto'),
		'marca'=>array('mMarca','cMarca'),
		'modelo'=>array('mModelo','cModelo'),
		'contrato'=>array('mContrato','cContrato'),
		'banco'=>array('mBanco','cBanco'),
		'producto'=>array('mProducto','cProducto'),
		'unidmed'=>array('mUnidmed','cUnidmed'),
		'tienda'=>array('mTienda','cTienda'),
		'reportes'=>array('mReportes','cReportes'),
		'detaprod'=>array('mDetaprod','cDetaprod'),
		'compra'=>array('mCompra','cCompra'),
		'fracciones'=>array('mFracciones','cFracciones'),
		'cobranza'=>array('mCobranza','cCobranza'),
		'facturacion'=>array('mFacturacion','cFacturacion'),
		'facturacion10'=>array('mFacturacion10','cFacturacion10'),
		'notaentre'=>array('mNotaentre','cNotaentre'),
		'deposito'=>array('mDeposito','cDeposito'),
		'clientecuenta'=>array('mClientecuenta','cClientecuenta'),
		'moneda'=>array('mMoneda','cMoneda'),
		'auditoria'=>array('mAuditoria','cAuditoria')
	);
# Instanciación de clases
$fn = new Funciones();
foreach($archivos as $ind=>$val) {
	foreach($val as $file) {
		require $ruta_acceso_archivos.'app/'.$ind.'/cls/'.$file.'.php';
		$ins = strtolower($file);
		$$ins = new $file();
	}
}
?>