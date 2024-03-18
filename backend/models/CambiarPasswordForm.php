<?php

namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class CambiarPasswordForm extends Model
{
    public $CodigoUsuario;
    public $Login;            
    public $NombreCompleto;
    public $NuevoPassword;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CodigoUsuario', 'Login', 'NombreCompleto', 'NuevoPassword'], 'required'],
            [['CodigoUsuario', 'Login', 'NombreCompleto', 'NuevoPassword'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'NuevoPassword' => 'Nueva Contraseña',
            'Login' => 'Usuario',
            'NombreCompleto' => 'Nombre Completo',
        ];
    }

}
