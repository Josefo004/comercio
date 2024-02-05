<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Productos $model */

$this->title = $model->IdProducto;
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="productos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'IdProducto' => $model->IdProducto], ['class' => 'btn btn-primary']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'IdProducto',
            'CodigoProducto',
            [
                'attribute' => 'idCategoriaGenero.Descripcion',
                'label' => 'Producto Para',
            ],
            [
                'attribute' => 'idCategoriaProducto.Descripcion',
                'label' => 'Tipo Producto',
            ],
            
            'NombreProducto',
            'Descripcion:html',
            [
                'attribute' => 'Imagen',
                'format' => ['html'],
                'value' => fn() => Html::img($model->getImageUrl(), ['style' => 'width: 50px']),
            ],
            'Precio',
            'PrecioPreventa',
            'FechaCaducidadPreVenta',
            'PrecioReserva',
            'FechaCaducidadReserva',
            'CantidadLimite',
            'CantidadVendidos',
            [
                'attribute' => 'Publicado',
                'format' => 'html',
                'value' => fn() => Html::tag('span', $model->Publicado ? 'Publicado' : 'Sin Publicar', [
                    'class' => $model->Publicado ? 'badge badge-success' : 'badge badge-danger'
                ]),
            ],
            'FechaHoraRegistro',
            'FechaHoraActualizacion',
            'CodigoUsuarioCreacion',
            'CodigoUsuarioActualizacion',
        ],
    ]) ?>

    <table class="table table-sm table-striped ">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Talla</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            //dd($tallas);
            $i = 0;
            foreach ($tallas as $valor) {
            $i++;
            ?>
            <tr>
                <th scope="row"><?= $i ?></th>
                <td><?= $valor->IdProductoTalla ?></td>
                <td><?= $valor->idTalla->Talla ?></td>
                <td><?= $valor->idTalla->DescripcionTalla ?></td>
                <td><?= $valor->Cantidad ?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <?php //dd($tallas); ?>

    
</div>
