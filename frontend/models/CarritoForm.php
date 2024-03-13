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
    public $IdProductoTalla;            // IdProductoTalla para sacar cantidad segun talla
    public $Talla;
    public $CodigoProducto;
    public $ProductoPara;   
    public $NombreProducto;
    public $Imagen;
    public $Precio;
    public $Cantidad;
    public $Total;
    public $FechaHoraRegistro;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IdProducto', 'IdProductoTalla', 'Talla', 'CodigoProducto', 'ProductoPara', 'NombreProducto', 'Imagen', 'Precio', 'Cantidad', 'Total'], 'required'],
            [['Cantidad'], 'integer', 'min' => 1, 'max' => 10],
        ];
    }

    public function attributeLabels()
    {
        return [
            'IdProductoTalla' => 'Escoger Talla',
            'Cantidad' => 'Cantidad',
        ];
    }

}
