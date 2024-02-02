<?php
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/** @var yii\web\View $this */
/** @var common\models\Productos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="productos-form">

<?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'CodigoProducto')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'IdCategoriaGenero')->dropDownList($aGeneros)?>
        </div>
        <div class="col-md-5">
            <?= $form->field($model, 'IdCategoriaProducto')->dropDownList($aProductos)?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'NombreProducto')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-5">
            <?= $form->field($model, 'Descripcion')->widget(CKEditor::class, [
                'options' => ['rows' => 6],
                'preset' => 'basic'
            ]) ?>
        </div>
        <div class="col-md-3">
            <label for="productos-imagen">.</label>
            <?= $form->field($model, 'Imagen', [
                    'template' => '
                            <div class="custom-file">
                                {input}
                                {label}
                                {error}
                            </div>
                        ',
                    'labelOptions' => ['class' => 'custom-file-label'],
                    'inputOptions' => ['class' => 'custom-file-input']
                ])->textInput(['type' => 'file']) 
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'Precio')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'PrecioPreventa')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'PrecioReserva')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'FechaCaducidadPreVenta')->widget(DatePicker::class, [
                'language' => 'es', // el idioma del widget
                'dateFormat' => 'dd-MM-yyyy', // el formato de la fecha
                'options' => ['class' => 'form-control', 'placeholder' => 'dd-mm-aaaa'], // las opciones del campo de texto
            ])?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'FechaCaducidadReserva')->widget(DatePicker::class, [
                'language' => 'es', // el idioma del widget
                'dateFormat' => 'dd-MM-yyyy', // el formato de la fecha
                'options' => ['class' => 'form-control', 'placeholder' => 'dd-mm-aaaa'], // las opciones del campo de texto
            ])?>
        </div>
    </div>



    
    

    <?= $form->field($model, 'CantidadLimite')->textInput() ?>

    

    <?= $form->field($model, 'Publicado')->checkbox() ?>

   <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
    <!-- Codigo JavaScript del Formulario -->
    <?php
    $this->registerJs("
        $('#productos-idcategoriaproducto').change(function() {
            var valor = $(this).find('option:selected').text();
            $('#productos-nombreproducto').val(valor);
        });
    ");
    ?>

</div>

