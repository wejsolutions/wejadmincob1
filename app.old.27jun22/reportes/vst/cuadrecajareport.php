<?php 
require '../../../cfg/base.php';
require_once("../../../lib/dompdf/dompdf_config.inc.php");
$cuadre_rows = $mreportes->cuadrecaja($_GET['f_ini'],$_GET['f_fin'],$_GET['dealer']);
$rowtcc = $mreportes->totalcuadrecaja($_GET['f_ini'],$_GET['f_fin'],$_GET['dealer']);
$rowtcca = $mreportes->totalcuadrecajaanulada($_GET['f_ini'],$_GET['f_fin'],$_GET['dealer']);
$rowtccr = $mreportes->totalcuadrecajareal($_GET['f_ini'],$_GET['f_fin'],$_GET['dealer']);
$tienda_rows = $mtienda->poride($_SESSION['s_usua_tienda']);
//$cuadre_tipospag_rows=$mreportes->TotalCuadrereportippag($_GET['f_ini'],$_GET['f_fin'],$_GET['caja']);
//$cuadre_puntoven_rows=$mreportes->TotalCuadrereportippag($_GET['f_ini'],$_GET['f_fin'],$_GET['caja']);


//$f_inirp=$fun->fecha($_GET['f_ini']);
//$f_finrp=$fun->fecha($_GET['f_fin']);
$f_inirp=$_GET['f_ini'];
$f_finrp=$_GET['f_fin'];
$filas=0;


$enc = '<div class="logo_reporte"> <img src="../../../img/'.$tienda_rows[0]->empresa_encabezado.'" alt="" align="left"> </div>';


$pie = '
<script type="text/php">
  $logo_inf = $pdf->open_object();
  $w = $pdf->get_width();
  $h = $pdf->get_height();
  $img_piew=40; // Ancho de la img
  $img_pieh=50; //Alto de la img
  $pdf->image("../../../img/'.$tienda_rows[0]->empresa_pie.'","jpg",730,600,$img_piew,$img_pieh);
  $pdf->close_object();
  $pdf->add_object($logo_inf,"all");
</script>';


$datos_cliente= '';
$html = '';
$html .= '<meta charset="utf-8">';
$html .= '<link href="../../../css/print.css" rel="stylesheet" type="text/css">';
$html .= '<p></p>';
$html .= $enc;
$html .= $pie;
$html .='<br>'.'<br>'.'<br>'.
  '<span class="titulo_cuadre_caja">Arqueo diario de Caja principal del: '.$f_inirp.' hasta: '.$f_finrp.'</span> <br>'.
  '<div id="contenido">'. #Inicio contenido
    '<table class="tabla7">'.
      '<tr>'.
        '<td><b>Cliente</b></td>'.
        '<td><b>Fact. o Nota Ent.</b></td>'.
        '<td><b>Fecha</b></td>'.
        '<td><b>Forma Pago</b></td>'.
        '<td><b>Efectivo</b></td>'.
        '<td><b>T. D.</b></td>'.
        '<td><b>T. C.</b></td>'.
        '<td><b>T. A.</b></td>'.
        '<td><b>Cheque</b></td>'.
        '<td><b>Transf.</b></td>'.
        '<td><b>Total</b></td>'.
        '<td><b>Status</b></td>'.
      '</tr>';
      
    foreach($cuadre_rows as $cuadre) {

       $formapago=($cuadre->formapago==0)?'CONTADO':'<div class="status_fact">CREDITO</div>'; 
       $anulada=($cuadre->anulada==0)?'<font color="#008000">ACTIVA</font>':'<div class="status_fact"><font color="#FF00FF">ANULADA</font></div>'; 

      $html .= ''.
      '<tr>'.
        '<td width="23%">'.$cuadre->clien_nombre1.' '.$cuadre->clien_nombre2.' '.$cuadre->clien_apelli1.' '.$cuadre->clien_apelli2.'</td>'.
        '<td>'.$cuadre->fact_nota.'</td>'.
        '<td align="center">'.date('d-m-Y',strtotime($cuadre->fecha)).'</td>'.
        '<td align="center">'.$formapago.'</td>'.
        '<td align="right">'.number_format($cuadre->efectivo, 2, ',', '.').'</td>'.
        '<td align="right">'.number_format($cuadre->debito, 2, ',', '.').'</td>'.
        '<td align="right">'.number_format($cuadre->credito, 2, ',', '.').'</td>'.
        '<td align="right">'.number_format($cuadre->alimentacion, 2, ',', '.').'</td>'.
        '<td align="right">'.number_format($cuadre->cheque, 2, ',', '.').'</td>'.
        '<td align="right">'.number_format($cuadre->transferencia, 2, ',', '.').'</td>'.
        '<td align="right"><b>'.number_format($cuadre->total, 2, ',', '.').'</b></td>'.
        '<td align="center">'.$anulada.'</td>'.
      '</tr>';
      if($filas>19){
        $filas=0;
        $html .='</table>';
        $html .= '</div>'; #Fin Cuadre caja
        $html .= '<div class="salto"></div>'; #Salto de página
        $html .='<span class="titulo2"></span>'.
                 '<br>'.'<br>'.'<br>'.'<br>'.
                 '<span class="titulo_cuadre_caja">Arqueo Diario de Caja Principal del: '.$f_inirp.' Hasta: '.$f_finrp.'</span> <br>'.
                 '<div id="contenido">'. #Inicio contenido
                 '<table class="tabla7">'.
                  '<tr>'.
                    '<td><b>Cliente</b></td>'.
                    '<td><b>Fact. o Nota Ent.</b></td>'.
                    '<td><b>Fecha</b></td>'.
                    '<td><b>Forma Pago</b></td>'.
                    '<td><b>Efectivo</b></td>'.
                    '<td><b>T. D.</b></td>'.
                    '<td><b>T. C.</b></td>'.
                    '<td><b>T. A.</b></td>'.
                    '<td><b>Cheque</b></td>'.
                    '<td><b>Transf.</b></td>'.
                    '<td><b>Total</b></td>'.
                    '<td><b>Status</b></td>'.
                  '</tr>';
      }
      
      $filas++;
    }

$html .='<tr bgcolor="#80FFC0">
          <td></td>
          <td></td>
          <td></td>
          <td align="center"><b>TOTAL:</b></td>
          <td align="right"><b>'.number_format($rowtcc[0]->Tefectivo, 2, ',', '.').'</b></td>
          <td align="right"><b>'.number_format($rowtcc[0]->Tdebito, 2, ',', '.').'</b></td>
          <td align="right"><b>'.number_format($rowtcc[0]->Tcredito, 2, ',', '.').'</b></td>
          <td align="right"><b>'.number_format($rowtcc[0]->Talimentacion, 2, ',', '.').'</b></td>
          <td align="right"><b>'.number_format($rowtcc[0]->Tcheque, 2, ',', '.').'</b></td>
          <td align="right"><b>'.number_format($rowtcc[0]->Ttransferencia, 2, ',', '.').'</b></td>
          <td align="right"><b>'.number_format($rowtcc[0]->Ttotal, 2, ',', '.').'</b></td>
          <td align="center"></td>
        </tr>
        <tr bgcolor="#FF8080">
          <td></td>
          <td></td>
          <td></td>
          <td align="center"><b>TOTAL ANU.:</b></td>
          <td align="right"><b>'.number_format($rowtcca[0]->Tefectivo, 2, ',', '.').'</b></td>
          <td align="right"><b>'.number_format($rowtcca[0]->Tdebito, 2, ',', '.').'</b></td>
          <td align="right"><b>'.number_format($rowtcca[0]->Tcredito, 2, ',', '.').'</b></td>
          <td align="right"><b>'.number_format($rowtcca[0]->Talimentacion, 2, ',', '.').'</b></td>
          <td align="right"><b>'.number_format($rowtcca[0]->Tcheque, 2, ',', '.').'</b></td>
          <td align="right"><b>'.number_format($rowtcca[0]->Ttransferencia, 2, ',', '.').'</b></td>
          <td align="right"><b>'.number_format($rowtcca[0]->Ttotal, 2, ',', '.').'</b></td>
          <td align="center"></td>
        </tr>
        <tr bgcolor="#80FFFF">
          <td></td>
          <td></td>
          <td></td>
          <td align="center"><b>TOTAL REAL:</b></td>
          <td align="right"><b>'.number_format($rowtccr[0]->Tefectivo, 2, ',', '.').'</b></td>
          <td align="right"><b>'.number_format($rowtccr[0]->Tdebito, 2, ',', '.').'</b></td>
          <td align="right"><b>'.number_format($rowtccr[0]->Tcredito, 2, ',', '.').'</b></td>
          <td align="right"><b>'.number_format($rowtccr[0]->Talimentacion, 2, ',', '.').'</b></td>
          <td align="right"><b>'.number_format($rowtccr[0]->Tcheque, 2, ',', '.').'</b></td>
          <td align="right"><b>'.number_format($rowtccr[0]->Ttransferencia, 2, ',', '.').'</b></td>
          <td align="right"><b>'.number_format($rowtccr[0]->Ttotal, 2, ',', '.').'</b></td>
          <td align="center"></td>
        </tr>';

$html .=    '</table>'.
  '</div>';

//echo $html;
$dompdf = new DOMPDF();
$dompdf->set_paper("letter","landscape"); 
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("cuadrecajareport_".$f_inirp.'_'.$f_finrp.".pdf");
?>