<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/** @var \yii\data\ActiveDataProvider $dataProvider */

$this->title = 'USFX';
?>
<!-- <br><br><br> -->
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-8"></div>
            <div class="col-4"> 
                <?php
                $form = ActiveForm::begin([
                    'method' => 'get',
                    'action' => ['index'], // La acción de búsqueda en el controlador
                ]);
                ?>
                <div class="form-group">
                    <?= Html::textInput('q', '', ['class' => 'form-control', 'placeholder' => 'Buscar...', 'id' => 'searchInput', 'options' => ['autocomplete' => 'off']]) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <?php echo \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'summary'=>'',
            'layout' => '{summary}<div class="row">{items}</div>{pager}',
            'itemView' => '_product_item',
            'itemOptions' => [
                'class' => 'col-lg-4 col-md-6 mb-4 product-item'
            ],
            'pager' => [
                'class' => \yii\bootstrap4\LinkPager::class
            ]
            
        ]) ?>
        <script>
            // Agregar evento change al input de búsqueda
            $('#searchInput').on('input', function() {
                this.form.submit(); // Envía automáticamente el formulario cuando cambia el contenido del input
            });
        </script>
    </div>
</div>