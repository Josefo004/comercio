<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Tallas".
 *
 * @property int $IdTalla
 * @property string $DescripcionTalla
 * @property string $FechaHoraRegistro
 *
 * @property Productos[] $idProductos
 * @property ProductoTallas[] $productoTallas
 */
class Tallas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Tallas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['DescripcionTalla'], 'required'],
            [['FechaHoraRegistro'], 'safe'],
            [['DescripcionTalla'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdTalla' => 'Id Talla',
            'DescripcionTalla' => 'Descripcion Talla',
            'FechaHoraRegistro' => 'Fecha Hora Registro',
        ];
    }

    /**
     * Gets query for [[IdProductos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdProductos()
    {
        return $this->hasMany(Productos::class, ['IdProducto' => 'IdProducto'])->viaTable('ProductoTallas', ['IdTalla' => 'IdTalla']);
    }

    /**
     * Gets query for [[ProductoTallas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductoTallas()
    {
        return $this->hasMany(ProductoTallas::class, ['IdTalla' => 'IdTalla']);
    }
}
