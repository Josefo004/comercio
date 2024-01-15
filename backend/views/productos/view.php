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
            'NombreProducto',
            'Descripcion:html',
            [
                'attribute' => 'Imagen',
                'format' => ['html'],
                'value' => fn() => Html::img($model->getImageUrl(), ['style' => 'width: 50px']),
            ],
            'Precio',
            'PrecioPreventa',
            'PrecioReserva',
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

</div>
