<?php

namespace frontend\controllers;

use common\models\Productos;
use common\models\DetalleTallas;
use common\models\ProductoTallas;
use frontend\models\CarritoForm;
use Yii;
use yii\web\Controller;
class CarritoController extends Controller
{

    public function asArray1($data){
        $re = [];
        foreach ($data as $valor) {
            $txt = $valor->idTalla->Talla." ".$valor->idTalla->DescripcionTalla;
            array_push($re, $txt);
        }
        return $re;
    }

    public function actionIndex($id, $tprecio=null)
    {
       $producto = $this->findModel2($id);
       $tallas = $this->findTallas($id);
       $tallas = $this->asArray1($tallas);
       //dd($tallas);
       $modeloCarrito = new CarritoForm();
       
       return $this->render('index', [
            'producto' => $producto,
            'tallas' => $tallas,
            'tprecio' => $tprecio,
            'modeloCarrito' => $modeloCarrito,
           ]);
    }

    protected function findModel($IdProducto)
    {
        if (($model = Productos::findOne(['IdProducto' => $IdProducto])) !== null) {
            return $model;
        }

        // throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModel2($IdProducto){
        $model = Productos::find()
                        ->joinWith('codigoEstado')
                        ->joinWith('idCategoriaGenero')
                        ->joinWith('idCategoriaProducto')
                        ->where(['=','Productos.IdProducto',$IdProducto])
                        ->one();
        return $model;
    }

    protected function findTallas($IdProducto){
        $model = ProductoTallas::find()
                        ->joinWith('idTalla')
                        ->where(['=','IdProducto',$IdProducto])
                        ->andwhere(['>','Cantidad',0])
                        ->all();
        return $model;
    }

    protected function findTalla( $idTalla)
    {
        if (($model = DetalleTallas::findAll([ 'IdTalla'=>$idTalla])) !== null) {
            return $model;
        }

        // throw new NotFoundHttpException('The requested page does not exist.');
    }
    

    
}
