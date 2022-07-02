<?php 
require '../../../cfg/base.php';
require_once("../../../lib/dompdf/dompdf_config.inc.php");
$cuadre_rows = $mreportes->cuadrecaja($_GET['f_ini'],$_GET['f_fin']);
//$cuadre_tipospag_rows=$mreportes->TotalCuadrereportippag($_GET['f_ini'],$_GET['f_fin'],$_GET['caja']);
//$cuadre_puntoven_rows=$mreportes->TotalCuadrereportippag($_GET['f_ini'],$_GET['f_fin'],$_GET['caja']);


//$f_inirp=$fun->fecha($_GET['f_ini']);
//$f_finrp=$fun->fecha($_GET['f_fin']);
$f_inirp=$_GET['f_ini'];
$f_finrp=$_GET['f_fin'];
$filas=0;


$enc = '<div class="logo_reporte"> <img src="../../../img/logo.jpg" alt="" align="left"> </div>';


$pie = '
<script type="text/php">
  $logo_inf = $pdf->open_object();
  $w = $pdf->get_width();
  $h = $pdf->get_height();
  $img_piew=40; // Ancho de la img
  $img_pieh=50; //Alto de la img
  $pdf->image("../../../img/pie.jpg","jpg",730,600,$img_piew,$img_pieh);
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
  '<span class="titulo_cuadre_caja">Arqueo Diario de Caja Principal del: '.$f_inirp.' Hasta: '.$f_finrp.'</span> <br>'.
  '<div id="contenido">'. #Inicio contenido
  '<table class="tabla7">'.
    '<tr>'.
      '<td><b>Cliente</b></td>'.
      '<td><b>Nro. Factura</b></td>'.
      '<td><b>Tipo de Pago</b></td>'.
      '<td><b>Caja</b></td>'.
      '<td><b>Status</b></td>'.
      '<td><b>Total</b></td>'.
    '</tr>';
    foreach($cuadre_rows as $cuadre) {
       $statusfact=($cuadre->fact_anulada==0)?'ACTIVA':'<div class="status_fact">ANULADA</div>'; 
       $totalpago=($cuadre->fact_anulada==0)? $cuadre->total:0; 
       $nrofact=($cuadre->fact_ide!='') ? $cuadre->fact_ide : 'ABONO';
         
         if($cuadre->bancos_nombre !=null){
                 $cuadrebanconomb='-'.$cuadre->bancos_nombre;
          }else{
                 $cuadrebanconomb="";
          }

      $html .= ''.
      '<tr>'.
        '<td>'.$cuadre->pacien_nomraz.'</td>'.
        '<td>'.$nrofact.'</td>'.
        '<td>'.$cuadre->formpagos_nombre.$cuadrebanconomb.'</td>'.
        '<td>'.$cuadre->pago_caja.'</td>'.
        '<td>'.$statusfact.'</td>'.
        '<td>'.number_format($totalpago, 2, ',', '.').'</td>'.
      '</tr>';
      if($filas>23){
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
                    '<td><b>Paciente</b></td>'.
                    '<td><b>Nro. Factura</b></td>'.
                    '<td><b>Tipo de Pago</b></td>'.
                    '<td><b>Caja</b></td>'.
                    '<td><b>Status</b></td>'.
                    '<td><b>Total</b></td>'.
                  '</tr>';
      }
      
      $filas++;
    }

$html .= '<tr>'.
         '<th colspan="5" class="izq">Total de Caja:</th>'.
         '<td></td>'.
         '</tr>'.
         '</table>';

$html .= '<table class="tabla7">'; 

  foreach($cuadre_tipospag_rows as $cuadre_tipospag) { 
          
          if($cuadre_tipospag->ptoventa_descrip!=null){
                 $cuadrepunto=$cuadre_tipospag->ptoventa_descrip;
          }else{
                 $cuadrepunto="";
          }
         
          if($cuadre_tipospag->formpagos_nombre=='T. Débito'){
               $porcetd=$cuadre_tipospag->total_porcentd;
          }else{
              $porcetd=0;
          }
          
          if($cuadre_tipospag->formpagos_nombre=='T. Crédito'){
               $porcetc=$cuadre_tipospag->total_porcentc;
          }else{
              $porcetc=0;
          }

         $html .= '<tr>';
         $html .= '<td><b>'.$cuadrepunto.' '.$cuadre_tipospag->formpagos_nombre.' '.$cuadre_tipospag->pago_caja.'</b></td>';
         $html .= '<td>'.number_format($cuadre_tipospag->total, 2, ',', '.').'</td>';
         $html .= '<td><b>% T/D</b></td>';
         $html .= '<td>'.number_format($porcetd, 2, ',', '.').'</td>';
         $html .= '<td><b>% T/C</b></td>';
         $html .= '<td>'.number_format($porcetc, 2, ',', '.').'</td>';
         $html .= '</tr>';
  }  

         //$html .='</table>';

      if($filas>23){
        $filas=0;
        $html .='</table>';
        $html .= '</div>'; #Fin Cuadre caja
        $html .= '<div class="salto"></div>'; #Salto de página
        $html .='<span class="titulo2">Cuadre de Caja</span>'.
                 '<br>'.'<br>'.'<br>'.'<br>'.
                 '<span class="titulo_cuadre_caja">Arqueo Diario de Caja Principal del: '.$f_inirp.' Hasta: '.$f_finrp.'</span> <br>'.
                 '<div id="contenido">'. #Inicio contenido
                 '<table class="tabla7">'.
                  '<tr>'.
                    '<td><b>Paciente</b></td>'.
                    '<td><b>Abono</b></td>'.
                    '<td><b>Tipo de Pago</b></td>'.
                    '<td><b>Caja</b></td>'.
                    '<td><b>Status</b></td>'.
                    '<td><b>Total</b></td>'.
                  '</tr>';
      }
//echo $html;
$dompdf = new DOMPDF();
$dompdf->set_paper("letter","portrait"); 
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("cuadrecajareport_".$f_inirp.'_'.$f_finrp.".pdf");
?>