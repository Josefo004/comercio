<?php

use common\models\Productos;
use yii\widgets\ActiveForm;
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

    <div class="row">
        <div class="col-md-9">
            <?= Html::a('Nuevo Producto', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="col-md-3">
            <?php
            $form = ActiveForm::begin([
                'method' => 'get',
                'action' => ['productos/index'], // La acción de búsqueda en el controlador
            ]);
            ?>
            <div class="form-group">
                <?= Html::textInput('q', '', ['class' => 'form-control', 'placeholder' => 'Buscar...', 'id' => 'searchInput']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <script>
        // Agregar evento change al input de búsqueda
        $('#searchInput').on('input', function() {
            this.form.submit(); // Envía automáticamente el formulario cuando cambia el contenido del input
        });
    </script>
    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'ID',
                'attribute' => 'IdProducto',
            ], 
            [
                'label' => 'Codigo',
                'attribute' => 'CodigoProducto',
            ],
            [
                'label' => 'Indumentaria Para',
                'content' => function ($model) {
                    //return strtolower($model->idCategoriaGenero->Descripcion);
                    return Html::tag('spam', $model->idCategoriaGenero->Descripcion, [
                        'class' => 'badge badge-pill badge-light'
                    ]);
                }
                //'attribute' => 'idCategoriaGenero.Descripcion',
            ],
            [
                'label' => 'Producto',
                'attribute' => 'NombreProducto',
            ],
            // [
            //     'label' => 'Categoria Producto',
            //     'content' => function ($model){
            //         return $model->idCategoriaProducto->getDescripcion();
            //     }
            //     //'attribute' => ucwords('idCategoriaProducto.Descripcion'),
            // ],
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
            //'Precio',
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
            //'Publicado',
            //'FechaHoraRegistro',
            //'FechaHoraActualizacion',
            //'CodigoUsuarioCreacion',
            //'CodigoUsuarioActualizacion',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Productos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'IdProducto' => $model->IdProducto]);
                }
            ],
        ],
        'tableOptions' => ['class' => 'table table-sm'],
    ]); ?>


</div>
