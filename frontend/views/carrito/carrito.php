<?php

use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\Productos $model */

$this->title = 'Articulos del Carrito';
$carrito = Yii::$app->session->get('carrito');
$total = array_sum(array_column($carrito, 'Total'));
$total = number_format($total,2);
?>
<div>

    <h3><?= Html::encode($this->title) ?></h3>
    <div class="card mb-3" > 
        <div class="card-header">
            Listado
        </div>     
        <div class="card-body">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Talla</th>
                        <th>Para</th>
                        <th>Nombre Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $i = 0;
                        foreach ($carrito as $key => $item): 
                        $i++;
                    ?>
                        <tr>
                            <th><?= $i ?></th>
                            <td><?= $item['CodigoProducto'] ?></td>
                            <td><?= $item['Talla'] ?></td>
                            <td><?= $item['ProductoPara'] ?></td>
                            <td><?= $item['NombreProducto'] ?></td>
                            <td><?= $item['Precio'] ?></td>
                            <td><?= $item['Cantidad'] ?></td>
                            <td><?= $item['Total'] ?></td>
                            <td>
                                <?= Html::a('<span class="fa fa-trash-o"></span> Quitar', ['eliminar', 'id' => $key], [
                                    'class' => 'btn btn-danger btn-sm',
                                    'data' => [
                                        'confirm' => '¿Estás seguro de que quieres eliminar este elemento del Carrito?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                    <th><?= $total ?></th>
                    <th></th>
                </tfoot>
            </table>
        </div> 
        <div class="card-footer">
            <div class="col-md-12 text-right">
                <?= Html::a('<span class="fa fa-home"></span> Página Principal', ['site/index'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

</div>