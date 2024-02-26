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
        [['IdOrden', 'CodigoEstado', 'TotalOrden', 'CodigoQR', 'CodigoUsuarioCreacion', 'FechaCreacion'], 'required'],
        [['Observacion'], 'string', 'max' => 500],
        [['FechaCreacion', 'FechaActualizacion'], 'safe'],
      ];
    }

    //devolviendo todos los genros como array asociativo
    // public static function getGenerosAsArray(){
    //     $generos = CategoriaGeneros::find()->all();
    //     $generos = ArrayHelper::map($generos,'IdCategoriaGenero', 'Descripcion');
    //     // return CategoriaGeneros::find()->select('IdCategoriaGenero', 'Descripcion')->asArray()->all();
    //     return $generos;
    // }
}
