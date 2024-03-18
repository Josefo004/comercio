<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "Usuarios".
 *
 * @property string $CodigoUsuario
 * @property string $Login
 * @property string $IdPersona
 * @property string $NombreCompleto
 * @property string $Email
 * @property string $AuthKey
 * @property string $PasswordHash
 * @property string|null $PasswordResetToken
 * @property string|null $Estado
 * @property int|null $EsAdmin
 * @property string|null $FechaHoraRegistro
 * @property string|null $FechaHoraActualizacion
 * @property string|null $VerificationToken
 *
 * @property CarritoItems[] $carritoItems
 * @property Estados $estado
 * @property Ordenes[] $ordenes
 * @property PagosOrdenes[] $pagosOrdenes
 * @property Productos[] $productos
 * @property Productos[] $productos0
 */
class Usuarios extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 'D';
    const STATUS_INACTIVE = 'I';
    const STATUS_ACTIVE = 'V';


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%Usuarios}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
           ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['Estado', 'default', 'value' => self::STATUS_INACTIVE],
            ['Estado', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            [['CodigoUsuario'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($codigoUsuario)
    {
        return static::findOne(['CodigoUsuario' => $codigoUsuario, 'Estado' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($login)
    {
        return static::findOne(['Login' => $login, 'Estado' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'PasswordResetToken' => $token,
            'Estado' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'VerificationToken' => $token,
            'Estado' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->AuthKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->PasswordHash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->PasswordHash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->AuthKey = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->PasswordResetToken = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->VerificationToken = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->PasswordResetToken = null;
    }

    /**
     * Devuelve el nombre para mostrar del usuario.
     * @return string El nombre para mostrar del usuario.
     */
    public function getDisplayName()
    {
        return $this->NombreCompleto;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // if ($this->isNewRecord) {
            //     $this->created_at = time();
            // }
            // $this->updated_at = time();
            $this->NombreCompleto = mb_strtoupper($this->NombreCompleto);
            $this->IdPersona = mb_strtoupper($this->IdPersona);
            return true;
        } else {
            return false;
        }
    }


    public function generateCodigoUsuario()
    {
        $this->CodigoUsuario = $this->generateUniqueCodUser();
    }

    public function generateUniqueCodUser()
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        // Output: 54esmdr0qf
        // echo substr(str_shuffle($permitted_chars), 0, 10);

        $nc = $this->NombreCompleto;                    // nombre completo
        $nc = str_replace("  ", " ", $nc);
        $nc = strtolower($nc);
        $porciones = explode(" ", $nc);
        $codi = "";                                     // codigo inicial
        foreach ($porciones as $value) {
            $letra = "";
            // extraemos la 1ra letra de cada palabra separada
            $letra = $value[0];
            // si la letra NO esta dentro los caracteres permitidos lo remplazamos por uno aleatoriamente
            $letra = (strpos($permitted_chars, $letra) === false) ? substr(str_shuffle($permitted_chars), 0, 1) : $value[0]; 
            $codi .= $letra;
        }
        $usrAux = static::findIdentity(['CodigoUsuario' => $codi]);
        while ($usrAux != null) {
            $codi = $codi.".".substr(str_shuffle($permitted_chars), 0, 3);
            $usrAux = static::findIdentity(['CodigoUsuario' => $codi]);
        }
        return $codi;
    }
}
