<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class OrdenForm extends Model
{
    public $IdPersona;          // carnet de Identidad
    public $Email;              // correo electronico
    public $Celular;            // celular del solicitante
    public $NombreCompleto;     // Nombre del solicitante del o de los articulos
    public $CodigoUsuario;      // Usuario
    public $TotalOrden;         // Total de la Orden
    public $Confirmar;         // Total de la Orden

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IdPersona', 'Email', 'NombreCompleto', 'Celular', 'TotalOrden', 'Confirmar'], 'required'],
            [['Email'], 'email'],
            [['Confirmar'], 'boolean'],
            [['Celular', 'NombreCompleto', 'CodigoUsuario'], 'string'],
            [['TotalOrden'], 'number'],
            [['IdPersona'], 'string', 'min' => 6],
        ];
    }

    public function attributeLabels()
    {
        return [
            'IdPersona' => 'Doc. de Identidad',
            'Email' => 'Correo Electrónico',
            'Celular' => 'Celular',
            'NombreCompleto' => 'Nombre completo',
            'Confirmar' => 'Comisión'
        ];
    }

}
