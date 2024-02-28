<?php

namespace frontend\controllers;

use common\components\CommonQueries;
use common\models\DetalleOrdenes;
use common\models\Productos;
use common\models\Usuarios;
use common\models\Ordenes;
use common\models\ProductoTallas;
use frontend\models\CarritoForm;
use frontend\models\OrdenForm;
use yii\helpers\ArrayHelper;

use Yii;
use yii\web\Controller;
class CarritoController extends Controller
{

    public function asArray1($data){
        $data = ArrayHelper::map($data,'IdProductoTalla', function($data, $defaultValue){
            //return $data->idTalla->Talla.' '.$data->idTalla->DescripcionTalla.' - cant. '.$data->Cantidad;
            return '"'.$data->idTalla->Talla.'" '.$data->idTalla->DescripcionTalla;
        });
        return $data;
    }

    public function addToCarrito($data){
        $alCarrito = ArrayHelper::toArray($data);
        $mg = !Yii::$app->session->has('carrito')? [] : Yii::$app->session->get('carrito');
        array_push($mg,$alCarrito);
        Yii::$app->session->set('carrito', $mg);
        $aux = Yii::$app->session->get('carrito');
    }

    public function actionIndex($id, $tprecio=null)
    {
    /// revisar
    }

    //vizualizamos una orden
    public function actionVerOrden($idOrden)
    {
        $orden = Ordenes::find()
                        ->joinWith('estado')
                        ->joinWith('detallesOrden')
                        ->where(['Ordenes.IdOrden' => $idOrden])
                        ->all();
        return $this->render('orden', ['orden' => $orden]);
    }

    //mandamos el identificador del producto y el tipo de precio al cual queremos procesar el pedido
    public function actionCreate($id, $tprecio=null)
    {
        $producto = $this->findModel2($id);
        $tallas = $this->findTallas($id);
        $tallas = $this->asArray1($tallas);
        //dd($tallas);
        $modeloCarrito = new CarritoForm();

        if ($this->request->isPost) {
            $modeloCarrito->load($this->request->post());
            $modeloCarrito->FechaHoraRegistro = CommonQueries::GetFechaHoraActual();
            $this->addToCarrito($modeloCarrito);
            
            return $this->render('create', [
                'producto' => $producto,
                'tallas' => $tallas,
                'tprecio' => $tprecio,
                'modeloCarrito' => $modeloCarrito,
                'modal' => 1,
            ]);
        }
       
        return $this->render('create', [
            'producto' => $producto,
            'tallas' => $tallas,
            'tprecio' => $tprecio,
            'modeloCarrito' => $modeloCarrito,
            'modal' => 0,
        ]);
    }

    public function actionShow(){
        if (Yii::$app->session->has('carrito')) {
            $modeloOrden = new OrdenForm();
            if ($this->request->isPost) {
                return $this->redirect(['ver-orden', 'idOrden' => 1]);
                $modeloOrden->load($this->request->post());
                
                // recupero el usuario o guardo un nuevo usuario 
                $usuario = ($modeloOrden->CodigoUsuario!='') ? Usuarios::findIdentity($modeloOrden->CodigoUsuario) : $usuario = $this->crearUsuario($modeloOrden); 
    
                // Creamos una Orden 
                $orden = $this->crearOrden($usuario, $modeloOrden->TotalOrden);
                
                // Detalle de las ordenes
                $detalleOrd = $this->crearDetallarOrden($orden->IdOrden);
                // dd($detalleOrd);
    
                return $this->redirect(['ver-orden', 'idOrden' => $orden->IdOrden]);
            }
            return $this->render('show',[
                'modeloOrden' => $modeloOrden,
            ]);
        }
        else {
            return $this->redirect(['site/index']);
        }
    }

    protected function findModel($IdProducto)
    {
        if (($model = Productos::findOne(['IdProducto' => $IdProducto])) !== null) {
            return $model;
        }
    }

    public function actionEliminar($id)
    {
        $carritot = Yii::$app->session->get('carrito'); //carrito temporal
        //dd($carritot);
        unset($_SESSION['carrito']);
        unset($carritot[$id]);
        if (count($carritot)==0) {
            return $this->redirect(['site/index']);
        }    
        Yii::$app->session->set('carrito', $carritot);
        // return $this->render('show');
        return $this->redirect(['site/index','ttt'=>1]);
    }

    public function actionEliminar2($id)
    {
        $carritot = Yii::$app->session->get('carrito');
        
        unset($_SESSION['carrito']);
        unset($carritot[$id]);
        if (count($carritot)==0) {
            return $this->redirect(['site/index']);
        }    
        Yii::$app->session->set('carrito', $carritot);
        return $this->redirect(['show']);
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

    protected function crearUsuario($modeloOrden){
        $user = new Usuarios();
        $user->NombreCompleto = $modeloOrden->NombreCompleto;
        $user->Email = $modeloOrden->Email;
        $user->IdPersona = $modeloOrden->IdPersona;
        $user->Celular = $modeloOrden->Celular;
        $user->generateCodigoUsuario();
        $user->Login = $user->CodigoUsuario;
        $user->setPassword($modeloOrden->IdPersona);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->Estado = 'V';
       
        //return $user->save() && $this->sendEmail($user);
       
        $user->save();
        return $user;
    }

    protected function crearOrden($usuario, $TotalOrden=0){
        $orden = new Ordenes();
        $orden->CodigoUsuarioCreacion = $usuario->CodigoUsuario;
        $orden->NombreCompleto = $usuario->NombreCompleto;
        $orden->Celular = $usuario->Celular;
        $orden->Email = $usuario->Email;
        $orden->CodigoEstado = 'P';
        $orden->TotalOrden = $TotalOrden;
        $orden->FechaCreacion = CommonQueries::GetFechaHoraActual();
        //dd($orden, $orden->save());
        $orden->save();
        //$errors = $orden->getErrors();
        //dd($errors);
        return $orden;
    }

    protected function crearDetallarOrden($idOrden = 0){
        $tmpCarrito = Yii::$app->session->get('carrito');
        //dd($tmpCarrito);
        $re = true;
        foreach ($tmpCarrito as $value) {
            $detalleO = new DetalleOrdenes();
            $detalleO->IdOrden = $idOrden;
            $detalleO->IdProducto = $value['IdProducto'];
            $detalleO->IdProductoTalla = $value['IdProductoTalla'];
            $detalleO->Talla = $value['Talla'];
            $detalleO->CodigoProducto = $value['CodigoProducto'];
            $detalleO->ProductoPara = $value['ProductoPara'];
            $detalleO->NombreProducto = $value['NombreProducto'];
            $detalleO->Imagen = $value['Imagen'];
            $detalleO->Precio = $value['Precio'];
            $detalleO->Cantidad = $value['Cantidad'];
            $detalleO->Total = $value['Total'];
            $detalleO->FechaRegistro = $value['FechaHoraRegistro'];
            if(!$detalleO->save()){$re = false; break;}
        }
        if ($re) { unset($_SESSION['carrito']); }
        return $re;
    }
}
