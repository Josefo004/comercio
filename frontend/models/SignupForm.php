<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Usuarios;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $login;
    public $idPersona;
    public $nombreCompleto;
    public $email;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['login', 'trim'],
            ['login', 'required'],
            ['login', 'unique', 'targetClass' => '\common\models\Usuario', 'message' => 'This username has already been taken.'],
            ['login', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Usuario', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            ['idPersona', 'trim'],
            ['idPersona', 'required'],

            ['nombreCompleto', 'trim'],
            ['nombreComleto', 'required'],

        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
       /* if (!$this->validate()) {
            return null;
        }*/
        
        $user = new Usuarios();
        $user->generateCodigoUsuario();
        $user->Login = $this->login;
        $user->IdPersona = $this->idPersona;
        $user->NombreCompleto = $this->nombreCompleto;
        $user->Email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();

        return $user->save() && $this->sendEmail($user);
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
