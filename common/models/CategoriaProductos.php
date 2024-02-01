<?php

namespace common\models;

use Yii;
use common\models\query\ProductosTallasQuery;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "ProductoTallas".
 *
 * @property int $IdCategoriaProducto
 * @property string $Descripcion
 *
 */
class CategoriaProductos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'CategoriaProductos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IdCategoriaProducto', 'Descripcion'], 'required'],
            [['Descripcion'], 'string', 'max' => 200],
        ];
    }

    public function getDescripcion(){
        return ucfirst(strtolower($this->Descripcion));
        //return mb_ucwords($this->Descripcion);
    }

    //devolviendo todas las categorias como array asociativo
    public static function getProductosAsArray(){
        $productos = CategoriaProductos::find()->all();
        $productos = ArrayHelper::map($productos,'IdCategoriaProducto', 'Descripcion');
        return $productos;
    }

    // /**
    //  * {@inheritdoc}
    //  */
    // public function attributeLabels()
    // {
    //     return [
    //         'CodigoEstado' => 'Código Estado',
    //         'Descripcion' => 'Descripción de Estado',
    //         'FechaHoraRegistro' => 'Fecha Hora Registro',
    //     ];
    // }

    // /**
    //  * Gets query for [[CodigoEstado]].
    //  *
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getIdProducto()
    // {
    //     return $this->hasOne(Productos::class, ['IdProducto' => 'IdProducto']);
    // }

    // /**
    //  * Gets query for [[IdTalla]].
    //  *
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getIdTalla()
    // {
    //     return $this->hasOne(Tallas::class, ['IdTalla' => 'IdTalla']);
    // }
    // public static function find()
    // {
    //     return new ProductosTallasQuery(get_called_class());
    // }
}
