<?php

namespace backend\controllers;

use common\components\CommonQueries;
use common\models\Ordenes;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;

use yii\data\ActiveDataProvider;


/**
 * Site controller
 */
class OrdenesController extends Controller
{
  /**
   * Lists all Productos models.
   *
   * @return string
   */
  public function actionIndex($q = null)
  {

    $dataProvider = new ActiveDataProvider([
      'query' => Ordenes::find()
        ->joinWith('estado')
        ->where(['not', ['Ordenes.CodigoQR' => null]])
        ->andFilterWhere(['or',
                              ['like', 'Ordenes.CodigoPago', $q],
                              ['like', 'Ordenes.NombreCompleto', $q],
                              ['like', 'Ordenes.Celular', $q],
                          ]),
      'pagination' => [
        'pageSize' => 15
      ],
      // 'sort' => [
      //     'defaultOrder' => [
      //         'IdProducto' => SORT_DESC,
      //     ]
      // ],

    ]);

    //dd($dataProvider);

    return $this->render('index', [
      'dataProvider' => $dataProvider,
    ]);
  }

  //vizualizamos una orden
  public function actionVerOrden($idOrden)
  {
    //dd($idOrden);
    $orden = Ordenes::find()
      ->joinWith('estado')
      ->joinWith('detallesOrden')
      ->joinWith('creador')
      ->where(['Ordenes.IdOrden' => $idOrden])
      ->one();
    return $this->render('orden', ['orden' => $orden]);
  }

  //vizualizamos una orden
  public function actionEntregar($idOrden)
  {
    date_default_timezone_set('America/La_Paz');
    $orden = Ordenes::find()
      ->where(['IdOrden' => $idOrden])
      ->one();

    $ff = CommonQueries::GetFechaHoraActual();
    $orden->CodigoEstado = 'E';
    $orden->FechaActualizacion = CommonQueries::GetFechaHoraActual();
    $orden->CodigoUsuarioActualizacion = Yii::$app->user->identity->getId();
    $ff = date('d/m/Y H:m:s', strtotime($orden->FechaActualizacion));
    $orden->Observacion = $orden->Observacion.$ff. ' Orden Entregada por: '.$orden->CodigoUsuarioActualizacion.';';
    $orden->save();
    return $this->redirect(['site/index']);
  }
}
