<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Ordenes;

class EmailController extends Controller
{
  public function actionEnviarCorreo($IdOrden=null)
  {
    $this->layout = '@frontend/views/email/layouts/main';
    
    $orden = Ordenes::find()
      ->joinWith('estado')
      ->joinWith('detallesOrden')
      ->joinWith('creador')
      ->where(['Ordenes.IdOrden' => $IdOrden])
      ->one();
      
    // return $this->render('mandarOrden', ['orden' => $orden]);

    $mailer = Yii::$app->mailer;

    $edestino = $orden->Email;

    $mensaje = $mailer->compose('mandarOrden', ['orden' => $orden])
      ->setFrom('secretaria.mdhs@gmail.com')
      ->setTo(trim($edestino))
      ->setSubject('Envio de Orden '.$orden->IdOrden);
    
    if ($mensaje->send()) {
      Yii::$app->session->setFlash('success', 'Comprobante electrónico enviado correctamente a '.$edestino);
    } else {
      Yii::$app->session->setFlash('error', 'Hubo un error al enviar el correo electrónico.');
    }

    // Redirigir a una página después del envío del correo electrónico
    return $this->redirect(['site/index']);

  }
  
}
