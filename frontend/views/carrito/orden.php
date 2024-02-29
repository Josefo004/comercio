<?php

use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\Productos $model */

$this->title = 'Orden Realizada';
// dd($orden)
?>
<div>
    <div class="card mb-3">
        <div class="card-body">
            <fieldset disabled>
                <div class="row mb-3">
                    <div class="col-md-2">
                        <label class="form-label"><strong>Nro. de Orden</strong></label>
                        <input type="text" class="form-control form-control-sm" value="<?= $orden->IdOrden ?>">
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
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label"><strong>Usuario</strong></label>
                        <input type="text" class="form-control form-control-sm" value="<?= $orden->creador->NombreCompleto ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><strong>Fecha Hora Solicitud</strong></label>
                        <input type="text" class="form-control form-control-sm" value="<?= $orden->FechaCreacion ?>">
                    </div>
                    <div class="col-md-4">
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
                                            $i = 0;
                                            foreach ($orden->detallesOrden as $item): 
                                            $i++;
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
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <strong>QR</strong>
                        </div>
                        <div class="card-body">
                            <img class="card-img-top" src="..." alt="Card image QR">
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><h5><strong>TOTAL</strong> <small><?= $orden->TotalOrden ?> Bs.</small></h5></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

</div>