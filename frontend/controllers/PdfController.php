<?php
namespace frontend\controllers;

use common\components\fpdf\FPDF;
use Yii;
use yii\web\Controller;

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
    private $empresa;
    private $requerimiento;
    private $usuario;
    private $fecha_hora;

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
        $this->SetFont('Arial','B',7);
        // Movernos a la derecha
        $this->Cell(17);
        $this->Cell(100,4, utf8_decode ('UNIVERSIDAD MAYOR REAL Y PONTIFICIA DE'),0,1,'L');
        $this->Cell(17);
        $this->Cell(100,4, utf8_decode ('SAN FRANCISCO XAVIER DE CHUQUISACA'),0,1,'L');

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
        $this->Ln(4);
        // $this->cabecera($cas);
        // Salto de línea
        $this->celda(25,18,'NRO. DE ORDEN', '');
        $this->celda(32,60,'NOMBRE COMPLETO', '');
        $this->celda(20,40,'CELULAR', '');
        $this->Ln();
        $this->celda(18,45,'EMAIL', '');
        $this->celda(20,60,'USUARIO', '');
        $this->celda(20,32,'F. SOLICITUD', '');
        $this->Ln();
        $this->celda(18,55,'ESTADO', '');
        $this->Ln();
        $this->Ln(1);


        $this->cabecera(10,'ID FRM.');
        $this->cabecera(20,'CARNET');
        $this->cabecera(40,'NOMBRE COMPLETO');
        $this->cabecera(17,'SEXO');
        $this->cabecera(18,'FECH. NAC.');
        $this->cabecera(10,'EDAD');
        $this->cabecera(15,'CELULAR');
        $this->cabecera(25,'MUNICIPIO');
        $this->cabecera(30,'NIV. ACADÉMICO');
        $this->cabecera(20,'IDIOMAS');
        $this->cabecera(37,'PROFESIONES');
        $this->cabecera(18,'FECH. REG.');
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
        // $this->Cell(72,4,'Usuario: '.$this->usuario,0,0,'L');
        $this->Cell(116,4,'Fecha Impresion: '.$this->fecha_hora,0,0,'C');
        $this->Cell(72,4,'Pag. '.$this->PageNo().' de {nb}',0,0,'R');
    }
}


class PdfController extends Controller
{
  public function actionPdf()
  {
    $this->layout = false;

    $pdf = new PDF('P','mm','Letter');
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Cell(40, 10, utf8_decode('¡Hola, mundo!'));
    $pdf->Output();
    exit;
  }
}
?>