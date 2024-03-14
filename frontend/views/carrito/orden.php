<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\Productos $model */

$this->title = 'Orden Realizada';
// dd($orden)
$imagenBase64 = $orden->CodigoQR;

$pos = strpos($imagenBase64, ';base64,');
if ($pos !== false) {
    $imagenBase64 = substr($imagenBase64, $pos + strlen(';base64,'));
}

$nroOrden = 'Orden-'.$orden->IdOrden;
$imagenBinaria = base64_decode($imagenBase64);
// $kk = base64_encode($imagenBinaria);
// dd($imagenBase64, $imagenBinaria, $kk);
?>
<div>
    <?php if (Yii::$app->session->hasFlash('success')): ?>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('error')): ?>
    <?php endif; ?>
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
                    <div class="col-md-3">
                        <label class="form-label"><strong>Usuario</strong></label>
                        <input type="text" class="form-control form-control-sm" value="<?= $orden->creador->NombreCompleto ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"><strong>Fecha Hora Solicitud</strong></label>
                        <input type="text" class="form-control form-control-sm" value="<?= Yii::$app->formatter->asDate($orden->FechaCreacion, 'dd-MM-yyyy hh:mm:ss') ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"><strong>Fecha Caducidad</strong></label>
                        <input type="text" class="form-control form-control-sm" value="<?= Yii::$app->formatter->asDate($orden->FechaCaducidad, 'dd-MM-yyyy hh:mm:ss') ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label"><strong>Estado</strong></label>
                        <input type="text" class="form-control form-control-sm" value="<?= mb_strtoupper($orden->estado->Descripcion) ?>">
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
                                                <td align="right"><?= $item['Total'] ?></td>
                                            </tr>
                                        <?php 
                                            endforeach; 
                                            $ttt = number_format($ttt, 2);
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="8" align="right">Total Productos</td>
                                            <td align="right">
                                                <strong><?= $ttt ?></strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="8" align="right">Comisión Bancaria</td>
                                            <td align="right">
                                                <strong><?= number_format($orden->CostoComision, 2) ?></strong>
                                            </td>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td colspan="8" align="right">Total</td>
                                            <td align="right">
                                                <strong><?= $orden->TotalOrden ?></strong>
                                            </td>
                                            <th></th>
                                        </tr>                                     
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-md-12">
                            <?php 
                                $bodytag = str_replace(";", "<br>", $orden->Observacion);
                                echo $bodytag; 
                            ?>
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
                                // Paso 3: Generar la etiqueta HTML de la imagen
                                $imagenHtml = '<img src="data:image/png;base64,' . base64_encode($imagenBinaria) . '" class="img-fluid" alt="Codigo QR">';
                                $enlaceDescarga = '<a class="btn btn-info btn-sm float-right" href="data:image/png;base64,' . base64_encode($imagenBinaria) . '" download="'.$nroOrden.'">Descargar QR</a>';
                                // Muestra la imagen HTML en tu vista
                                echo $imagenHtml;
                                echo $enlaceDescarga;
                                ?>
                            <?php
                            }
                            ?>
                            </picture>
                            <!-- <img class="card-img-top" src="..." alt="Card image QR"> -->
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><h4><strong>TOTAL</strong> <small><?= $orden->TotalOrden ?> <small>BOB</small></small></h4></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <?= Html::a('Imprimir Comprobante', ['pdf/comprobante', 'IdOrden' => $orden->IdOrden], ['class'=>'btn btn-primary float-right', 'target'=>'_blank']) ?>
            <!-- <?= Html::a('Mandar Correo', ['email/enviar-correo', 'IdOrden' => $orden->IdOrden], ['class'=>'btn btn-primary float-left', 'target'=>'_blank']) ?> -->
        </div>
    </div>
</div>
