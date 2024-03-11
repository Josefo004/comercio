<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Productos $model */

$this->title = 'Correo de Orden';
// dd($orden)
$imagenBase64 = $orden->CodigoQR;

$pos = strpos($imagenBase64, ';base64,');
if ($pos !== false) {
    $imagenBase64 = substr($imagenBase64, $pos + strlen(';base64,'));
}

$nroOrden = 'Orden-'.$orden->IdOrden;
$imagenBinaria = base64_decode($imagenBase64);
?>
<div class="container">
  <div class="card mb-3">
    <div class="card-body">
      <fieldset disabled>
        <div class="row mb-3">
          <div class="col-md-2">
            <label class="form-label"><strong>Código Comercio</strong></label>
            <input type="text" class="form-control form-control-sm" value="<?= $orden->CodigoPago ?>">
          </div>
          <div class="col-md-4">
            <label class="form-label"><strong>Nombre Completo</strong></label>
            <input type="text" class="form-control form-control-sm" value="<?= $orden->NombreCompleto ?>">
          </div>
          <div class="col-md-2">
            <label class="form-label"><strong>Celular</strong></label>
            <input type="text" class="form-control form-control-sm" value="<?= $orden->Celular ?>">
          </div>
          <div class="col-md-4">
            <label class="form-label"><strong>Email</strong></label>
            <input type="text" class="form-control form-control-sm" value="<?= $orden->Email ?>">
          </div>
        </div>
        <div class="row mb-4">
          <div class="col-md-4">
            <label class="form-label"><strong>Usuario</strong></label>
            <input type="text" class="form-control form-control-sm" value="<?= $orden->creador->NombreCompleto ?>">
          </div>
          <div class="col-md-3">
            <label class="form-label"><strong>Fecha Hora Solicitud</strong></label>
            <input type="text" class="form-control form-control-sm" value="<?= Yii::$app->formatter->asDate($orden->FechaCreacion, 'dd-MM-yyyy hh:mm:ss') ?>">
          </div>
          <div class="col-md-3">
            <label class="form-label"><strong>Estado</strong></label>
            <input type="text" class="form-control form-control-sm" value="<?= mb_strtoupper($orden->estado->Descripcion) ?>">
          </div>
          <div class="col-md-2">
            <label class="form-label"><strong>Comisión</strong></label>
            <input type="text" class="form-control form-control-sm" value="<?= $orden->CostoComision ?>">
          </div>
        </div>
      </fieldset>
      <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <strong>Productos Ordenandos</strong> 
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Código</th>
                                    <th>Talla</th>
                                    <th>Para</th>
                                    <th>Nombre Producto</th>
                                    <th>Imagen</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i = 0; $ttt = 0;
                                    foreach ($orden->detallesOrden as $item): 
                                    $i++;
                                    $ttt += $item['Total'];
                                ?>
                                    <tr>
                                        <th><?= $i ?></th>
                                        <td><small><?= $item['CodigoProducto'] ?></small></td>
                                        <td><small><?= $item['Talla'] ?></small></td>
                                        <td><small><?= $item['ProductoPara'] ?></small></td>
                                        <td><small><?= $item['NombreProducto'] ?></small></td>
                                        <td><?= Html::img($item->getImageUrl(), ['style' => 'width: 55px'])?></td>
                                        <td><?= $item['Precio'] ?></td>
                                        <td><?= $item['Cantidad'] ?></td>
                                        <th><?= $item['Total'] ?></th>
                                    </tr>
                                <?php 
                                    endforeach; 
                                    $ttt = number_format($ttt, 2);
                                ?>
                            </tbody>
                            <tfoot>
                                <th colspan="7"></th>
                                <th></th>
                                <th><?= $ttt ?></th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <strong>QR de Pago</strong>
                </div>
                <div class="card-body">
                    <picture>
                    <?php
                    if ($orden->CodigoEstado === 'A') {
                    ?>
                    <?= Html::img('img/gracias.png');?>
                    <?php
                    }
                    else {
                    ?>
                        <?php
                        $imagenHtml = '<img src="data:image/png;base64,' . base64_encode($imagenBinaria) . '" class="img-fluid" alt="Codigo QR">';
                        ($imagenBinaria) . '" download="'.$nroOrden.'">Descargar QR</a>';
                        echo $imagenHtml;
                        ?>
                    <?php
                    }
                    ?>
                    </picture>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><h4><strong>TOTAL</strong> <small><?= $orden->TotalOrden ?> <small>BOB</small></small></h4></li>
                </ul>
            </div>
        </div>
      </div>
    </div>
    <div class="card-footer">
      JOSE
    </div>
  </div>
  

</div>