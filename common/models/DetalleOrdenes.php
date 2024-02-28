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
 * @property string $Talla
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
        [['IdOrden', 'IdProducto', 'IdProductoTalla', 'Talla', 'CodigoProducto', 'ProductoPara', 'NombreProducto', 'Imagen', 'Precio', 'Cantidad', 'Total', 'FechaRegistro'], 'required'],
        // ['NombreProducto'], 'string', 'max' => 255],
      ];
    }

    /**
     * Gets query for [[Ordenes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrden()
    {
      return $this->hasOne(Ordenes::class, ['IdOrden' => 'IdOrden']);
    }

    /**
     * Gets query for [[Estados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTalla()
    {
      return $this->hasOne(Tallas::class, ['IdTalla' => 'IdTalla']);
    }

    public function beforeSave($insert)
    {
      if (parent::beforeSave($insert)) {
        $ca = $this->Imagen;
        $position = strpos($ca, '/web/imgProd');
        if($position!==false){ $this->Imagen = substr($ca, $position+18);}
        return true;
      } else {
        return false;
      }
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

}
