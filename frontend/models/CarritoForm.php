<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class CarritoForm extends Model
{
    public $IdProducto;
    public $Idtalla;
    public $Cantidad;
    public $Precio;
    public $Total;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IdProducto', 'Idtalla', 'Cantidad', 'Precio'], 'required'],
            [['Cantidad'], 'number', 'min' => 1, 'max' => 10],
        ];
    }

    public function attributeLabels()
    {
        return [
            'Idtalla' => 'Escoger Talla',
            'Cantidad' => 'Cantidad',
        ];
    }

}
