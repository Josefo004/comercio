<?php

namespace backend\controllers;

use common\models\LoginForm;
use common\models\Usuarios;
use backend\models\CambiarPasswordForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class PasswordController extends Controller
{
  
  public function actionCambio($loginform = null)
  {
    $modeloCambio = new CambiarPasswordForm();
    $usuario = null;

    if ($this->request->isPost) {
      $modeloCambio->load($this->request->post());

      $usuario = Usuarios::findByUsername($modeloCambio->CodigoUsuario);
      $usuario->setPassword($modeloCambio->NuevoPassword);
      $usuario->save();

      return $this->redirect(['site/index']);
    }

    $this->layout = '@backend/views/password/layouts/blanco';
    if ($loginform!==null) {
      $usuario = Usuarios::find()
        ->where(['=', 'Login', $loginform])
        ->one();
      $modeloCambio->CodigoUsuario = $usuario->CodigoUsuario;
      $modeloCambio->Login = $usuario->Login;
      $modeloCambio->NombreCompleto = $usuario->NombreCompleto;
      $modeloCambio->NuevoPassword = '';
    }
    return $this->render('cambio', ['modeloCambio' => $modeloCambio]);
  }
}
