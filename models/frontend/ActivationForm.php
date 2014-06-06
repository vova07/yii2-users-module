<?php

namespace vova07\users\models\frontend;

use vova07\users\models\User;
use vova07\users\traits\ModuleTrait;
use yii\base\Model;
use Yii;

/**
 * Class ActivationForm
 * @package vova07\users\models
 * ResendForm is the model behind the activation form.
 *
 * @property string $secure_key Activation key
 */
class ActivationForm extends Model
{
    use ModuleTrait;

    /**
     * @var string $secure_key Activation key
     */
    public $secure_key;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // Secure key
            ['secure_key', 'required'],
            ['secure_key', 'trim'],
            ['secure_key', 'string', 'max' => 53],
            [
                'secure_key',
                'exist',
                'targetClass' => User::className(),
                'filter' => function ($query) {
                        $query->inactive();
                    }
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'secure_key' => Yii::t('users', 'ATTR_SECURE_KEY')
        ];
    }

    /**
     * Activates user account.
     *
     * @return boolean true if account was successfully activated
     */
    public function activation()
    {
        /** @var User $model */
        $model = User::findBySecureKey($this->secure_key, 'inactive');
        if ($model !== null) {
            return $model->activation();
        }
        return false;
    }
}
