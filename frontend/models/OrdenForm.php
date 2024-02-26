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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['IdPersona', 'Email', 'NombreCompleto', 'Celular'], 'required'],
            [['Email'], 'email'],
            [['Celular', 'NombreCompleto', 'CodigoUsuario'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'IdPersona' => 'Doc. de Identidad',
            'Email' => 'Correo Electrónico',
            'Celular' => 'Celular',
            'NombreCompleto' => 'Nombre completo',
        ];
    }

}
