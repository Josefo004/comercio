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
        <div class="row justify-content-end">
            
            <div class="col-lg-3 col-md-4"> 
                <?php
                $form = ActiveForm::begin([
                    'method' => 'get',
                    'action' => ['index'], // La acción de búsqueda en el controlador
                ]);
                ?>
                <div class="form-group">
                    <?= Html::textInput('q', '', ['class' => 'form-control', 'style' => 'border: 1px solid #00aaf8 ; padding: 10px; border-radius: 5px; background-color: #f9f9f9; color: #333; font-size: 16px;' , 'placeholder' => 'Buscar...', 'id' => 'searchInput', 'options' => ['autocomplete' => 'off']]) ?>
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
                'class' => 'col-lg-3 col-md-4 mb-4 product-item'
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