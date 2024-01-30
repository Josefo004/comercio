<?php

namespace common\models;

use Yii;
use common\models\query\ProductosTallasQuery;

/**
 * This is the model class for table "ProductoTallas".
 *
 * @property string $CodigoEstado
 * @property string $Descripcion
 * @property string $FechaHoraRegistro
 *
 */
class Estados extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Estados';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CodigoEstado', 'Descripcion','FechaHoraRegistro'], 'required'],
            [['CodigoEstado'], 'string', 'max' => 1],
            [['Descripcion'], 'string', 'max' => 100],
            [['FechaHoraRegistro'], 'safe'],
            [['CodigoEstado'], 'unique', 'targetAttribute' => ['CodigoEstado']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CodigoEstado' => 'Código Estado',
            'Descripcion' => 'Descripción de Estado',
            'FechaHoraRegistro' => 'Fecha Hora Registro',
        ];
    }

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
