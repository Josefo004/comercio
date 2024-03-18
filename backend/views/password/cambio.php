<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Cambiar contraseña para: ';

?>
<div class="site-login">
  <div class="mt-5 offset-lg-3 col-lg-6">
    <h3><?= Html::encode($this->title) ?> <br> <small> <strong><?= $modeloCambio->NombreCompleto ?></strong> <small><br>Usuario: <strong><?= $modeloCambio->Login ?></strong></small> </small> </h3>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($modeloCambio, 'CodigoUsuario')->hiddenInput(['value'=> $modeloCambio->CodigoUsuario])->label(false);?>

    <?= $form->field($modeloCambio, 'Login')->hiddenInput(['value'=> $modeloCambio->Login])->label(false);?>

    <?= $form->field($modeloCambio, 'NombreCompleto')->hiddenInput(['value'=> $modeloCambio->NombreCompleto])->label(false);?>

    <?= $form->field($modeloCambio, 'NuevoPassword')->textInput(['type' => 'text']) ?>

    <div class="form-group">
      <?php
      
        echo Html::submitButton('Cambiar Contraseña', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']);
      
      ?>
    </div>

    <?php ActiveForm::end(); ?>
  </div>
</div>