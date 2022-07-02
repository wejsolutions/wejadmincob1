<?php 
require '../../../cfg/base.php';
require_once("../../../lib/dompdf/dompdf_config.inc.php");
$factura_rows = $mfacturacion->poridefact($_GET['fact']);
$facturadeta_rows = $mfacturacion->poridedetafacimp($_GET['fact']);
$facturadeta_rows1 = $mfacturacion->poridedetafacimp1($_GET['fact']);
$fact=$_GET['fact'];

$enc =''.
  '<span class="factura"></span>'.
  '<div id="Encabezado">'. #Inicio Encabezado
    '<table class="tabla7" width="100%">'.
      '<tr>'.
        '<td align="left"><b>Fecha:</b></td><td align="left">'.date('d-m-Y',strtotime($factura_rows[0]->fact_fecha)).'</td>'.
      '</tr>'.
      '<tr>'.
        '<td align="left"><b>R.I.F.:</b></td><td width="80%">'.$factura_rows[0]->clien_tipcli.' '.$factura_rows[0]->clien_numiden.'</td>'.
      '</tr>'.
      '<tr>'.
        '<td align="left"><b>Cliente:</b></td><td width="80%">'.$factura_rows[0]->clien_nombre1.' '.$factura_rows[0]->clien_nombre2.' '.$factura_rows[0]->clien_apelli1.' '.$factura_rows[0]->clien_apelli2.'</td>'.
      '</tr>'.
    '</table>'.
  '</div>';

$pie = ''.
  '<div id="Pie">'. #Inicio Pie
    '<table class="tabla7" width="100%">'.
      '<tr>'.
        '<td align="right" width="80%"><b>Sub. Total BsF.:</b></td><td align="right">'.number_format($factura_rows[0]->fact_sub_totalexe, 2, ',', '.').'</td>'.
      '</tr>'.
      '<tr>'.
        '<td align="right"><b>I.V.A. BsF.:</b></td><td align="right">'.number_format($factura_rows[0]->fact_sub_totaliva, 2, ',', '.').'</td>'.
      '</tr>'.
      '<tr>'.
        '<td align="right"><b>Total General BsF.:</b></td><td align="right"><b>'.number_format($factura_rows[0]->fact_total_general, 2, ',', '.').'</b></td>'.
      '</tr>'.
    '</table>'.
  '</div>';

//$datos_cliente= '';
$cuerpo =''.
  '<div id="contenido">'.
    '<table class="tabla7">'.
      '<tr>'.
        '<td ><b>Producto</b></td>'.
        '<td align="center"><b>Cant.</b></td>'.
        '<td align="center"><b>Precio</b></td>'.
        '<td align="center"><b>Monto</b></td>'.
      '</tr>';
      
    foreach($facturadeta_rows as $detafact) {
      $cuerpo .= ''.
      '<tr>'.
        '<td align="left">'.$detafact->produc_descrip.'</td>'.
        '<td align="center">'.$detafact->factdeta_cant.'</td>'.
        '<td align="right">'.number_format($detafact->factdeta_precio, 2, ',', '.').'</td>'.
        '<td align="right"><b>'.number_format($detafact->factdeta_monto, 2, ',', '.').'</b></td>'.
      '</tr>';
    }
    foreach($facturadeta_rows1 as $detafact1) {
      $cuerpo .= ''.
      '<tr>'.
        '<td align="left">'.$detafact1->produc_descrip.' '.$detafact1->detaprod_imei.'</td>'.
        '<td align="center">'.$detafact1->factdeta_cant.'</td>'.
        '<td align="right">'.number_format($detafact1->factdeta_precio, 2, ',', '.').'</td>'.
        '<td align="right"><b>'.number_format($detafact1->factdeta_monto, 2, ',', '.').'</b></td>'.
      '</tr>';
    }
$cuerpo .= '</table>'.
  '</div>';

$html = '';
$html .= '<meta charset="utf-8">';
$html .= '<link href="../../../css/print.css" rel="stylesheet" type="text/css">';
$html .= ''.
'<table width="100%">'.
      '<tr><td width="45%">'.$enc.'</td><td width="10%"></td><td width="45%">'.$enc.'</td></tr>'.
      '<tr><td width="45%">'.$cuerpo.'</td><td width="10%"></td><td width="45%">'.$cuerpo.'</td></tr>'.
      '<tr><td width="45%">'.$pie.'</td><td width="10%"></td><td width="45%">'.$pie.'</td></tr>';
$html .= '</table>';

$dompdf = new DOMPDF();
$dompdf->set_paper("letter","portrait"); 
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("factura_".$fact.".pdf");
?>