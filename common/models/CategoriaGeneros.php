<?php

namespace common\models;

use Yii;
use common\models\query\ProductosTallasQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ProductoTallas".
 *
 * @property int $IdCategoriaGenero
 * @property string $Descripcion
 *
 */
class CategoriaGeneros extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'CategoriaGeneros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IdCategoriaGenero', 'Descripcion'], 'required'],
            [['Descripcion'], 'string', 'max' => 100],
        ];
    }

    //devolviendo todos los genros como array asociativo
    public static function getGenerosAsArray(){
        $generos = CategoriaGeneros::find()->all();
        $generos = ArrayHelper::map($generos,'IdCategoriaGenero', 'Descripcion');
        // return CategoriaGeneros::find()->select('IdCategoriaGenero', 'Descripcion')->asArray()->all();
        return $generos;
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
