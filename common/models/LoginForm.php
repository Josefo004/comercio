<?php

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $login;
    public $password;
    public $rememberMe = true;

    private $_user;
    private $_user2;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['login', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'login' => 'Usuario',
            'password' => 'Contraseña',
            'rememberMe' => 'Recuerdame',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            // $user2 = $this->getUser2();
            //dd($user);
            if ($user!=null) {
                if (Yii::$app->security->validatePassword($user->IdPersona, $user->PasswordHash))
                {
                    $this->addError($attribute, 'Contraseña IGUAL a CI debe cambiar su contraseña.');
                }
                if ($user->EsAdmin!=1) {
                    $this->addError($attribute, 'ACCESO BLOQUEADO!! (SOLO ADMINISTRADORES)');
                }
            }
            //dd($user, $user2);
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Usuario o Contraseña Incorrectos.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            // Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
            Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 2 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Usuarios::findByUsername($this->login);
        }
        return $this->_user;
    }

    protected function getUser2()
    {
        if ($this->_user2 === null) {
            $this->_user2 = Usuarios::findByUsername('admin');
        }
        return $this->_user2;
    }
}
