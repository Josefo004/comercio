<?php

namespace common\models;

use Yii;
use common\models\query\ProductosTallasQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "Ordenes".
 *
 * @property int $IdOrden
 * @property string $CodigoEstado
 * @property float $TotalOrden
 * @property string|null $CodigoQR
 * @property string|null $CodigoUsuarioCreacion
 * @property string $FechaCreacion
 * @property string|null $CodigoUsuarioActualizacion
 * @property string $FechaActualizacion
 * @property string|null $Observacion
 * @property string|null $Email
 * @property string|null $Celular
 * @property string|null $NombreCompleto
 * 
 */
class Ordenes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Ordenes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
      return [
        [['CodigoEstado', 'TotalOrden', 'CodigoUsuarioCreacion', 'FechaCreacion'], 'required'],
        [['Observacion'], 'string', 'max' => 500],
        [['FechaCreacion', 'FechaActualizacion'], 'safe'],
        // ['NombreProducto'], 'string', 'max' => 255],
      ];
    }

    /**
     * Gets query for [[DestalleOrdenes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetallesOrden()
    {
      return $this->hasMany(DetalleOrdenes::class, ['IdOrden' => 'IdOrden']);
    }

    /**
     * Gets query for [[Estados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstado()
    {
      return $this->hasOne(Estados::class, ['CodigoEstado' => 'CodigoEstado']);
    }

    /**
     * Gets query for [[Usuarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreador()
    {
      return $this->hasOne(Usuarios::class, ['CodigoUsuario' => 'CodigoUsuarioCreacion']);
    }

}
