<?php

namespace frontend\controllers;

use common\models\Productos;
use common\models\DetalleTallas;
use common\models\ProductoTallas;
use common\models\query\ProductosTallasQuery;
use Yii;
use yii\web\Controller;
class CarritoController extends Controller
{
    public function actionIndex($id)
    {
       $producto = $this->findModel($id);
       //dd($producto);
       $productosTallas = ProductoTallas::find()->IdProducto($id)->all();
       foreach ($productosTallas as $tallas)
       {
            $detalleTallas[$tallas->idTalla->DescripcionTalla] = DetalleTallas::find()->DetalleTallas($tallas->IdTalla)->all();
       }
       return $this->render('index',
           ['producto'=>$producto,
            'detalleTallas'=>$detalleTallas
           ]);
    }

    protected function findModel($IdProducto)
    {
        if (($model = Productos::findOne(['IdProducto' => $IdProducto])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function findTalla( $idTalla)
    {
        if (($model = DetalleTallas::findAll([ 'IdTalla'=>$idTalla])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    

    
}
