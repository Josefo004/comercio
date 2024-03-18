<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Autenticarse';
$errores = $model->getErrors();
$cambiarPassword = (isset($errores['password']) && ($errores['password'][0] == 'Contraseña IGUAL a CI debe cambiar su contraseña.'))? true: false;
// echo '<pre>'.var_export($errores,true).'</pre>';
// echo '<pre>'.var_export($cambiarPassword,true).'</pre>';
?>
<div class="site-login">
    <div class="mt-5 offset-lg-3 col-lg-6">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>Llene los datos para logearse</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'login')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div class="form-group">
                <?php
                if ($cambiarPassword) {
                    // echo Html::button('Cambiar Contraseña!', ['class' => 'btn btn-danger btn-block']);
                    echo Html::a('<span class="fas fa-key"></span> Cambiar Contraseña!', ['/password/cambio', 'loginform'=>$model->login], ['class' => 'btn btn-danger btn-block']);
                }
                else {
                    echo Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']);
                }
                ?>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
