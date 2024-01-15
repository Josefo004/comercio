<?php

use common\models\Productos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Productos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Nuevo Producto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'IdProducto',
            'NombreProducto',
            
            [
                'attribute' => 'Descripcion',
                'content' => function ($model) {
                    return \yii\helpers\StringHelper::truncateWords($model->Descripcion, 7);
                }
            ],
          
            [
                'label' => 'Imagen',
                'attribute' => 'imagen',
                'content' => function ($model) {
                    /** @var \common\models\Product $model */
                    return Html::img($model->getImageUrl(), ['style' => 'width: 50px']);
                }
            ],
            'Precio',
            [
                'attribute' => 'Publicado',
                'content' => function ($model) {
                    /** @var \common\models\Product $model */
                    return Html::tag('span', $model->Publicado ? 'Publicado' : 'Sin Publicar', [
                        'class' => $model->Publicado ? 'badge badge-success' : 'badge badge-danger'
                    ]);
                }
            ],
            //'PrecioPreventa',
            //'PrecioReserva',
            //'CantidadLimite',
            //'CantidadVendidos',
            //'Publicado',
            //'FechaHoraRegistro',
            //'FechaHoraActualizacion',
            //'CodigoUsuarioCreacion',
            //'CodigoUsuarioActualizacion',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Productos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'IdProducto' => $model->IdProducto]);
                 }
            ],
        ],
    ]); ?>


</div>
