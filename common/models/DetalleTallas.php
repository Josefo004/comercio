<?php

namespace common\models;

use Yii;
use common\models\query\DetalleTallasQuery;

/**
 * This is the model class for table "DetalleTallas".
 *
 * @property int $IdTalla
 * @property string $Opcion
 * @property string $FechaHoraRegistro
 */
class DetalleTallas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'DetalleTallas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IdTalla', 'Opcion'], 'required'],
            [['IdTalla'], 'integer'],
            [['FechaHoraRegistro'], 'safe'],
            [['Opcion'], 'string', 'max' => 30],
            [['IdTalla', 'Opcion'], 'unique', 'targetAttribute' => ['IdTalla', 'Opcion']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IdTalla' => 'Id Talla',
            'Opcion' => 'Opcion',
            'FechaHoraRegistro' => 'Fecha Hora Registro',
        ];
    }
    public static function find()
    {
        return new DetalleTallasQuery(get_called_class());
    }
}
