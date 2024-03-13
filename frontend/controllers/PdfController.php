<?php
namespace frontend\controllers;

use common\models\Ordenes;
use common\components\fpdf\FPDF;
use yii\web\Controller;

date_default_timezone_set('America/La_Paz');

class PDF_MC_Table extends FPDF
{
    protected $widths;
    protected $aligns;

    function SetWidths($w)
    {
        // Set the array of column widths
        $this->widths = $w;
    }

    function SetAligns($a)
    {
        // Set the array of column alignments
        $this->aligns = $a;
    }

    function Row($data)
    {
        // Calculate the height of the row
        $nb = 0;
        for($i=0;$i<count($data);$i++)
            $nb = max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h = 4*$nb;
        // Issue a page break first if needed
        $this->CheckPageBreak($h);
        // Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            // Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            // Draw the border
            $this->Rect($x,$y,$w,$h);
            // Print the text
            $this->MultiCell($w,3,utf8_decode($data[$i]),0,$a);
            // Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        // Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
        // If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt)
    {
        // Compute the number of lines a MultiCell of width w will take
        if(!isset($this->CurrentFont))
            $this->Error('No font has been set');
        $cw = $this->CurrentFont['cw'];
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $wmax = ($w-2*$this->cMargin)*1000/$this->FontSize;
        $s = str_replace("\r",'',(string)$txt);
        $nb = strlen($s);
        if($nb>0 && $s[$nb-1]=="\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while($i<$nb)
        {
            $c = $s[$i];
            if($c=="\n")
            {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep = $i;
            $l += $cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i = $sep+1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }
}

class PDF extends PDF_MC_Table
{
    private $orden;
    private $usuario;
    private $fecha_hora;

    function inicio(object $ord, string $feho=null){
        $this->orden = $ord;
        $this->usuario = $ord->creador->Login;
        $this->fecha_hora = $feho;
    }

    function imagenQr ($orden, $y){
        if ($orden->CodigoEstado === 'A') {
            $this->Image('img/gracias.png', 170, $y, 37, 37);
        } 
        else{
            $imagenBase64 = $orden->CodigoQR;
            $pos = strpos($imagenBase64, ';base64,');
            if ($pos !== false) {
                $imagenBase64 = substr($imagenBase64, $pos + strlen(';base64,'));
            }
            $imagenBinaria = base64_decode($imagenBase64);
            $img2 = 'data:image/png;base64,'.base64_encode($imagenBinaria);
            $this->Image($img2, 165, $y, 45, 45, 'png');
        }
    }

    function celda($w1,$w2,$txt1,$txt2){
        $t1=utf8_decode ($txt1);
        $t2 = utf8_decode($txt2);
        $this->SetFillColor(230,230,230);
        $this->SetTextColor(0);
        $this->SetDrawColor(10,10,10);
        $this->SetLineWidth(.1);
        $this->SetFont('Arial','B',7);
        $this->Cell($w1,5,$t1,1,0,'L',true);
        $this->SetFont('Arial','',7);
        $this->Cell($w2,5,$t2,1,0,'L');
    }

    function celda2($w1,$w2,$txt1,$txt2){
        $t1=utf8_decode ($txt1);
        $t2 = utf8_decode($txt2);
        $this->SetFillColor(230,230,230);
        $this->SetTextColor(0);
        $this->SetDrawColor(10,10,10);
        $this->SetLineWidth(.1);
        $this->SetFont('Arial','B',7);
        $this->Cell($w1,5,$t1,1,0,'L',true);
        $this->SetFont('Arial','B',7);
        $this->Cell($w2,5,$t2,1,0,'R');
    }

    function cabecera($w1,$txt1){
        $t1=utf8_decode ($txt1);
        $this->SetFillColor(230,230,230);
        $this->SetTextColor(0);
        $this->SetDrawColor(10,10,10);
        $this->SetLineWidth(.1);
        $this->SetFont('Arial','B',7);
        $this->Cell($w1,5,$t1,1,0,'L',true);
    }

    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('img/escudo.png',10,5,17);
        // Arial bold 15
        $this->SetFont('Arial','B',5);
        // Movernos a la derecha
        $this->Cell(17);
        $this->Cell(100,4, utf8_decode ('UNIVERSIDAD MAYOR REAL Y PONTIFICIA DE SAN FRANCISCO'),0,1,'L');
        $this->Cell(17);
        $this->Cell(100,4, utf8_decode ('XAVIER DE CHUQUISACA'),0,1,'L');

        // Salto de línea
        $title = "COMPROBANTE";
        $this->SetFont('Arial','B',15);
        // Calculamos ancho y posición del título.
        $w = $this->GetStringWidth($title)+6;
        $this->SetX((215-$w)/2);
        // Colores de los bordes, fondo y texto
        $this->SetDrawColor(255,255,255);
        $this->SetFillColor(255,255,255);
        $this->SetTextColor(0,0,0);
        // Ancho del borde (1 mm)
        //$this->SetLineWidth(0);
        // Título
        $this->Cell($w,9,$title,1,1,'C',true);
        $this->Ln(5);
        // $this->cabecera($cas);
        // Salto de línea
        $this->celda(28,32,'CODIGO COMERCIO', $this->orden->CodigoPago);
        $this->celda(32,63,'NOMBRE COMPLETO', $this->orden->NombreCompleto);
        $this->celda(18,22,'CELULAR', $this->orden->Celular);
        $this->Ln();
        $this->Ln(1);
        $this->celda(10,55,'EMAIL', $this->orden->Email);
        $this->celda(15,60,'USUARIO', $this->orden->creador->NombreCompleto);
        $this->celda(13,42,'ESTADO', strtoupper($this->orden->estado->Descripcion));
        $this->Ln();
        $this->Ln(1);
        $FechaSolicitud = date('d-m-Y H:i', strtotime($this->orden->FechaCreacion));
        $this->celda(30,37,'FFECHA SOLICITUD', $FechaSolicitud);
        // $this->celda(25,20,'COMISION', $this->orden->CostoComision);
        // $this->celda(25,20,'TOTAL ORDEN', $this->orden->TotalOrden);
        $this->Ln();
        $this->Ln(3);

        $this->cabecera(10,'Nro.');
        $this->cabecera(20,'Código');
        $this->cabecera(38,'Talla');
        $this->cabecera(20,'Para');
        $this->cabecera(56,'Producto');
        $this->cabecera(17,'Precio');
        $this->cabecera(17,'Cantidad');
        $this->cabecera(17,'Total');
        
        $this->Ln();
    }

    // Pie de página
    function Footer()
    {

        // Posición: a 1 cm del final
        $this->SetY(-10);
        // Arial italic 8
        $this->SetFont('Arial','',6);
        // Número de página
        //$hoy = time() - (6 * 60 * 60);
        // $hoy = time();
        // $f = date('d-m-Y H:i:s',$hoy);

        //$f = " 20-01-2019 11:53:32";
        $this->Cell(50,4,'Usuario: '.$this->usuario,0,0,'L');
        $this->Cell(95,4,'Fecha Impresion: '.$this->fecha_hora,0,0,'C');
        $this->Cell(50,4,'Pag. '.$this->PageNo().' de {nb}',0,0,'R');
    }
}


class PdfController extends Controller
{
  public function actionComprobante($IdOrden = null)
  {
    $orden = Ordenes::find()
      ->joinWith('estado')
      ->joinWith('detallesOrden')
      ->joinWith('creador')
      ->where(['Ordenes.IdOrden' => $IdOrden])
      ->one();
    $detalle = $orden->detallesOrden;
    // dd($orden);
    $hoy = time();
    $f = date('d-m-Y H:i:s',$hoy);
    $pdf = new PDF('P','mm','Letter');
    $pdf->inicio($orden, $f);
    $pdf->SetMargins(10,7,10);
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 7);
    $pdf->SetWidths([10, 20, 38, 20, 56, 17, 17, 17]);
    $i = 0; $ttt = 0;
    foreach ($detalle as $valor) {
        $i++;
        $codigo = utf8_decode($valor['CodigoProducto']);
        $talla = utf8_decode(ucwords(strtolower($valor['Talla'])));
        $para = utf8_decode(ucwords(strtolower($valor['ProductoPara'])));
        $producto  = utf8_decode(ucwords(strtolower($valor['NombreProducto'])));
        $precio  = utf8_decode($valor['Precio']);
        $cantidad  = utf8_decode($valor['Cantidad']);
        $total  = utf8_decode($valor['Total']);
        $pdf->Row([$i, $codigo, $talla, $para, $producto, $precio, $cantidad, $total]);
        $ttt += $total;
    }
    $ttt = number_format($ttt, 2);
    $tcc = number_format($orden->CostoComision, 2);

    $pdf->SetWidths([178, 17]);
    $pdf->Cell(144);
    $pdf->celda2(34, 17, 'Total Productos', $ttt);
    $pdf->Ln();
    $pdf->Cell(144);
    $pdf->celda2(34, 17, 'Comisión Bancaria', $tcc);
    $pdf->Ln();
    $pdf->Cell(144);
    $pdf->celda2(34, 17, 'Total ', $orden->TotalOrden);
    $pdf->Ln();
    $pdf->Ln(2);
    $yy = $pdf->GetY();
    if ($yy+50 > 265) {
        $pdf->AddPage();
        $pdf->Ln(2);
        $yy = $pdf->GetY();
    }
    $pdf->imagenQr($orden, $yy);
    $pdf->Output('I','orden-'.$orden->IdOrden.'.pdf');
    exit;
  }
}
?>