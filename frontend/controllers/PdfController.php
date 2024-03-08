<?php
namespace frontend\controllers;

use common\components\fpdf\FPDF;
use Yii;
use yii\web\Controller;

class PdfController extends Controller
{
  public function actionPdf()
  {
    $this->layout = false;

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Cell(40, 10, utf8_decode('¡Hola, mundo!'));
    $pdf->Output();
    exit;
  }
}
?>