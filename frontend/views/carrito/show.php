<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Productos $model */

$this->title = 'Articulos del Carrito';
// $this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
$carrito = Yii::$app->session->get('carrito');
?>
<div>

    <h3><?= Html::encode($this->title) ?></h3>
    <div class="card mb-3" > 
        <div class="card-header">
            Listado
        </div>     
        <div class="card-body">
        <?= \yii\grid\GridView::widget([
            'dataProvider' => new \yii\data\ArrayDataProvider([
                'allModels' => $carrito,
            ]),
            'columns' => [
                [
                    'label' => 'Id Producto',
                    'attribute' => 'IdProducto',
                ],
                [
                    'label' => 'Id Talla',
                    'attribute' => 'Idtalla',
                ],
                [
                    'label' => 'Talla',
                    'attribute' => 'Talla',
                ],
                [
                    'label' => 'Código Producto',
                    'attribute' => 'CodigoProducto',
                ],
                [
                    'label' => 'Producto Para',
                    'attribute' => 'ProductoPara',
                ],
                [
                    'label' => 'Nombre Producto',
                    'attribute' => 'NombreProducto',
                ],
                [
                    'label' => 'Precio',
                    'attribute' => 'Precio',
                ],
                [
                    'label' => 'Cantidad',
                    'attribute' => 'Cantidad',
                ],
                [
                    'label' => 'Total',
                    'attribute' => 'Total',
                ],
                [
                    'label' => 'Fecha y Hora de Registro',
                    'attribute' => 'FechaHoraRegistro',
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{delete}',
                    'buttons' => [
                        'delete' => function ($url, $model, $key) {
                            return \yii\helpers\Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'title' => Yii::t('yii', 'Eliminar'),
                                'data-confirm' => Yii::t('yii', '¿Estás seguro de que quieres eliminar este elemento?'),
                                'data-method' => 'post',
                            ]);
                        },
                    ],
                ],
            ],
            'showFooter' => true,
            'footerRowOptions' => ['style' => 'font-weight:bold;'],
            'footerRowOptions' => ['style' => 'font-weight:bold;'],
            'footerRowOptions' => ['style' => 'font-weight:bold;'],
            'summary' => '',
        ]); ?>


        </div>      
    </div>

</div>