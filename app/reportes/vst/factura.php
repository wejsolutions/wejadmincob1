<?php 
require '../../../cfg/base.php';
require_once("../../../lib/dompdf/dompdf_config.inc.php");
$factura_rows = $mfacturacion->poridefact($_GET['fact']);
$facturadeta_rows = $mfacturacion->poridedetafacimp($_GET['fact']);
$facturadeta_rows1 = $mfacturacion->poridedetafacimp1($_GET['fact']);
$fact=$_GET['fact'];
$condet=count($facturadeta_rows)+count($facturadeta_rows1);
$nrofact=sprintf("%010d",$factura_rows[0]->fact_ide_tienda);
$impuesto12=0;
$impuesto8=0;
$impuesto0=0;
$baseimponible=0;
$exento=0;

$enc ='<br><br>'.
  '<table class="tabla_dat_cliente">'.
 '<tr>'.
   '<td><br><br></td>'.
  '</tr>'.
  '<tr>'.
   '<td><span><b>Nro Factura: </b>'.trim($nrofact).'</span></td>'.
  '</tr>'.
   '<tr>'.
    '<td><span>Fecha:'.' '.date_format(date_create($factura_rows[0]->fact_fecha), 'd-m-Y').'</span></td>'.
  '</tr>'.
'</table>';

$datos_cliente= '<table class="tabla1r" width="100%">'.
   '<tr>'.
    '<td width="65%" align="left"><span class="titulo_segundario"><b>Nombre o Razon Social: </b>'.' '.substr ($factura_rows[0]->clien_nombre1.' '.$factura_rows[0]->clien_nombre2.' '.$factura_rows[0]->clien_apelli1.' '.$factura_rows[0]->clien_apelli2,0,27).'</span></td>'.
    '<td width="35%" align="right"><span class="titulo_segundario" align="right">RIF:'.' '.$factura_rows[0]->clien_tipcli.' '.$factura_rows[0]->clien_numiden.'</span></td>'.
  '</tr>'.
  '<tr>'.
    '<td><span class="titulo_segundario">Direcci&oacute;n: '.' '.$factura_rows[0]->clien_direcci.'</span></td>'.
    '<td><span class="titulo_segundario">Tel&eacute;fono: '.$factura_rows[0]->clien_telmovi.'</span></td>'.'</tr>'.
'</table>';

//$datos_cliente= '';
$cuerpo =''.
  '<div id="contenido">'.
    '<table class="tabla2r">'.
      '<tr>'.
        '<td width="10%"><b>Cantidad</b></td>'.
        '<td width="50%" align="center"><b>Descripcion</b></td>'.
        '<td width="15%" align="center"><b>Precio Unitario</b></td>'.
        '<td width="15%" align="center"><b>Sub. Total</b></td>'.
        '<td width="10%" align="center"><b>IVA</b></td>'.
      '</tr>';
      
    foreach($facturadeta_rows as $detafact) {
      if ($detafact->produc_impuesto==12) { $impuesto12=$impuesto12+$detafact->Impuesto; 
        $baseimponible=$baseimponible+$detafact->Base_Imponible; }
      elseif ($detafact->produc_impuesto==8) { $impuesto8=$impuesto8+$detafact->Impuesto; 
        $baseimponible=$baseimponible+$detafact->Base_Imponible; }
      elseif ($detafact->produc_impuesto==0) { $impuesto0=$impuesto0+$detafact->Impuesto; 
        $exento=$exento+$detafact->Base_Imponible; }

      if ($detafact->produc_unidmed_abrevia!="na") { $unidad_med=$detafact->produc_unidmed_abrevia;
      } else { $unidad_med=""; }

      $cuerpo .= ''.
      '<tr>'.
        '<td width="10%" align="left">'.$detafact->factdeta_cant.' '.$unidad_med.'</td>'.
        '<td width="50%" align="center">'.substr ($detafact->produc_descrip,0,42).'</td>'.
        '<td width="15%" align="right">'.number_format(($detafact->Base_Imponible/$detafact->factdeta_cant), 2, ',', '.').'</td>'.
        '<td width="15%" align="right"><b>'.number_format($detafact->Base_Imponible, 2, ',', '.').'</b></td>'.
        '<td width="10%" align="right"><b>'.$detafact->produc_impuesto.'%'.'</b></td>'.
      '</tr>';
    }
    foreach($facturadeta_rows1 as $detafact1) {
      if ($detafact1->produc_impuesto==12) { $impuesto12=$impuesto12+$detafact1->Impuesto; 
        $baseimponible=$baseimponible+$detafact1->Base_Imponible; }
      elseif ($detafact1->produc_impuesto==8) { $impuesto8=$impuesto8+$detafact1->Impuesto; 
        $baseimponible=$baseimponible+$detafact1->Base_Imponible; }
      elseif ($detafact1->produc_impuesto==0) { $impuesto0=$impuesto0+$detafact1->Impuesto; 
        $exento=$exento+$detafact1->Base_Imponible; }
      $cuerpo .= ''.
      '<tr>'.
        '<td align="left">'.substr ($detafact1->produc_descrip,0,30).' '.$detafact1->detaprod_imei.'</td>'.
        '<td align="center">'.$detafact1->factdeta_cant.' '.$unidad_med.'</td>'.
        '<td align="right">'.number_format(($detafact1->factdeta_precio/$detafact1->factdeta_cant), 2, ',', '.').'</td>'.
        '<td align="right"><b>'.number_format($detafact1->Base_Imponible, 2, ',', '.').'</b></td>'.
        '<td align="right"><b>'.$detafact1->produc_impuesto.'%'.'</b></td>'.
      '</tr>';
    }
  for ($i = $condet; $i <= 10; $i++) {
      $cuerpo .= ''.
      '<tr>'.
        '<td width="10%" align="left">&nbsp;</td>'.
        '<td width="50%" align="center">&nbsp;</td>'.
        '<td width="15%" align="right">&nbsp;</td>'.
        '<td width="15%" align="right"><b>&nbsp;</b></td>'.
        '<td width="10%" align="right"><b>&nbsp;</b></td>'.
      '</tr>';
    }
$cuerpo .= '</table>'.
  '</div>';

$pie = ''.
 '<div id="Pie">'. #Inicio Pie
  '<table class="tabla3r">'.
     '<tr>'.
      '<th colspan="4">Monto Total Exento o Exonerado Bs.:</th>'.
      '<td>'.number_format($exento, 2, ',', '.').'</td>'.
     '</tr>'. 
     '<tr>'.
      '<th colspan="4">Monto Total de la Base Imponible Bs.:</th>'.
      '<td>'.number_format($baseimponible, 2, ',', '.').'</td>'.
     '</tr>'. 
     '<tr>'.
      '<th colspan="4">Sub-Total Bs.:</th>'.
      '<td>'.number_format($exento+$baseimponible, 2, ',', '.').'</td>'.
     '</tr>'.
     '<tr>'. 
      '<th colspan="4">IVA '.'8'.'% Bs.:</th>'.
      '<td>'.number_format($impuesto8, 2, ',', '.').'</td>'.
     '</tr>'. 
     '<tr>'. 
      '<th colspan="4">IVA '.'12'.'% Bs.:</th>'.
      '<td>'.number_format($impuesto12, 2, ',', '.').'</td>'.
     '</tr>'. 
     '<tr>'. 
      '<th colspan="4">Total Bs.:</th>'.
      '<td><borde_supe>'.number_format($factura_rows[0]->fact_total_general, 2, ',', '.').'</borde_supe></td>'.
    '</tr>'. 
  '</table>'.
 '</div>';

$html = '';
$html .= '<meta charset="utf-8">';
$html .= '<link href="../../../css/print.css" rel="stylesheet" type="text/css">';
$html .= ''.
'<table width="100%">'.
      '<tr><td width="100%">'.$enc.$datos_cliente.'</td></tr>'.
      '<tr><td width="100%">'.$cuerpo.'</td></tr>'.
      '<tr><td width="100%">'.$pie.'</td></tr>'.
      '<tr><td width="100%"><b>&nbsp;</b></td></tr>'.
      '<tr><td width="100%"><b>&nbsp;</b></td></tr>'.
      '<tr><td width="100%"><b>&nbsp;</b></td></tr>'.
      '<tr><td width="100%"><b>&nbsp;</b></td></tr>'.
      '<tr><td width="100%"><b>&nbsp;</b></td></tr>'.
      '<tr><td width="100%">'.$enc.$datos_cliente.'</td></tr>'.
      '<tr><td width="100%">'.$cuerpo.'</td></tr>'.
      '<tr><td width="100%">'.$pie.'</td></tr>';
$html .= '</table>';

//echo $html;
$dompdf = new DOMPDF();
$dompdf->set_paper("legal","portrait"); 
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("factura_".$fact.".pdf");
?>