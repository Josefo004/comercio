<?php

namespace common\models;
use  common\models\query\ProductosQuery;
use yii\helpers\FileHelper;

use Yii;

/**
 * This is the model class for table "Productos".
 *
 * @property int $IdProducto
 * @property string $NombreProducto
 * @property string|null $Descripcion
 * @property string|null $Imagen
 * @property float $Precio
 * @property float $PrecioPreventa
 * @property float $PrecioReserva
 * @property int|null $CantidadLimite
 * @property int|null $CantidadVendidos
 * @property int $Publicado
 * @property string|null $FechaHoraRegistro
 * @property string|null $FechaHoraActualizacion
 * @property string|null $CodigoUsuarioCreacion
 * @property string|null $CodigoUsuarioActualizacion
 * @property string $CodigoEstado
 * @property int $IdCategoriaGenero
 * @property int $IdCategoriaProducto
 * @property string $CodigoProducto
 * @property string $FechaCaducidadPreVenta
 * @property string $FechaCaducidadReserva
 *
 * @property Usuarios $codigoUsuarioActualizacion
 * @property Usuarios $codigoUsuarioCreacion
 * @property DetalleProducto[] $detalleProductos
 * @property Ordenes[] $idOrdens
 * @property ProductosOrdenados[] $productosOrdenados
 */

class Productos extends \yii\db\ActiveRecord
{
    public $imagenFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Productos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NombreProducto', 'Precio', 'PrecioPreventa', 'PrecioReserva', 'Publicado'], 'required'],
            [['Descripcion'], 'string'],
            [['Precio', 'PrecioPreventa', 'PrecioReserva'], 'number'],
            [['CantidadLimite', 'CantidadVendidos', 'Publicado'], 'integer'],
            [['FechaHoraRegistro', 'FechaHoraActualizacion'], 'safe'],
            [['NombreProducto'], 'string', 'max' => 255],
            [['imagenFile'], 'image', 'extensions' => 'png, jpg, jpeg, webp', 'maxSize' => 10 * 1024 * 1024],
            [['Imagen'], 'string', 'max' => 2000],
            [['CodigoUsuarioCreacion', 'CodigoUsuarioActualizacion'], 'string', 'max' => 3],
            [['CodigoEstado'], 'string', 'max' => 1],
            [['IdCategoriaGenero'], 'integer'],
            [['IdCategoriaProducto'], 'integer'],
            [['CodigoProducto'], 'string', 'max' => 10],
            [['FechaCaducidadPreVenta'], 'date', 'format' => 'php:Y-m-d'],
            [['FechaCaducidadReserva'], 'date', 'format' => 'php:Y-m-d'],
            [['CodigoUsuarioCreacion'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['CodigoUsuarioCreacion' => 'CodigoUsuario']],
            [['CodigoUsuarioActualizacion'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['CodigoUsuarioActualizacion' => 'CodigoUsuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdProducto' => 'Id Producto',
            'NombreProducto' => 'Nombre del Producto',
            'Descripcion' => 'Descripcion',
            'Imagen' => 'Imagen',
            'imagenFile' => 'Imagen del producto',
            'Precio' => 'Precio',
            'PrecioPreventa' => 'Precio Preventa',
            'PrecioReserva' => 'Precio Reserva',
            'CantidadLimite' => 'Cantidad Limite',
            'CantidadVendidos' => 'Cantidad Vendidos',
            'Publicado' => 'Publicado',
            'FechaHoraRegistro' => 'Fecha Hora Registro',
            'FechaHoraActualizacion' => 'Fecha Hora Actualizacion',
            'CodigoUsuarioCreacion' => 'Codigo Usuario Creacion',
            'CodigoUsuarioActualizacion' => 'Codigo Usuario Actualizacion',
            'CodigoEstado' => 'Código Estado',
            'IdCategoriaGenero' => 'Indumentaria Para',
            'IdCategoriaProducto' => 'Tipo de Indumentaria',
            'CodigoProducto' => 'Codigo Producto',
            'FechaCaducidadReserva' => 'Caducidad Reserva',
            'FechaCaducidadPreVenta' => 'Caducidad Preventa',
        ];
    }

    /**
     * Gets query for [[IdCategoriaGenero]].
     *
     * @return \yii\db\ActiveQuery
     */
    //relacionamos productos con la categoria de genero
    public function getIdCategoriaProducto()
    {
        return $this->hasOne(CategoriaProductos::class, ['IdCategoriaProducto' => 'IdCategoriaProducto']);
    }

    /**
     * Gets query for [[IdCategoriaGenero]].
     *
     * @return \yii\db\ActiveQuery
     */
    //relacionamos productos con la categoria de genero
    public function getIdCategoriaGenero()
    {
        return $this->hasOne(CategoriaGeneros::class, ['IdCategoriaGenero' => 'IdCategoriaGenero']);
    }

    /**
     * Gets query for [[CodigoEstado]].
     *
     * @return \yii\db\ActiveQuery
     */
    //relacionamos productos con estado
    public function getCodigoEstado()
    {
        return $this->hasOne(Estados::class, ['CodigoEstado' => 'CodigoEstado']);
    }

    /**
     * Gets query for [[CodigoUsuarioActualizacion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoUsuarioActualizacion()
    {
        return $this->hasOne(Usuarios::class, ['CodigoUsuario' => 'CodigoUsuarioActualizacion']);
    }

    public function getErrors($attribute = null) {
        $errors=parent::getErrors($attribute);
        if(!empty($errors)){
            $stringErrors='<b>Errores encontrados:</b><ul>';
            foreach ($errors as $key=>$value){
                $stringErrors.='<li>'.$key.':  '.$value[0].'</li>';
            }
            $stringErrors.='</ul>';
            return $stringErrors;
        }else{
            return null;
        }
    }

  
    /**
     * Gets query for [[CodigoUsuarioCreacion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCodigoUsuarioCreacion()
    {
        return $this->hasOne(Usuarios::class, ['CodigoUsuario' => 'CodigoUsuarioCreacion']);
    }

    /**
     * Gets query for [[IdOrdens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdOrdens()
    {
        return $this->hasMany(Ordenes::class, ['IdOrden' => 'IdOrden'])->viaTable('ProductosOrdenados', ['IdProducto' => 'IdProducto']);
    }

    /**
     * Gets query for [[IdTallas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdTallas()
    {
        return $this->hasMany(Tallas::class, ['IdTalla' => 'IdTalla'])->viaTable('ProductoTallas', ['IdProducto' => 'IdProducto']);
    }

    /**
     * Gets query for [[ProductoTallas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductoTallas()
    {
        return $this->hasMany(ProductoTallas::class, ['IdProducto' => 'IdProducto']);
    }

    /**
     * Gets query for [[ProductosOrdenados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductosOrdenados()
    {
        return $this->hasMany(ProductosOrdenados::class, ['IdProducto' => 'IdProducto']);
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->imagenFile) {
            $this->Imagen =  Yii::$app->security->generateRandomString() . '/' . $this->imagenFile->name;
        }
        $transaction = Yii::$app->db->beginTransaction();
        $ok = parent::save($runValidation, $attributeNames);
      
        if ($ok && $this->imagenFile) {
            $fullPath = Yii::getAlias('@frontend/web/imgProductos/' .  $this->Imagen );
            $dir = dirname($fullPath);
         
            if (!FileHelper::createDirectory($dir) | !$this->imagenFile->saveAs($fullPath)) {
                $transaction->rollBack();

                return false;
            }
        }

  
        $transaction->commit();

        return $ok;
    }


    public function getImageUrl()
    {
        return self::formatImageUrl($this->Imagen);
    }

    public static function formatImageUrl($imagePath)
    {
        if ($imagePath) {
            return Yii::$app->params['frontendUrl'] . '/web/imgProductos/' . $imagePath;
        }

        return Yii::$app->params['frontendUrl'] . '/img/no_image_available.png';
    }

    /**
     * Get short version of the description
     *
     * @return string
     * @author Zura Sekhniashvili <zurasekhniashvili@gmail.com>
     */
    public function getShortDescription()
    {
        return \yii\helpers\StringHelper::truncateWords(strip_tags($this->Descripcion), 30);
    }

    public function afterDelete()
    {
        parent::afterDelete();
        if ($this->Imagen) {
            $dir = Yii::getAlias('@frontend/web/imgProductos'). dirname($this->Imagen);
            FileHelper::removeDirectory($dir);
        }
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductosQuery(get_called_class());
    }
}
