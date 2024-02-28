<?php

namespace common\models;

use Yii;
use common\models\query\ProductosTallasQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Ordenes".
 *
 * @property int $IdDetalleOrden
 * @property int $IdOrden
 * @property int $IdProducto
 * @property int $IdProductoTalla
 * @property string $CodigoProducto
 * @property string $ProductoPara
 * @property string $NombreProducto
 * @property string $Imagen
 * @property float $Precio
 * @property int $Cantidad
 * @property float $Total
 * @property string $FechaRegistro
 * 
 */
class DetalleOrdenes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'DetalleOrdenes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
      return [
        [['IdOrden', 'IdProducto', 'IdProductoTalla', 'CodigoProducto', 'ProductoPara', 'NombreProducto', 'Imagen', 'Precio', 'Cantidad', 'Total', 'FechaRegistro'], 'required'],
        // ['NombreProducto'], 'string', 'max' => 255],
      ];
    }
}
