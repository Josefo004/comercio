<?php


use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

//dd($dataProvider);

$this->title = 'Ordenes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div >

  <h2><?= Html::encode($this->title) ?></h2>

  <div class="row">
    <div class="col-md-9">
      <!-- <?= Html::a('Nuevo Producto', ['create'], ['class' => 'btn btn-success']) ?> -->
    </div>
    <div class="col-md-3">
      <?php
      $form = ActiveForm::begin([
        'method' => 'get',
        'action' => ['ordenes/index'], // La acción de búsqueda en el controlador
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
        'attribute' => 'IdOrden',
      ],
      [
        'label' => 'Codigo Comercio',
        'attribute' => 'CodigoPago',
      ],
      [
        'label' => 'Nombre Completo',
        'attribute' => 'NombreCompleto',
      ],
      [
        'label' => 'Fecha Solicitud',
        'attribute' => 'FechaCreacion',
      ],
      [
        'label' => 'Costo Total',
        'attribute' => 'TotalOrden',
      ],
      [
        'label' => 'Estado de la Orden',
        'attribute' => 'estado.Descripcion',
      ],
      [
        'class' => 'yii\grid\ActionColumn',
        'template' => '{view}', // Puedes personalizar los botones aquí
        'buttons' => [
          'view' => function ($url, $model, $key) {
            return Html::a('INFO <i class="fas fa-info-circle"></i>', ['/ordenes/ver-orden', 'idOrden' => $model->IdOrden], ['class' => 'btn btn-outline-info btn-sm'], [
              'title' => Yii::t('yii', 'View'),
            ]);
          },
        ],
      ],
      [
        'class' => 'yii\grid\ActionColumn',
        'template' => '{view}', // Puedes personalizar los botones aquí
        'buttons' => [
          'view' => function ($url, $model, $key) {
            return Html::a('PDF <i class="far fa-file-pdf"></i>', ['pdf/comprobante', 'IdOrden' => $model->IdOrden], ['class' => 'btn btn-outline-primary btn-sm', 'target'=>'_blank'], [
              'title' => Yii::t('yii', 'View'),
            ]);
          },
        ],
      ],
      [
        'class' => 'yii\grid\ActionColumn',
        'template' => '{view}', // Puedes personalizar los botones aquí
        'buttons' => [
          'view' => function ($url, $model, $key) {
            if ($model->CodigoEstado === 'A') {
              $cp = $model->CodigoPago; 
              $cc = $model->TotalOrden;
              return Html::a('Entregar <i class="fas fa-clipboard-check"></i>', ['/ordenes/entregar', 'idOrden' => $model->IdOrden], [
                'class' => 'btn btn-outline-success btn-sm',
                'data' => [
                    'confirm' => '¿Estás seguro que quieres hacer la entrega de '.$cp.' con un costo de '.$cc.'?',
                    'method' => 'post',
                ],
              ]);
            }
            return '';
          },
        ],
      ],
    ],
    'tableOptions' => ['class' => 'table table-sm'],
  ]); ?>


</div>