<?php

namespace common\models;

use Yii;
use common\models\query\ProductosTallasQuery;

/**
 * This is the model class for table "ProductoTallas".
 *
 * @property int $IdProducto
 * @property int $IdTalla
 * @property string $FechaHoraRegistro
 *
 * @property Productos $idProducto
 * @property Tallas $idTalla
 */
class ProductoTallas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ProductoTallas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IdProducto', 'IdTalla'], 'required'],
            [['IdProducto', 'IdTalla'], 'integer'],
            [['FechaHoraRegistro'], 'safe'],
            [['IdProducto', 'IdTalla'], 'unique', 'targetAttribute' => ['IdProducto', 'IdTalla']],
            [['IdProducto'], 'exist', 'skipOnError' => true, 'targetClass' => Productos::class, 'targetAttribute' => ['IdProducto' => 'IdProducto']],
            [['IdTalla'], 'exist', 'skipOnError' => true, 'targetClass' => Tallas::class, 'targetAttribute' => ['IdTalla' => 'IdTalla']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdProducto' => 'Id Producto',
            'IdTalla' => 'Id Talla',
            'FechaHoraRegistro' => 'Fecha Hora Registro',
        ];
    }

    /**
     * Gets query for [[IdProducto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdProducto()
    {
        return $this->hasOne(Productos::class, ['IdProducto' => 'IdProducto']);
    }

    /**
     * Gets query for [[IdTalla]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdTalla()
    {
        return $this->hasOne(Tallas::class, ['IdTalla' => 'IdTalla']);
    }
    public static function find()
    {
        return new ProductosTallasQuery(get_called_class());
    }
}
