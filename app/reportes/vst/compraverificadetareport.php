<?php 
require '../../../cfg/base.php';
require_once("../../../lib/dompdf/dompdf_config.inc.php");
$enccom_rows = $mcompra->poridecompra($_GET['fact']);
$detcom_rows = $mcompra->listacompraverificadeta($_GET['fact']);
$fact=$_GET['fact'];

$enc =''.
  '<br><span class="factura"></span>'.
  '<div id="Encabezado">'. #Inicio Encabezado
    '<table class="tabla7" width="100%">'.
      '<tr>'.
        '<td align="left" width="20%"><b>Factura:</b></td><td align="left" width="15%">'.$enccom_rows[0]->compra_ide_tienda.'</td>'.
        '<td align="left" width="20%"><b>Nota de Entrega:</b></td><td align="left" width="45%">'.$enccom_rows[0]->compra_control_tienda.'</td>'.
      '</tr>'.
      '<tr>'.
        '<td align="left"><b>Fecha de Compra:</b></td><td align="left">'.date('d-m-Y',strtotime($enccom_rows[0]->compra_fecha)).'</td>'.
        '<td align="left"><b>Fecha de Registro:</b></td><td align="left">'.date('d-m-Y',strtotime($enccom_rows[0]->compra_fecha_registro)).'</td>'.
      '</tr>'.
      '<tr>'.
        '<td align="left"><b>R.I.F.:</b></td><td>'.$enccom_rows[0]->clien_tipcli.'-'.$enccom_rows[0]->clien_numiden.'</td>'.
        '<td align="left"><b>Proveedor:</b></td><td>'.$enccom_rows[0]->clien_nombre1.' '.$enccom_rows[0]->clien_nombre2.' '.$enccom_rows[0]->clien_apelli1.' '.$enccom_rows[0]->clien_apelli2.'</td>'.
      '</tr>'.
      '<tr>'.
        '<td align="left"><b>SubTotal BsF.:</b></td><td align="left">'.number_format($enccom_rows[0]->compra_sub_totalexe, 2, ',', '.').'</td>'.
        '<td align="left"><b>I.V.A. BsF.:</b></td><td align="left">'.number_format($enccom_rows[0]->compra_sub_totaliva, 2, ',', '.').'</td>'.
      '</tr>'.
      '<tr>'.
        '<td align="left"><b></b></td><td align="left"></td>'.
        '<td align="left"><b>Total BsF.:</b></td><td align="left"><b>'.number_format($enccom_rows[0]->compra_total_general, 2, ',', '.').'</b></td>'.
      '</tr>'.
    '</table>'.
  '</div>';

$pie = '';

//$datos_cliente= '';
$cuerpo =''.
  '<div id="contenido">'.
    '<table class="tabla7" width="100%">'.
      '<tr>'.
        '<td width="20%"><b>Producto</b></td>'.
        '<td width="20%" align="center"><b>Marca</b></td>'.
        '<td width="20%" align="center"><b>Modelo</b></td>'.
        '<td width="60%" align="center"><b>Serial o IMEI</b></td>'.
      '</tr>';
      
    foreach($detcom_rows as $detcom) {
      $cuerpo .= ''.
      '<tr>'.
        '<td align="left">'.$detcom->produc_descrip.'</td>'.
        '<td align="center">'.$detcom->produc_marca.'</td>'.
        '<td align="center">'.$detcom->produc_modelo.'</td>'.
        '<td align="center">'.$detcom->detaprod_imei.'</td>'.
      '</tr>';
    }
$cuerpo .= '</table>'.
  '</div>';

$html = '';
$html .= '<meta charset="utf-8">';
$html .= '<link href="../../../css/print.css" rel="stylesheet" type="text/css">';
$html .= ''.
'<table width="100%">'.
      '<tr><td width="100%">'.$enc.'</td></tr>'.
      '<tr><td width="100%">'.$cuerpo.'</td></tr>'.
      '<tr><td width="100%">'.$pie.'</td></tr>';
$html .= '</table>';

$dompdf = new DOMPDF();
$dompdf->set_paper("letter","portrait"); 
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("facturacompra_".$fact.".pdf");
?>