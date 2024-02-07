<?php

namespace frontend\controllers;

use common\components\CommonQueries;
use common\models\Productos;
use common\models\DetalleTallas;
use common\models\ProductoTallas;
use frontend\models\CarritoForm;
use yii\helpers\ArrayHelper;

use Yii;
use yii\web\Controller;
class CarritoController extends Controller
{

    public function asArray1($data){
        $data = ArrayHelper::map($data,'IdTalla', function($data, $defaultValue){
            //return $data->idTalla->Talla.' '.$data->idTalla->DescripcionTalla.' - cant. '.$data->Cantidad;
            return $data->idTalla->Talla.' '.$data->idTalla->DescripcionTalla;
        });
        return $data;
    }

    public function addToCarrito($data){
        $alCarrito = ArrayHelper::toArray($data);
        $mg = !Yii::$app->session->has('carrito')? [] : Yii::$app->session->get('carrito');
        array_push($mg,$alCarrito);
        Yii::$app->session->set('carrito', $mg);
        $aux = Yii::$app->session->get('carrito');
        // if (count($aux)>1) {
        //     dd($aux);
        // }
    }

    public function actionIndex($id, $tprecio=null)
    {
    /// revisar
    }

    public function actionCreate($id, $tprecio=null)
    {
        $producto = $this->findModel2($id);
        $tallas = $this->findTallas($id);
        $tallas = $this->asArray1($tallas);
        $modeloCarrito = new CarritoForm();

        if ($this->request->isPost) {
            $modeloCarrito->load($this->request->post());
            $modeloCarrito->FechaHoraRegistro = CommonQueries::GetFechaHoraActual();
            $this->addToCarrito($modeloCarrito); 
            return $this->render('show');
        }
       
        return $this->render('create', [
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
    }

    public function actionEliminar($id)
    {
        $carritot = Yii::$app->session->get('carrito');
        
        unset($_SESSION['carrito']);
        unset($carritot[$id]);
        if (count($carritot)==0) {
            return $this->redirect(['site/index']);
        }    
        Yii::$app->session->set('carrito', $carritot);
        return $this->render('show');
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
}
