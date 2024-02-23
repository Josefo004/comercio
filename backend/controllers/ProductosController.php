<?php

namespace backend\controllers;
use common\components\CommonQueries;
use common\models\Productos;
use common\models\CategoriaGeneros;
use common\models\CategoriaProductos;
use common\models\ProductoTallas;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductosController implements the CRUD actions for Productos model.
 */
class ProductosController extends Controller
{
    private $identity;
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }


    public function __construct($id, $module, $config = array()) {
        parent::__construct($id, $module, $config);
        if(!\Yii::$app->user->isGuest){
            $this->identity = \Yii::$app->user->getIdentity();
        }
    }
    

    /**
     * Lists all Productos models.
     *
     * @return string
     */
    public function actionIndex($q = null)
    {
        // $sw = Productos::find()
        //                         ->joinWith('codigoEstado')
        //                         ->joinWith('idCategoriaGenero')
        //                         ->joinWith('idCategoriaProducto')
        //                         ->where(['<>','Productos.CodigoEstado','D'])
        //                         ->andFilterWhere(['or',
        //                             ['like', 'Productos.CodigoProducto', $q],
        //                             ['like', 'Productos.NombreProducto', $q],
        //                             ['like', 'Productos.Descripcion', $q],
        // ])->all();
        // dd($sw);

        $dataProvider = new ActiveDataProvider([
            'query' => Productos::find()
                                ->joinWith('codigoEstado')
                                ->joinWith('idCategoriaGenero')
                                ->joinWith('idCategoriaProducto')
                                ->where(['<>','Productos.CodigoEstado','D'])
                                ->andFilterWhere(['or',
                                    ['like', 'Productos.CodigoProducto', $q],
                                    ['like', 'Productos.NombreProducto', $q],
                                    ['like', 'Productos.Descripcion', $q],
                                ]),
            
            'pagination' => [
                'pageSize' => 6
            ],
            // 'sort' => [
            //     'defaultOrder' => [
            //         'IdProducto' => SORT_DESC,
            //     ]
            // ],
            
        ]);
        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Productos model.
     * @param int $IdProducto Id Producto
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($IdProducto)
    {
        return $this->render('view', [
            'model' => $this->findModel2($IdProducto),
            'tallas' => $this->findTallas($IdProducto),
        ]);
    }

    /**
     * Creates a new Productos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Productos();
        $model->FechaHoraRegistro = CommonQueries::GetFechaHoraActual();
        $model->CodigoUsuarioCreacion = $this->identity->CodigoUsuario;
        $model->imagenFile = UploadedFile::getInstance($model, 'Imagen');

        $aGeneros = CategoriaGeneros::getGenerosAsArray();        
        $aProductos = CategoriaProductos::getProductosAsArray();
        //dd($aProductos);

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'IdProducto' => $model->IdProducto]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model, 
            'aGeneros' => $aGeneros,
            'aProductos' => $aProductos,
        ]);
    }

    /**
     * Updates an existing Productos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $IdProducto Id Producto
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($IdProducto)
    {
        $model = $this->findModel($IdProducto);
        $model->FechaHoraActualizacion = CommonQueries::GetFechaHoraActual();
        $model->CodigoUsuarioActualizacion =  $this->identity->CodigoUsuario;
        $model->imagenFile = UploadedFile::getInstance($model, 'Imagen');

        // dd($model);

        $aGeneros = CategoriaGeneros::getGenerosAsArray();  
        $aProductos = CategoriaProductos::getProductosAsArray();
        
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'IdProducto' => $model->IdProducto]);
        }

        return $this->render('update', [
            'model' => $model,
            'aGeneros' => $aGeneros,
            'aProductos' => $aProductos,
            'tallas' => $this->findTallas($IdProducto),
        ]);
    }

    /**
     * Deletes an existing Productos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $IdProducto Id Producto
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($IdProducto)
    {
        $modelo = $this->findModel($IdProducto);
        $modelo->CodigoEstado = 'D';
        $modelo->update();
        return $this->redirect(['index']);
        //$this->findModel($IdProducto)->delete();

    }

    /**
     * Finds the Productos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $IdProducto Id Producto
     * @return Productos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($IdProducto)
    {
        if (($model = Productos::findOne(['IdProducto' => $IdProducto])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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
                        ->all();
        return $model;
    }
}
