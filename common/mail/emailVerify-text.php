<?php

/** @var yii\web\View $this */
/** @var common\models\User $user */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->VerificationToken]);
?>
Hello <?= $user->Login ?>,

Follow the link below to verify your email:

<?= $verifyLink ?>
