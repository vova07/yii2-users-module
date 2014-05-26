<?php

namespace vova07\users\models\frontend;

use Yii;
use yii\base\Model;
use vova07\users\helpers\Security;
use vova07\users\models\User;
use vova07\users\traits\ModuleTrait;

/**
 * Class RecoveryConfirmationForm
 * @package vova07\users\models
 * RecoveryConfirmationForm is the model behind the recovery confirmation form.
 *
 * @property string $password Password
 * @property string $repassword Repeat password
 * @property string $secure_key Secure key
 */
class RecoveryConfirmationForm extends Model
{
    use ModuleTrait;

    /**
     * @var string $password Password
     */
    public $password;

    /**
     * @var string $repassword Repeat password
     */
    public $repassword;

    /**
     * @var string Confirmation token
     */
    public $secure_key;

    /**
     * @var vova07\users\models\User User instance
     */
    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // Required
            [['password', 'repassword', 'secure_key'], 'required'],

            // Trim
            [['password', 'repassword', 'secure_key'], 'trim'],

            // String
            [['password', 'repassword'], 'string', 'min' => 6, 'max' => 30],
            ['secure_key', 'string', 'max' => 53],

            // Repassword
            ['repassword', 'compare', 'compareAttribute' => 'password'],

            // Secure key
            ['secure_key', 'exist', 'targetClass' => User::className(), 'filter' => function($query) {
                $query->active();
            }]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'password' => Yii::t('users', 'ATTR_PASSWORD'),
            'repassword' => Yii::t('users', 'ATTR_REPASSWORD')
        ];
    }

    /**
     * Check if secure key is valid.
     *
     * @return boolean true if secure key is valid
     */
    public function isValidSecureKey()
    {
        if (Security::isValidToken($this->secure_key, $this->module->recoveryWithin) === true) {
            return ($this->_user = User::findBySecureKey($this->secure_key, 'active')) !== null;
        }
        return false;
    }

    /**
     * Recover password.
     *
     * @return boolean true if password was successfully recovered
     */
    public function recovery()
    {
        $model = $this->_user;
        if ($model !== null) {
            return $model->recovery($this->password);
        }
        return false;
    }
}
