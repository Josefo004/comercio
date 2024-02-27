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
}
