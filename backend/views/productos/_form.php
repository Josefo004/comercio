<?php
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Productos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="productos-form">

<?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'NombreProducto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Descripcion')->widget(CKEditor::class, [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

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
    ])->textInput(['type' => 'file']) ?>

    <?= $form->field($model, 'IdCategoriaGenero')->dropDownList($genero, ['prompt' => 'Seleccione Uno' ])?>
    <?= $form->field($model, 'Precio')->textInput() ?>
    <?= $form->field($model, 'PrecioPreventa')->textInput() ?>
    <?= $form->field($model, 'PrecioReserva')->textInput() ?>

    <?= $form->field($model, 'CantidadLimite')->textInput() ?>

    

    <?= $form->field($model, 'Publicado')->checkbox() ?>

   <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

